<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\User;
use App\Models\Setting;
use App\Rules\ReCaptcha;
use App\Mail\Registration;
use Illuminate\Support\Str;
use App\Mail\ForgotPassword;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
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

    public function reset(Request $request)
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
            if ($user->email) {
                Mail::to($user->email)->send(new ForgotPassword($user));
                return back()->with('msg', '<div class="alert small alert-success small" role="alert">Konfirmasi permintaan perubahan password telah terkirim ke email: <strong>' . $user->email . '</strong>!</div>');
            } else {
                return back()->with('msg', '<div class="alert small alert-danger small" role="alert">Tidak terdapat email pada akun Anda!</div>');
            }
        } else {
            return back()->with('msg', '<div class="alert small alert-danger small" role="alert">User tidak ditemukan!</div>');
        }
    }

    // public function reset($token, Request $request)
    // {
    //     $password_resets = DB::table('password_resets')->where('email', $request->email)->first();
    //     if ($password_resets && Hash::check($token, $password_resets->token)) {
    //         $createdAt = Carbon::parse($password_resets->created_at);
    //         if (!Carbon::now()->greaterThan($createdAt->addMinutes(config('auth.passwords.users.expire')))) {
    //             return view('auth.newpassword', [
    //                 'title_bar' => 'Buat Password Baru',
    //                 'token'     => $token,
    //                 'user'      => User::firstWhere('email', $request->email),
    //                 'setting'   => Setting::firstWhere('id', 1)
    //             ]);
    //         }
    //     } else {
    //         return abort(419);
    //     }
    // }

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
                'user'      => $user,
                'setting'   => Setting::firstWhere('id', 1)
            ]);
        } else {
            return redirect('/auth/forgot')->with('msg', '<div class="alert small alert-danger small" role="alert">Token akses tidak valid!</div>');
        }
    }

    public function newpassword(Request $request)
    {
        $data = $request->validate([
            'username'          => 'required|min:3|max:255',
            'remember_token'    => 'required|min:10|max:255'
        ]);
        $data['status'] = 1;
        $user = User::firstWhere($data);
        if ($user) {
            return view('auth.newpassword', [
                'title_bar' => 'Buat Password Baru',
                'user'      => $user
            ]);
        } else {
            return redirect('/auth/forgot')->with('msg', '<div class="alert alert-danger small" role="alert">Username atau token tidak valid!</div>');
        }
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'username'              => $request->username !== $user->username ? 'required|min:3|max:255|unique:users' : 'required|min:3|max:255',
            'email'                 => $request->email !== $user->email ? 'required|email:dns|min:5|max:255|unique:users' : 'required|email:dns|min:5|max:255',
            'password'              => 'required|min:3|max:255',
            'g-recaptcha-response'  => ['required', new ReCaptcha]
        ]);

        $data['email']  = $request->email !== $user->email ? $request->email : $user->email;
        $data['username'] = $request->username !== $user->username ? SlugService::createSlug(User::class, 'username', $user->name) : $user->username;
        $data['password'] = Hash::make($request->password);
        $data['remember_token'] = Str::random(10);
        User::where('id', $user->id)->update($data);
        return redirect('/auth')->with('msg', '<div class="alert alert-success small" role="alert">Password berhasil diubah, silahkan login!</div>');
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
            $admin = User::where('id', 1)->first();
            Mail::to($admin->email)->send(new Registration($query));
            return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Pendaftaran Berhasil. Silahkan Tunggu Email Verifikasi dari Admin.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
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
