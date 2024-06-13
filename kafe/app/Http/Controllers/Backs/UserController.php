<?php

namespace App\Http\Controllers\Backs;

use App\Models\User;
use App\Models\Level;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Statususer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        if ($request->has('search')) {
            $user    = User::where('name', 'LIKE', '%' . $request->search . '%')->Paginate(10);
        } else {
            $user    = User::with('level')->Paginate(10);
        }

        return view('dashboard.users', compact('user'));

        // return view('dashboard.users', [
        //     'user' => User::all(),
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.createuser', [
            'level'        => Level::all(),

        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'name'          => ['required', 'min:4', 'max:255'],
            'email'         => ['required', 'min:4', 'max:255', 'unique:users'],
            'username'      => ['required', 'min:4', 'max:255'],
            'password'      => ['required', 'min:4', 'max:255'],
            // 'photo'         => ['image', 'file', 'max:2048'],
            'level_id'      => ['required'],
            'status'        => ['required']
        ];
        if ($request->email) {
            $rules['email'] = ['email:dns', 'unique:users'];
        }
        if ($request->hp) {
            $rules['whatsapp'] = ['min:10', 'max:15', 'unique:users'];
        }
        $data = $request->validate($rules);

        // if ($request->hasFile('photo')) {
        //     $data['photo'] = $request->photo->store('uploads');
        // }

        // $data['address'] = $request->address;
        $data['password'] = Hash::make($request->password);
        // $data['verified_at'] = ($data['status'] ? now() : NULL);
        $data['remember_token'] = ($data['status'] ? Str::random(60) : NULL);

        User::create($data);
        // return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil disimpan.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        return redirect('dashboard/users')->with('success', 'Data Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        return view('dashboard.edituser', [
            'user'          => $user,
            'level'        => Level::all(),

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
            'name'          => ['required', 'min:4', 'max:255'],
            // 'photo'         => ['image', 'file', 'max:2048'],
            'level_id'      => ['required'],
            'status'        => ['required']
        ];

        if ($request->username) {
            $rules['username'] = $request->username !== $user->username ? ['required', 'min:4', 'max:255', 'unique:users'] : ['required', 'min:4', 'max:255'];
        }
        if ($request->email) {
            $rules['email'] = $request->email !== $user->email ? ['email:dns', 'unique:users'] : ['email:dns'];
        }
        if ($request->whatsapp) {
            $rules['whatsapp'] = $request->whatsapp !== $user->whatsapp ? ['min:10', 'max:13', 'unique:users'] : '';
        }
        $data = $request->validate($rules);

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }



        $data['email'] = $request->email;
        $data['whatsapp'] = $request->whatsapp;
        $data['password'] = $request->password ? $data['password'] : $user->password;

        User::where('id', $user->id)->update($data);
        return redirect('dashboard/users')->with('success', 'Data Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // if (($user->id !== auth()->user()->id) && $user->id !== 1 && $user->posts->count() === 0 && $user->pages->count() === 0) {
        // if ($user->photo) {
        //     Storage::delete($user->photo);
        // }
        User::destroy($user->id);
        return back()->with('success', 'Data Berhasil Dihapus');
        // } else {
        //     abort(403);
        // }
    }
}