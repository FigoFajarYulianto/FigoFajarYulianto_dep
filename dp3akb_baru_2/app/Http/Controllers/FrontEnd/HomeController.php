<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\About;
use App\Models\Slider;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $setting = Setting::where('id', 1)->first();
        $about = About::where('id', 1)->first();
        return view('frontend.home', [
            'title_bar' => $setting->name,
            'setting'   => $setting,
            'about'     => $about,
            'sliders'   => Slider::orderBy('id', 'DESC')->get(),
        ]);
    }
}
