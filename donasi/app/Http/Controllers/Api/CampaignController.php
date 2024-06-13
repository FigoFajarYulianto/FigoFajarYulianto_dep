<?php

namespace App\Http\Controllers\Api;

use App\Models\Campaign;
use Illuminate\Http\Request;
use App\Models\Campaignfunditem;
use App\Http\Controllers\Controller;

class CampaignController extends Controller
{
    public function donations($id, $limit, $offset)
    {
        $campaign = Campaign::with('province', 'district', 'subdistrict', 'status', 'campaign_fund', 'campaign_fund_items')
            ->where(['id' => $id])->first();
        $dana_terkumpul = $campaign->campaign_fund->total_fund;
        $dana_dicairkan = $campaign->campaign_fund->penarikan_fund;
        $dana_sisa = $campaign->campaign_fund->sisa_fund;

        $campaignfunditems = Campaignfunditem::where('campaign_id', $id)
            ->where('transaction_type', 'Donasi')
            ->where('transaction_status', 'Berhasil');
        $total = $campaignfunditems->count();
        $donations = $campaignfunditems->orderBy('id', 'DESC')->limit($limit)->offset($offset)->get();
        $data = collect([
            'total'             => $total,
            'dana_galang'       => $campaign->nominal,
            'dana_terkumpul'    => $dana_terkumpul,
            'dana_dicairkan'    => $dana_dicairkan ?? 0,
            'dana_sisa'         => $dana_sisa,
            'results'           => $donations
        ]);
        return response()->json($data);
    }
}
