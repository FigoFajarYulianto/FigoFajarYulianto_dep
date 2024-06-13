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
use App\Services\Midtrans\CreateSnapTokenService;

class CampaignController extends Controller
{
    public function index()
    {
        $title = '';
        if (request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            if (request('q')) {
                $title = $category->name . ' : ' . request('q');
            } else {
                $title = $category->name;
            }
        }

        if (request('author')) {
            $author = User::firstWhere('username', request('author'));
            if (request('q')) {
                $title = $author->name . ' : ' . request('q');
            } else {
                $title = $author->name;
            }
        }

        if (!request('category') && !request('author') && request('q')) {
            $title = 'Pencarian: ' . request('q');
        }

        if (!request('category') && !request('author') && !request('q')) {
            $title = 'Bantu Siapa Hari Ini?';
        }

        return view('frontend.campaigns', [
            'title_bar' => $title,
            'campaigns' => Campaign::where('waktu_tenggat', '>=', date_create(date('Y-m-d')))
                ->where('status_id', 2)
                ->with(['category', 'user', 'campaign_fund_items', 'campaign_fund'])
                ->latest()
                ->filter(request(['q', 'category', 'author']))
                ->paginate(9)
                ->withQueryString()
        ]);
    }

    public function show(Campaign $campaign)
    {
        if ($campaign->status_id !== 2) {
            abort(404);
        }

        Campaign::where('id', $campaign->id)->update(['views' => ($campaign->views + 1)]);

        return view('frontend.detailcampaign', [
            'title_bar'             => $campaign->title,
            'campaign'              => $campaign,
            'campaignfund'          => Campaignfund::where('campaign_id', $campaign->id)->first(),
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
        $data['is_anonim'] = $request->is_anonim;

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
            $fund_data['sisa_fund'] = (Campaignfund::where('campaign_id', $campaignfunditem->campaign_id)->first()->sisa_fund ?? 0) + $campaignfunditem->gross_amount;

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
