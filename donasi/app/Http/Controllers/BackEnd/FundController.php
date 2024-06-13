<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Bank;
use App\Models\Fund;
use App\Models\Level;
use App\Models\Funditem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\Storage;
use App\Services\Midtrans\CreateSnapTokenService;

class FundController extends Controller
{
    public function index()
    {
        $bagian = Level::where('id', auth()->user()->level_id)->first();
        $roles = explode(',', $bagian['access']);

        return view('dashboard.funds', [
            'title_bar'     => 'Kantong Donasi',
            'funds'         => Fund::with('user')->latest()->paginate(100),
            'fund'          => Fund::where('user_id', auth()->user()->id)->first(),
            'fund_items'    => Funditem::with('campaign')->where('user_id', auth()->user()->id)->with('user', 'bank')->latest()->paginate(100),
            'roles'         => $roles
        ]);
    }

    public function create_topup()
    {
        return view('dashboard.fundtopupcreate', [
            'title_bar' => 'Isi Saldo',
            'funds'     => Fund::with('user')->latest()->paginate(100),
            'banks'     => Bank::all(),
        ]);
    }

    public function store_topup(Request $request)
    {
        $data = $request->validate([
            'user_id'           => ['required'],
            'transaction_type'  => ['required'],
            'gross_amount'      => ['required'],
        ]);

        $order_id = time();
        $data['order_id'] = $order_id;
        $data['transaction_status'] = 'Menunggu';
        $data['transaction_time'] = date('Y-m-d H:i:s');

        $snapToken = $order_id;
        $midtrans = new CreateSnapTokenService($data);
        $snapToken = $midtrans->getSnapToken();
        $data['snap_token'] = $snapToken;

        $create = Funditem::create($data);

        // $no_transaksi['no_trx'] = 'TP/FN/' . str_pad(($create->id), 5, "0", STR_PAD_LEFT);
        // Funditem::where('id', $create->id)->update($no_transaksi);

        if ($create) {
            return response()->json(['status' => true, 'data' => $create]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function update_topup(Request $request, Funditem $funditem)
    {
        $data = $request->validate([
            'transaction_status_time'   => ['required'],
            'transaction_status'        => ['required'],
        ]);

        if ($request->transaction_status == 'pending') {
            $data['transaction_status'] = 'Menunggu';
            $update = Funditem::where('id', $funditem->id)->update($data);
            if ($update) {
                return response()->json(['status' => true, 'data' => $update]);
            } else {
                return response()->json(['status' => false]);
            }
        } else if ($request->transaction_status == 'failure') {
            $data['transaction_status'] = 'Gagal';
            $update = Funditem::where('id', $funditem->id)->update($data);
            if ($update) {
                return response()->json(['status' => true, 'data' => $update]);
            } else {
                return response()->json(['status' => false]);
            }
        } else if ($request->transaction_status == 'settlement') {
            $data['transaction_status'] = 'Berhasil';
            $update = Funditem::where('id', $funditem->id)->update($data);


            $fund_data['user_id'] = $funditem->user_id;
            $fund_data['total_fund'] = (Fund::where('user_id', $funditem->user_id)->first()->total_fund ?? 0) + $funditem->gross_amount;

            if (Fund::where('user_id', $funditem->user_id)->first() == '') {
                Fund::create($fund_data);
            } else {
                Fund::where('user_id', $funditem->user_id)->update($fund_data);
            }

            if ($update) {
                return response()->json(['status' => true, 'data' => $update]);
            } else {
                return response()->json(['status' => false]);
            }
        }
    }

    public function create_withdrawal()
    {
        return view('dashboard.fundwithdrawalcreate', [
            'title_bar'     => 'Penarikan Baru',
            'fund'          => Fund::where('user_id', auth()->user()->id)->first(),
            'banks'         => Bank::where('user_id', auth()->user()->id)->first(),
        ]);
    }

    public function store_withdrawal(Request $request)
    {
        $fund = Fund::firstWhere('user_id', auth()->user()->id);
        $data = $request->validate([
            'user_id'           => ['required'],
            'transaction_type'  => ['required'],
            'gross_amount'      => ['required'],
            'bank_id'           => ['required'],
        ]);

        $gross_amount = $request->gross_amount ? Str::replace(['.', ','], ['', '.'], $request->gross_amount) : 0;

        // Fund Item
        $data['gross_amount'] = $gross_amount;
        $data['order_id'] = time();
        $data['transaction_status'] = 'Menunggu';
        $data['transaction_time'] = date('Y-m-d H:i:s');

        if ($gross_amount > $fund->total_fund) {
            return back()->with('msg', '<div class="alert small alert-danger alert-dismissible fade show" role="alert">Saldo anda tidak cukup untuk melakukan penarikan. Saldo anda : <b>' . $fund->total_fund . '</b><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        }

        $funditem = Funditem::create($data);

        // Fund
        $fund = Fund::where('user_id', $request->user_id)->first();
        $funds['user_id'] = $fund->user_id;
        $funds['total_fund'] = $fund->total_fund;
        Fund::where('user_id', $fund->user_id)->update($funds);

        // Withdrawals
        $withdrawals['funditem_id'] = $funditem->id;
        Withdrawal::create($withdrawals);

        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Permintaan telah dikirim.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    public function edit_withdrawal(Funditem $funditem)
    {
        return view('dashboard.fundwithdrawaledit', [
            'title_bar'     => 'Penarikan Baru',
            'funditem'      => $funditem,
            'fund'          => Fund::where('user_id', $funditem->user_id)->first(),
            'banks'         => Bank::where('user_id', $funditem->user_id)->first(),
        ]);
    }

    public function update_withdrawal(Request $request, Funditem $funditem)
    {
        $data = $request->validate([
            'user_id'           => ['required'],
            'transaction_type'  => ['required'],
            'gross_amount'      => ['required'],
            'bank_id'           => ['required'],
        ]);

        $gross_amount = $request->gross_amount ? Str::replace(['.', ','], ['', '.'], $request->gross_amount) : 0;

        // Fund Item
        $data['gross_amount'] = $gross_amount;
        $data['order_id'] = time();
        $data['transaction_status'] = 'Menunggu';
        $data['transaction_time'] = date('Y-m-d H:i:s');
        $funditem = Funditem::where('id', $funditem->id)->update($data);

        // Fund
        $fund = Fund::where('user_id', $request->user_id)->first();
        $funds['user_id'] = $fund->user_id;
        $funds['total_fund'] = $fund->total_fund;
        Fund::where('user_id', $fund->user_id)->update($funds);

        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Permintaan telah dikirim.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    public function destroy(Funditem $funditem)
    {
        $withdrawal = Withdrawal::where('funditem_id', $funditem->id)->first();
        if ($funditem->transaction_type == 'Penarikan') {
            Withdrawal::destroy($withdrawal->id);
        }
        Funditem::destroy($funditem->id);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil dihapus.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }
}
