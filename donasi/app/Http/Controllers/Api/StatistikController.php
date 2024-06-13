<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Campaignfund;
use App\Models\Campaignfunditem;
use App\Models\Zakat;
use App\Models\Zakatfund;
use App\Models\Zakattransactionitem;

class StatistikController extends Controller
{
    public function zakat_load()
    {
        $zakatfunds = Zakatfund::all();
        $zakatfunds_total = $zakatfunds->sum('total_fund');
        $zakatfunds_sisa = $zakatfunds->sum('sisa_fund');
        $zakatfunds_penarikan = $zakatfunds->sum('penarikan_fund');

        $zakattransactionitems = Zakattransactionitem::all();
        $zakattransactionitems_muzakki = $zakattransactionitems->where('transaction_status', 'Berhasil')->where('transaction_type', 'Zakat')->count();
        $zakattransactionitems_mustahik = $zakattransactionitems->where('transaction_status', 'Berhasil')->where('transaction_type', 'Penarikan')->count();

        $data = collect([
            'zakatfunds_total'                  => $zakatfunds_total,
            'zakatfunds_sisa'                   => $zakatfunds_sisa,
            'zakatfunds_penarikan'              => $zakatfunds_penarikan,
            'zakattransactionitems_muzakki'     => $zakattransactionitems_muzakki,
            'zakattransactionitems_mustahik'    => $zakattransactionitems_mustahik,
        ]);

        return response()->json($data);
    }

    public function campaign_load()
    {
        $campaignfunds = Campaignfund::all();
        $campaignfunds_total = $campaignfunds->sum('total_fund');
        $campaignfunds_sisa = $campaignfunds->sum('sisa_fund');
        $campaignfunds_penarikan = $campaignfunds->sum('penarikan_fund');

        $campaignfunditems = Campaignfunditem::all();
        $campaignfunditems_donatur = $campaignfunditems->where('transaction_status', 'Berhasil')->where('transaction_type', 'Donasi')->count();
        $campaignfunditems_penarikan = $campaignfunditems->where('transaction_status', 'Berhasil')->where('transaction_type', 'Penarikan')->count();

        $data = collect([
            'campaignfunds_total'           => $campaignfunds_total,
            'campaignfunds_sisa'            => $campaignfunds_sisa,
            'campaignfunds_penarikan'       => $campaignfunds_penarikan,
            'campaignfunditems_donatur'     => $campaignfunditems_donatur,
            'campaignfunditems_penarikan'   => $campaignfunditems_penarikan,
        ]);

        return response()->json($data);
    }
}
