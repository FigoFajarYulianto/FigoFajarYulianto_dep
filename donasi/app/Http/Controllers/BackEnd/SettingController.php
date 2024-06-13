<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Level;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $bagian = Level::where('id', auth()->user()->level_id)->first();
        $roles = explode(',', $bagian['access']);

        $setting = Setting::firstWhere('id', 1);
        return view('dashboard.settings', [
            'title_bar' => 'Pengaturan',
            'setting'   => $setting,
            'roles'     => $roles
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        return response()->json($setting);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        $rules = [
            'name'      => ['required'],
            'main_logo' => ['image', 'file', 'max:2048'],
            'doc_logo' => ['image', 'file', 'max:2048'],
            'sec_logo'  => ['image', 'file', 'max:2048'],
            'favicon'   => ['image', 'file', 'max:2048'],
            'harga_emas' => ['required']
        ];
        if ($request->email) {
            $rules['email'] = ['email:dns'];
        }

        $harga_emas = $request->harga_emas ? Str::replace(['.', ','], ['', '.'], $request->harga_emas) : 0;

        $data = $request->validate($rules);
        $data['harga_emas'] = $harga_emas;

        $data['description'] = $request->description;
        $data['address'] = $request->address;
        $data['telp'] = $request->telp;
        $data['facebook'] = $request->facebook;
        $data['twitter'] = $request->twitter;
        $data['instagram'] = $request->instagram;
        $data['whatsapp'] = $request->whatsapp;
        $data['telegram'] = $request->telegram;
        $data['youtube'] = $request->youtube;
        $data['map'] = $request->map;
        $data['latitude'] = $request->latitude;
        $data['longitude'] = $request->longitude;
        $data['code'] = $request->code;

        if ($request->hasFile('main_logo')) {
            if ($setting->main_logo) {
                Storage::delete($setting->main_logo);
            }
            $data['main_logo'] = $request->main_logo->store('uploads');
        }
        if ($request->hasFile('doc_logo')) {
            if ($setting->doc_logo) {
                Storage::delete($setting->doc_logo);
            }
            $data['doc_logo'] = $request->doc_logo->store('uploads');
        }
        if ($request->hasFile('sec_logo')) {
            if ($setting->sec_logo) {
                Storage::delete($setting->sec_logo);
            }
            $data['sec_logo'] = $request->sec_logo->store('uploads');
        }
        if ($request->hasFile('favicon')) {
            if ($setting->favicon) {
                Storage::delete($setting->favicon);
            }
            $data['favicon'] = $request->favicon->store('uploads');
        }

        Setting::where('id', $setting->id)->update($data);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil disimpan.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }
}
