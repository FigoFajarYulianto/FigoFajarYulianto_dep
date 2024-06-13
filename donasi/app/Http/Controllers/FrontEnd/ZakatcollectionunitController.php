<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Fund;
use App\Models\Page;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Section;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\Funditem;
use App\Rules\ReCaptcha;
use Illuminate\Support\Str;
use App\Models\Campaignfund;
use Illuminate\Http\Request;
use App\Models\Campaignfunditem;
use App\Http\Controllers\Controller;
use App\Models\Zakatcollectionunit;
use App\Services\Midtrans\CreateSnapTokenService;

class ZakatcollectionunitController extends Controller
{
    public function index()
    {
        return view('frontend.zakatcollectionunits', [
            'title_bar'             => 'Unit Pengumpulan Zakat',
            'zakatcollectionunits'  => Zakatcollectionunit::filter(request(['search']))->latest()->paginate(50),
        ]);
    }

    public function show(Zakatcollectionunit $zakatcollectionunit)
    {
        return view('frontend.detailzakatcollectionunit', [
            'title_bar'             => $zakatcollectionunit->name,
            'zakatcollectionunit'   => $zakatcollectionunit,
        ]);
    }

    public function postcomment(Request $request)
    {
        $data = $request->validate([
            'post_id'   => ['required'],
            'name'      => ['required', 'min:3', 'max:255'],
            'email'     => ['required', 'email:dns'],
            'comment'   => ['required', 'min:3', 'max:255'],
            'g-recaptcha-response' => ['required', new ReCaptcha]
        ]);
        Comment::create($data);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Terimakasih! Komentar berhasil terkirim.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    public function update(Request $request, Campaign $campaign)
    {
        $total_fund = Fund::firstWhere('user_id', auth()->user()->id)->total_fund ?? 0;

        $data = $request->validate([
            'user_id'           => ['required'],
            'gross_amount'      => ['required'],
        ]);
        $gross_amount = $request->gross_amount ? Str::replace(['.', ','], ['', '.'], $request->gross_amount) : 0;

        $data['gross_amount'] = $gross_amount;
        $data['transaction_type'] = 'Donasi';
        $data['campaign_id'] = $campaign->id;
        $data['transaction_status'] = 'Berhasil';
        $data['transaction_time'] = date('Y-m-d H:i:s');
        $data['order_id'] = time();

        if ($gross_amount > $total_fund) {
            return back()->with('msg', '<div class="alert small alert-danger alert-dismissible fade show" role="alert">Saldo anda tidak cukup untuk melakukan penarikan. Saldo anda : <b>Rp. ' . $total_fund . '</b><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        }

        // Dompetku
        $fund_item = Funditem::create($data);
        $fund = (Fund::where('user_id', $request->user_id)->first()->total_fund ?? 0) - $fund_item->gross_amount;
        $fund_data['user_id'] = $fund_item->user_id;
        $fund_data['total_fund'] = $fund;
        Fund::where('user_id', $request->user_id)->update($fund_data);

        // Dompet Kampanye
        $data['description'] = $request->description;
        $data['hidden_name'] = $request->hidden_name;
        $campaign_fund_item = Campaignfunditem::create($data);
        $campaign_fund = (Campaignfund::where('user_id', $request->user_id)->first()->total_fund ?? 0) + $campaign_fund_item->gross_amount;
        $campaign_fund_data['user_id'] = $campaign->user_id;
        $campaign_fund_data['campaign_id'] = $campaign->id;
        $campaign_fund_data['total_fund'] = $campaign_fund;
        Campaignfund::first() == '' ? Campaignfund::create($campaign_fund_data) : Campaignfund::where('user_id', $request->user_id)->update($campaign_fund_data);

        return back()->with('msg', '<div class="mt-3"><div class="alert alert-success small" role="alert">Terimakasih! Anda Telah Berdonasi.</div></div>');
    }

    public function store_topup(Request $request)
    {
        $data = $request->validate([
            'campaign_id'       => ['required'],
            'name'              => ['required'],
            'gross_amount'      => ['required'],
        ]);
        $order_id = time();
        $data['order_id'] = $order_id;
        $data['transaction_type'] = $request->transaction_type;
        $data['transaction_status'] = 'Menunggu';
        $data['description'] = $request->description;
        $data['transaction_time'] = date('Y-m-d H:i:s');

        $snapToken = $order_id;
        $midtrans = new CreateSnapTokenService($data);
        $snapToken = $midtrans->getSnapToken();
        $data['snap_token'] = $snapToken;

        $tanggal = date('Y-m-d');
        $code = 'DN';
        $data['no_transaksi'] = Campaignfunditem::generateInv($code, $tanggal);
        // return response()->json($data);

        $create = Campaignfunditem::create($data);

        // $no_transaksi['no_trx'] = 'TP/FN/' . str_pad(($create->id), 5, "0", STR_PAD_LEFT);
        // Funditem::where('id', $create->id)->update($no_transaksi);

        if ($create) {
            return response()->json(['status' => true, 'data' => $create]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function update_topup(Request $request, Campaignfunditem $campaignfunditem)
    {
        $data = $request->validate([
            'transaction_status_time'   => ['required'],
            'transaction_status'        => ['required'],
        ]);

        if ($request->transaction_status == 'pending') {
            $data['transaction_status'] = 'Menunggu';
            $update = Campaignfunditem::where('id', $campaignfunditem->id)->update($data);
            if ($update) {
                return response()->json(['status' => true, 'data' => $update]);
            } else {
                return response()->json(['status' => false]);
            }
        } else if ($request->transaction_status == 'failure') {
            $data['transaction_status'] = 'Gagal';
            $update = Campaignfunditem::where('id', $campaignfunditem->id)->update($data);
            if ($update) {
                return response()->json(['status' => true, 'data' => $update]);
            } else {
                return response()->json(['status' => false]);
            }
        } else if ($request->transaction_status == 'settlement') {
            $data['transaction_status'] = 'Berhasil';
            $update = Campaignfunditem::where('id', $campaignfunditem->id)->update($data);

            $fund_data['campaign_id'] = $campaignfunditem->campaign_id;
            $fund_data['total_fund'] = (Campaignfund::where('campaign_id', $campaignfunditem->campaign_id)->first()->total_fund ?? 0) + $campaignfunditem->gross_amount;

            if (Campaignfund::where('campaign_id', $campaignfunditem->campaign_id)->first() == '') {
                Campaignfund::create($fund_data);
            } else {
                Campaignfund::where('campaign_id', $campaignfunditem->campaign_id)->update($fund_data);
            }

            if ($update) {
                return response()->json(['status' => true, 'data' => $update]);
            } else {
                return response()->json(['status' => false]);
            }
        }
    }
}
