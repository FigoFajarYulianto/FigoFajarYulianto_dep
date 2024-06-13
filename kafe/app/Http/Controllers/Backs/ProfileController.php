<?php

namespace App\Http\Controllers\Backs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Level;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        return view('dashboard.profile', [
            'user'      => User::where('id', auth()->user()->id)->first()

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name'  => ['required', 'min:4', 'max:255'],
            'photo' => ['image', 'file', 'max:2048']
        ];

        if ($request->username) {
            $rules['username'] = $request->name !== $user->name ? ['required', 'min:4', 'max:255', 'unique:users'] : ['required', 'min:4', 'max:255'];
        }
        if ($request->email) {
            $rules['email'] = $request->email !== $user->email ? ['email:dns', 'unique:users'] : ['email:dns'];
        }
        if ($request->whatsapp) {
            $rules['whatsapp'] = $request->hp !== $user->whatsapp ? ['min:10', 'max:13', 'unique:users'] : '';
        }
        $data = $request->validate($rules);

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::delete($user->photo);
            }
            $data['photo'] = $request->photo->store('uploads');
        }

        // $data['address'] = $request->address;
        $data['email'] = $request->email;
        $data['whatsapp'] = $request->whatsapp;
        $data['password'] = $request->password ? $data['password'] : $user->password;

        User::where('id', $user->id)->update($data);
        return back()->with('success', 'Data Berhasil Diperbarui');
    }
}
