<?php

namespace App\Http\Controllers\Backs;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\ReCaptcha;
use Illuminate\Support\Str;
use App\Mail\ForgotPassword;
use App\Models\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{

    public function index()
    {
        return view('auth.index', [
            'title_bar' => 'Login'
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'username'              => ['required', 'min:4', 'max:100'],
            'password'              => ['required', 'min:4', 'max:255'],
            'g-recaptcha-response'  => ['required', new ReCaptcha]
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password, 'status' => 1])) {
            $request->session()->regenerate();
            return redirect('/dashboard1')->with('toast_success', 'Selamat Datang');
        }

        return back()->withInput()->with('msg', '<div class="alert small alert-danger small" role="alert">Username atau Password Salah!</div>');
    }

    public function forgot()
    {
        return view('auth.forgot', [
            'title_bar' => 'Lupa Password'
        ]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'username'              => 'required|min:4|max:255',
            'g-recaptcha-response'  => 'required|recaptchav3:forgot,0.5',
            'g-recaptcha-response'  => ['required', new ReCaptcha]
        ]);
        $user = User::where('username', $request->username)->first();
        if ($user) {
            if ($user->email) {
                Mail::to($user->email)->send(new ForgotPassword($user));
                return back()->with('msg', '<div class="alert small alert-success small" role="alert">Konfirmasi permintaan perubahan password telah terkirim ke email!</div>');
            } else {
                return back()->with('msg', '<div class="alert small alert-danger small" role="alert">Tidak terdapat email pada akun Anda!</div>');
            }
        } else {
            return back()->with('msg', '<div class="alert small alert-danger small" role="alert">User tidak ditemukan!</div>');
        }
    }

    public function confirm(Request $request)
    {
        $user = User::where(['username' => $request->user, 'remember_token' => $request->token])->first();
        if ($user) {
            if (PasswordReset::where(['email' => $user->email, 'token' => $user->remember_token])->count() === 0) {
                PasswordReset::create(['email' => $user->email, 'token' => $user->remember_token]);
            } else {
                PasswordReset::where(['email' => $user->email, 'token' => $user->remember_token])->update(['email' => $user->email, 'token' => $user->remember_token]);
            }
            return view('auth.newpassword', [
                'title_bar' => 'Ganti Password',
                'user'      => $user
            ]);
        } else {
            return redirect('/auth/forgot')->with('msg', '<div class="alert small alert-danger small" role="alert">Token akses tidak valid!</div>');
        }
    }

    public function newpassword(Request $request)
    {
        $request->validate([
            'password'              => 'required|min:4|max:255',
            'username'              => 'required|min:4|max:255',
            'email'                 => 'required|email:dns|min:4|max:255',
            'g-recaptcha-response'  => ['required', new ReCaptcha]
        ]);
        $user = User::where('id', $request->id)->first();

        $data['username'] = $user->username;
        $data['email'] = $user->email;
        $data['password'] = Hash::make($request->password);
        $data['remember_token'] = Str::random(60);
        $user->where('id', $user->id)->update($data);

        return redirect('/auth')->with('msg', '<div class="alert small alert-success small" role="alert">Password berhasil diperbarui!</div>');
    }

    public function logout(Request $request)
    {

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/auth');
    }
}