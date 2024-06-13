<?php

namespace App\Http\Controllers\Fronts;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ContactUs;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        $setting = Setting::where('id', 1)->first();
        return view('fronts.contact', [
            'title_bar' => 'Hubungi Kami',
            'setting'   => $setting
        ]);
    }

    public function sendmessage(Request $request)
    {
        $setting = Setting::where('id', 1)->first();
        $data = $request->validate([
            'name'      => ['required', 'min:3', 'max:255'],
            'email'     => ['required', 'email:dns'],
            'subject'   => ['required', 'min:3', 'max:255'],
            'message'   => ['required']
        ]);
        Mail::to($setting->email, $setting->name)->send(new ContactUs($data));
        return back()->with('success', 'Terimakasih! Pesan berhasil terkirim');
    }
}