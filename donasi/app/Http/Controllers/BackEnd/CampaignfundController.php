<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Campaign;
use Illuminate\Support\Str;
use App\Models\Campaignfund;
use Illuminate\Http\Request;
use App\Models\Campaignfunditem;

class CampaignfundController extends Controller
{
    public function show_donation(Campaign $campaign)
    {
        return view('dashboard.campaigndonation', [
            'title_bar'         => 'Donatur',
            'campaign'          => $campaign,
            'campaignfunditems' => Campaignfunditem::with('user')
                ->where('campaign_id', $campaign->id)
                ->where('transaction_type', 'Donasi')
                ->where('transaction_status', 'Berhasil')
                ->latest()
                ->paginate(100),
        ]);
    }

    public function show_withdrawal(Campaign $campaign)
    {
        return view('dashboard.campaignwithdrawal', [
            'title_bar'         => 'Riwayat Penarikan',
            'campaignfunditems' => Campaignfunditem::with('user')
                ->where('campaign_id', $campaign->id)
                ->where('transaction_type', 'Penarikan')
                ->latest()
                ->paginate(100),
            'campaignfund'      => Campaignfund::where('campaign_id', $campaign->id)->first(),
            'campaign'          => $campaign,
        ]);
    }

    public function create_withdrawal(Campaign $campaign)
    {
        return view('dashboard.campaignwithdrawalcreate', [
            'title_bar'         => 'Penarikan',
            'campaign'          => $campaign,
            'banks'             => Bank::where('user_id', auth()->user()->id)->first(),
        ]);
    }

    public function store_withdrawal(Request $request, Campaign $campaign)
    {
        $data = $request->validate([
            'user_id'           => ['required'],
            'transaction_type'  => ['required'],
            'gross_amount'      => ['required'],
            'bank_id'           => ['required'],
            'description'       => ['required'],
        ]);

        $gross_amount = $request->gross_amount ? Str::replace(['.', ','], ['', '.'], $request->gross_amount) : 0;

        // Campaign Fund Item
        $data['description'] = $request->description;
        $data['gross_amount'] = $gross_amount;
        $data['campaign_id'] = $campaign->id;
        $data['order_id'] = time();
        $data['transaction_status'] = 'Menunggu';
        $data['transaction_time'] = date('Y-m-d H:i:s');

        $tanggal = date('Y-m-d');
        $code = 'PN';
        $data['no_transaksi'] = Campaignfunditem::generateInv($code, $tanggal);

        if ($gross_amount > $campaign->campaign_fund->total_fund) {
            return back()->with('msg', '<div class="alert small alert-danger alert-dismissible fade show" role="alert">Saldo anda tidak cukup untuk melakukan penarikan. Saldo anda : <b>' . $campaign->campaign_fund->total_fund . '</b><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        }

        Campaignfunditem::create($data);

        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Permintaan telah dikirim.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    public function edit_withdrawal(Campaignfunditem $campaignfunditem)
    {
        return view('dashboard.campaignwithdrawaledit', [
            'title_bar'         => 'Penarikan',
            'campaignfunditems' => Campaignfunditem::with('user')
                ->where('campaign_id', $campaignfunditem->id)
                ->where('transaction_type', 'Penarikan')
                ->where('transaction_status', 'Berhasil')
                ->latest()
                ->paginate(100),
            'campaignfund'      => Campaignfund::where('campaign_id', $campaignfunditem->id)->first(),
            'campaignfunditem'  => $campaignfunditem,
            'campaign'          => Campaign::where('id', $campaignfunditem->campaign_id)->first(),
            'banks'             => Bank::where('user_id', $campaignfunditem->user_id)->first(),
        ]);
    }

    public function update_withdrawal(Request $request, Campaignfunditem $campaignfunditem)
    {
        $data = $request->validate([
            'user_id'           => ['required'],
            'transaction_type'  => ['required'],
            'gross_amount'      => ['required'],
            'bank_id'           => ['required'],
            'description'       => ['required'],
        ]);

        $gross_amount = $request->gross_amount ? Str::replace(['.', ','], ['', '.'], $request->gross_amount) : 0;

        // Campaign Fund Item
        $data['description'] = $request->description;
        $data['gross_amount'] = $gross_amount;
        $data['campaign_id'] = $campaignfunditem->campaign_id;
        $data['order_id'] = time();
        $data['transaction_status'] = 'Menunggu';
        $data['transaction_time'] = date('Y-m-d H:i:s');

        if ($gross_amount > $campaignfunditem->campaign->campaign_fund->total_fund) {
            return back()->with('msg', '<div class="alert small alert-danger alert-dismissible fade show" role="alert">Saldo anda tidak cukup untuk melakukan penarikan. Saldo anda : <b>' . $campaignfunditem->campaign->campaign_fund->total_fund . '</b><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        }

        Campaignfunditem::where('id', $campaignfunditem->id)->update($data);

        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Permintaan telah dikirim.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    public function destroy_withdrawal(Campaignfunditem $campaignfunditem)
    {
        Campaignfunditem::destroy($campaignfunditem->id);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil dihapus.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    // Verifikasi Penarikan
    public function show_verifikasipenarikan()
    {
        return view('dashboard.campaignwithdrawals', [
            'title_bar'         => 'Data Penarikan',
            'campaignfunditems' => Campaignfunditem::where('transaction_type', 'Penarikan')->orderBy('created_at', 'DESC')->latest()->paginate(100),
        ]);
    }

    public function update_verifikasipenarikan(Request $request, Campaignfunditem $campaignfunditem)
    {
        $request->validate([
            'transaction_status' => ['required'],
        ]);

        $data['transaction_status'] = $request->transaction_status;

        if ($campaignfunditem->transaction_status == 'Berhasil') {
            $campaign_fund = Campaignfund::where('campaign_id', $campaignfunditem->campaign_id)->first();
            $gross_amount['sisa_fund'] = $campaign_fund->sisa_fund + $campaignfunditem->gross_amount;
            $gross_amount['penarikan_fund'] = $campaign_fund->penarikan_fund - $campaignfunditem->gross_amount;
            Campaignfund::where('campaign_id', $campaignfunditem->campaign_id)->update($gross_amount);
        } else {
            if ($request->transaction_status == 'Berhasil') {
                $campaign_fund = Campaignfund::where('campaign_id', $campaignfunditem->campaign_id)->first();
                $gross_amount['sisa_fund'] = $campaign_fund->sisa_fund - $campaignfunditem->gross_amount;
                $gross_amount['penarikan_fund'] = $campaign_fund->penarikan_fund + $campaignfunditem->gross_amount;
                Campaignfund::where('campaign_id', $campaignfunditem->campaign_id)->update($gross_amount);
            }
        }
        Campaignfunditem::where('id', $request->id)->update($data);

        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function campaigntransactionwithdrawals(Campaignfunditem $campaignfunditem)
    {
        return response()->json($campaignfunditem::with('user', 'campaign')->firstWhere('id', $campaignfunditem->id));
    }
}
