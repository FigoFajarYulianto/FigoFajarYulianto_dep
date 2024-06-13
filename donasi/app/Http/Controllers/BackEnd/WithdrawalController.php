<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Campaignfund;
use App\Models\Campaignfunditem;
use App\Models\Fund;
use App\Models\Funditem;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    public function index()
    {
        return view('dashboard.withdrawals', [
            'title_bar'         => 'Data Penarikan',
            'campaignfunditems' => Campaignfunditem::where('transaction_type', 'Penarikan')->orderBy('created_at', 'DESC')->latest()->paginate(100),
        ]);
    }

    public function update(Request $request, Withdrawal $withdrawal)
    {
        $request->validate([
            'transaction_status' => ['required'],
        ]);

        $data['transaction_status'] = $request->transaction_status;

        if ($withdrawal->campaignfunditem->transaction_status == 'Berhasil') {
            $campaign_fund = Campaignfund::where('campaign_id', $withdrawal->campaignfunditem->campaign_id)->first();
            $gross_amount['total_fund'] = $campaign_fund->total_fund + $withdrawal->campaignfunditem->gross_amount;
            Campaignfund::where('campaign_id', $withdrawal->campaignfunditem->campaign_id)->update($gross_amount);
        } else {
            if ($request->transaction_status == 'Berhasil') {
                $campaign_fund = Campaignfund::where('campaign_id', $withdrawal->campaignfunditem->campaign_id)->first();
                $gross_amount['total_fund'] = $campaign_fund->total_fund - $withdrawal->campaignfunditem->gross_amount;
                Campaignfund::where('campaign_id', $withdrawal->campaignfunditem->campaign_id)->update($gross_amount);
            }
        }
        Campaignfunditem::where('id', $request->id)->update($data);

        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function campaignfundwithdrawals(Campaignfunditem $campaignfunditem)
    {
        return response()->json($campaignfunditem::with('user', 'campaign')->firstWhere('id', $campaignfunditem->id));
    }
}
