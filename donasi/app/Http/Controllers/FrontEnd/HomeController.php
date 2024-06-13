<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Goal;
use App\Models\About;
use App\Models\Slider;
use App\Models\Setting;
use App\Models\Campaign;
use App\Models\Zakatfund;
use App\Models\Campaignfund;
use Illuminate\Http\Request;
use App\Models\Campaignfunditem;
use App\Http\Controllers\Controller;
use App\Models\Danafund;
use App\Models\Danafunditem;
use App\Models\Zakattransactionitem;

class HomeController extends Controller
{
    public function index()
    {
        $setting = Setting::where('id', 1)->first();
        $about = About::where('id', 1)->first();

        $danafunds = Danafund::all();
        $danafunditems = Danafunditem::all();

        // zakat
        $zakatfunds = $danafunds->where('danacategory_id', 1);
        $zakatfunds_total = $zakatfunds->sum('total_fund');
        $zakatfunds_sisa = $zakatfunds->sum('sisa_fund');
        $zakatfunds_penarikan = $zakatfunds->sum('penarikan_fund');

        $zakatfunditems = $danafunditems->where('danacategory_id', 1);
        $zakatfunditems_muzakki = $zakatfunditems->where('transaction_status', 'Berhasil')->where('transaction_type', 'Transfer In')->count();
        $zakatfunditems_mustahik = $zakatfunditems->where('transaction_status', 'Berhasil')->where('transaction_type', 'Transfer Out')->count();

        // Fidyah
        $fidyahfunds = $danafunds->where('danacategory_id', 2);
        $fidyahfunds_total = $fidyahfunds->sum('total_fund');
        $fidyahfunds_sisa = $fidyahfunds->sum('sisa_fund');
        $fidyahfunds_penarikan = $fidyahfunds->sum('penarikan_fund');

        $fidyahfunditems = $danafunditems->where('danacategory_id', 2);
        $fidyahfunditems_muzakki = $fidyahfunditems->where('transaction_status', 'Berhasil')->where('transaction_type', 'Transfer In')->count();
        $fidyahfunditems_mustahik = $fidyahfunditems->where('transaction_status', 'Berhasil')->where('transaction_type', 'Transfer Out')->count();

        // campaign
        $campaignfunds = Campaignfund::all();
        $campaignfunds_total = $campaignfunds->sum('total_fund');
        $campaignfunds_sisa = $campaignfunds->sum('sisa_fund');
        $campaignfunds_penarikan = $campaignfunds->sum('penarikan_fund');

        $campaignfunditems = Campaignfunditem::all();
        $campaignfunditems_donatur = $campaignfunditems->where('transaction_status', 'Berhasil')->where('transaction_type', 'Donasi')->count();
        $campaignfunditems_penarikan = $campaignfunditems->where('transaction_status', 'Berhasil')->where('transaction_type', 'Penarikan')->count();

        $data = collect([
            'zakatfunds_total'                  => $zakatfunds_total,
            'zakatfunds_sisa'                   => $zakatfunds_sisa,
            'zakatfunds_penarikan'              => $zakatfunds_penarikan,
            'zakatfunditems_muzakki'            => $zakatfunditems_muzakki,
            'zakatfunditems_mustahik'           => $zakatfunditems_mustahik,
            'fidyahfunds_total'                 => $fidyahfunds_total,
            'fidyahfunds_sisa'                  => $fidyahfunds_sisa,
            'fidyahfunds_penarikan'             => $fidyahfunds_penarikan,
            'fidyahfunditems_muzakki'           => $fidyahfunditems_muzakki,
            'fidyahfunditems_mustahik'          => $fidyahfunditems_mustahik,
            'fidyahfunds_total'                 => $fidyahfunds_total,
            'campaignfunds_total'               => $campaignfunds_total,
            'campaignfunds_sisa'                => $campaignfunds_sisa,
            'campaignfunds_penarikan'           => $campaignfunds_penarikan,
            'campaignfunditems_donatur'         => $campaignfunditems_donatur,
            'campaignfunditems_penarikan'       => $campaignfunditems_penarikan,
            'campaign'                          => Campaign::count(),
        ]);

        return view('frontend.home', [
            'title_bar' => $setting->name,
            'setting'   => $setting,
            'about'     => $about,
            'statistik' => $data,
            'campaigns' => Campaign::with('category')->where('waktu_tenggat', '>=', date_create(date('Y-m-d')))->where('status_id', 2)->get(),
            'sliders'   => Slider::orderBy('id', 'DESC')->get(),
        ]);
    }
}
