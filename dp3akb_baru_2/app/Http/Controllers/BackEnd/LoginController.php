<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\User;
use App\Models\Setting;
use App\Rules\ReCaptcha;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Cviebrock\EloquentSluggable\Services\SlugService;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.index', [
            'title_bar' => 'Login',
            'setting'   => Setting::firstWhere('id', 1)
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'g-recaptcha-response' => ['required', new ReCaptcha]
        ]);

        if (Auth::attempt($request->only('username', 'password'))) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->with('msg', '<div class="alert alert-danger small" role="alert">Username atau password salah!</div>');
    }

    public function forgot()
    {
        return view('auth.forgot', [
            'title_bar' => 'Lupa Password',
            'setting'   => Setting::firstWhere('id', 1)
        ]);
    }

    public function forgot_action(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'g-recaptcha-response' => ['required', new ReCaptcha]
        ]);
        $user = User::where([
            'username'  => $request->only('username'),
            'status'    => 1
        ])->first();

        if ($user) {
            $status = Password::sendResetLink(['email' => $user->email]);
            if ($status === Password::RESET_LINK_SENT) {
                return back()->with('msg', '<div class="alert small alert-success small" role="alert">Konfirmasi permintaan perubahan password telah terkirim ke email: <strong>' . $user->email . '</strong>!</div>');
            } else {
                return back()->with('msg', '<div class="alert small alert-danger small" role="alert">Tidak terdapat email pada akun Anda!</div>');
            }
        } else {
            return back()->with('msg', '<div class="alert small alert-danger small" role="alert">User tidak ditemukan!</div>');
        }
    }

    public function reset($token, Request $request)
    {
        $password_resets = DB::table('password_resets')->where('email', $request->email)->first();
        if ($password_resets && Hash::check($token, $password_resets->token)) {
            $createdAt = Carbon::parse($password_resets->created_at);
            if (!Carbon::now()->greaterThan($createdAt->addMinutes(config('auth.passwords.users.expire')))) {
                return view('auth.newpassword', [
                    'title_bar' => 'Buat Password Baru',
                    'token'     => $token,
                    'user'      => User::firstWhere('email', $request->email),
                    'setting'   => Setting::firstWhere('id', 1)
                ]);
            }
        } else {
            return abort(419);
        }
    }

    public function reset_action(Request $request)
    {
        $request->validate([
            'token'     => 'required',
            'email'     => 'required|email:dns',
            'password'  => 'required|min:3|confirmed',
            'g-recaptcha-response' => ['required', new ReCaptcha]
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('msg', '<div class="alert small alert-success small" role="alert">Password berhasil diperbarui!</div>');
        } else {
            return back()->with('msg', '<div class="alert small alert-danger small" role="alert">Password gagal diperbarui!</div>');
        }
    }

    public function registration()
    {
        $setting = Setting::where('id', 1)->first();
        return view('auth.registration', [
            'title_bar' => 'Registration',
            'setting'   => $setting
        ]);
    }

    public function register_action(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'username'      => 'required|unique:users',
            'email'         => 'required|email:dns|unique:users',
            'password'      => 'required',
            'g-recaptcha-response' => ['required', new ReCaptcha]
        ]);

        $data['name'] = $request->name;
        $data['username'] = $request->username;
        $data['email'] = $request->email;
        $data['no_phone'] = $request->no_phone;
        $data['password'] = Hash::make($request->password);
        $data['remember_token'] = Str::random(60);
        $data['status'] = false;
        $data['level_id'] = 2;

        $query = User::create($data);
        if ($query) {
            // kirim email verifikasi akun
            return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Pendaftaran Berhasil.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        } else {
            return back()->with('msg', '<div class="alert small alert-danger alert-dismissible fade show" role="alert">Pendaftaran Gagal.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/auth');
    }
}
