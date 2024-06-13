<?php

namespace App\Http\Controllers\Fronts;

use GoogleMaps\Facade\GoogleMapsFacade as GoogleMaps;
use App\Models\Section;
use App\Models\Setting;
use App\Models\About;
use App\Models\Slider;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiPPID;
use App\Models\Kelurahan;
use App\Models\Lokasi;

class HomeController extends Controller
{
    public function index()
    {
        $setting = Setting::where('id', 1)->first();
        $about = About::where('id', 1)->first();
        return view('fronts.home', [
            'title_bar' => $setting->name,
            'setting'   => $setting,
            'about'     => $about,
            // 'campaigns' => Campaign::with('category')->where('waktu_tenggat', '>=', date_create(date('Y-m-d')))->where('status_id', 2)->get(),
            'sliders'   => Slider::orderBy('id', 'DESC')->get(),
        ]);
    }

    // public function Lokasis()
    // {
    //     $lokasi = Lokasi::latest()->get();
    //     $results = [];
    //     foreach ($lokasi as $row) {
    //         $results[] = [
    //             'coord' => [
    //                 'lat' => doubleval($row->lat),
    //                 'lng' => doubleval($row->long)
    //             ],
    //             'lokasi' => $row
    //         ];
    //     }
    //     return response()->json($results);
    // }

    // public function lokasi(Lokasi $lokasi)
    // {
    //     return response()->json($lokasi);
    // }

    public function posts()
    {
        $title_bar = 'Berita Terbaru';
        return view('fronts.berita', compact('title_bar'));
    }

    public function ppid()
    {
        $sectionPPID = Section::getSection('ppid');
        return view('fronts.ppid', [
            'title_bar' => $sectionPPID->name,
            'ppid'      => ApiPPID::getNews()
        ]);
    }
}