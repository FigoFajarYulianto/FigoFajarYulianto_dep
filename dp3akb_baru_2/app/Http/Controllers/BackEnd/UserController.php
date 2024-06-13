<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\User;
use App\Models\Level;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Cviebrock\EloquentSluggable\Services\SlugService;

class UserController extends Controller
{
    public function index()
    {
        $bagian = Level::where('id', auth()->user()->level_id)->first();
        $roles = explode(',', $bagian['access']);

        $users = User::orderBy('id', 'DESC')
            ->latest()
            ->paginate(100);

        return view('dashboard.users', [
            'title_bar' => 'Data User',
            'users'     => $users,
            'roles'     => $roles,
            'levels'     => Level::get(),
        ]);
    }

    public function create()
    {
        return view('dashboard.usercreate', [
            'title_bar'     => 'User Baru',
            'levels'        => Level::all()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required',
            'username'  => 'required|unique:users',
            'email'     => 'required|email:dns|unique:users',
            'address'   => 'min:3',
            'no_phone'  => 'min:3|max:15',
            'level_id'  => 'required',
            'password'  => 'required',
            'status'    => 'required'
        ]);
        $data['address'] = $request->address;
        $data['password'] = Hash::make($request->password);
        $data['email_verified_at'] = now();
        $data['remember_token'] = Str::random(10);
        User::create($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function show(User $user)
    {
        return response()->json($user);
    }

    public function edit(User $user)
    {
        return view('dashboard.useredit', [
            'title_bar'     => 'Perbarui User',
            'user'          => $user,
            'levels'        => Level::all(),
        ]);
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'      => 'required',
            'address'   => 'min:3',
            'no_phone'  => 'min:3|max:15',
            'level_id'  => 'required',
            'status'    => 'required'
        ]);
        if ($request->username) {
            $rules['username'] = $request->username !== $user->username ? ['required', 'unique:users'] : ['required'];
        }
        if ($request->email) {
            $rules['email'] = $request->email !== $user->email ? ['email:dns', 'unique:users'] : ['email:dns'];
        }
        $data['address'] = $request->address;
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }
        $data['remember_token'] = Str::random(10);
        User::where('id', $user->id)->update($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function destroy(User $user)
    {
        if ($user->id !== 1) {
            User::destroy($user->id);
            return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil dihapus!</div>');
        }
    }

    public function createUsername(Request $request)
    {
        $username = SlugService::createSlug(User::class, 'username', $request->name);
        return response()->json(['username' => $username]);
    }
}
