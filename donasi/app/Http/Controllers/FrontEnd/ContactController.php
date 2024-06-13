<?php

namespace App\Http\Controllers\FrontEnd;

use App\Mail\ContactUs;
use App\Models\Setting;
use App\Rules\ReCaptcha;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        $setting = Setting::where('id', 1)->first();
        return view('frontend.contact', [
            'title_bar' => 'Hubungi Kami',
            'setting'   => $setting
        ]);
    }

    public function sendmessage(Request $request)
    {
        $setting = Setting::where('id', 1)->first();
        $data = $request->validate([
            'name'      => ['required'],
            'email'     => ['required', 'email:dns'],
            'subject'   => ['required', 'min:3', 'max:255'],
            'message'   => ['required'],
            'g-recaptcha-response' => ['required', new ReCaptcha]
        ]);

        Mail::to($setting->email)->send(new ContactUs($data));
        return back()->with('msg', '<div class="mt-3"><div class="alert alert-success small" role="alert">Terimakasih! Pesan berhasil terkirim.</div></div>');
    }
}
