<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Bank;
use App\Models\User;
use App\Models\Level;
use App\Models\District;
use App\Models\Province;
use App\Models\Subdistrict;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        return view('dashboard.profile', [
            'title_bar'     => 'Profil Saya',
            'user'          => auth()->user(),
            'provinces'     => Province::all(),
            'districts'     => District::all(),
            'subdistricts'  => Subdistrict::all(),
            'levels'        => Level::all(),
            'banks'         => Bank::where('user_id', auth()->user()->id)->first(),
        ]);
    }

    public function update(Request $request, User $user)
    {
        // Profile
        $data = $request->validate([
            'name'      => 'required',
            'username'  => $request->username !== $user->username ? 'required|unique:users' : 'required',
            'email'     => $request->email !== $user->email ? 'required|email:dns|unique:users' : 'required|email:dns',
            'photo'     => ['image', 'file', 'max:2048']
        ]);

        $data['address'] = $request->address;
        $data['no_phone'] = $request->no_phone;
        $data['province_id'] = $request->province_id;
        $data['district_id'] = $request->district_id;
        $data['subdistrict_id'] = $request->subdistrict_id;
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }
        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::delete($user->photo);
            }
            $data['photo'] = $request->photo->store('uploads');
        }

        // Bank
        $bank['name'] = $request->atas_nama;
        $bank['bank'] = $request->bank;
        $bank['nomor'] = $request->nomor_rekening;
        $bank['user_id'] = $request->user->id;
        Bank::where('user_id', $request->user->id)->first() != '' ? Bank::where('user_id', $user->id)->update($bank) : Bank::create($bank);

        User::where('id', $user->id)->update($data);

        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }
}
