<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title_bar = 'User';
        $users = User::get();
        return view('admin.user', compact('users', 'title_bar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.createuser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name'          => ['required', 'min:4', 'max:255'],
            'email'         => ['required', 'min:4', 'max:255', 'unique:users'],
            // 'username'      => ['required', 'min:4', 'max:255', 'unique:users'],
            'password'      => ['required', 'min:4', 'max:255'],
            // 'photo'         => ['image', 'file', 'max:2048'],
            // 'level_id'      => ['required'],
            // 'status'        => ['required']
        ];
        if ($request->email) {
            $rules['email'] = ['email:dns', 'unique:users'];
        }
        // if ($request->hp) {
        //     $rules['hp'] = ['min:10', 'max:15', 'unique:users'];
        // }
        $data = $request->validate($rules);

        // if ($request->hasFile('photo')) {
        //     $data['photo'] = $request->photo->store('uploads');
        // }

        $data['password'] = Hash::make($request->password);
        // $data['verified_at'] = ($data['status'] ? now() : NULL);
        // $data['remember_token'] = ($data['status'] ? Str::random(60) : NULL);

        // return $data;

        User::create($data);
        // return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil disimpan.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        return redirect('admin/users')->with('success', 'Data Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.edituser', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $rules = [
            'name'          => ['required', 'min:4', 'max:255'],
            // 'photo'         => ['image', 'file', 'max:2048'],
            // 'level_id'      => ['required'],
            // 'status'        => ['required']
        ];

        // if ($request->username) {
        //     $rules['username'] = $request->username !== $user->username ? ['required', 'min:4', 'max:255', 'unique:users'] : ['required', 'min:4', 'max:255'];
        // }
        if ($request->email) {
            $rules['email'] = $request->email !== $user->email ? ['email:dns', 'unique:users'] : ['email:dns'];
        }
        // if ($request->hp) {
        //     $rules['hp'] = $request->hp !== $user->hp ? ['min:10', 'max:13', 'unique:users'] : '';
        // }
        $data = $request->validate($rules);

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $data['email'] = $request->email;
        // $data['hp'] = $request->hp;
        $data['password'] = $request->password ? $data['password'] : $user->password;

        User::where('id', $user->id)->update($data);
        return redirect('admin/users')->with('success', 'Data Berhasil Diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
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