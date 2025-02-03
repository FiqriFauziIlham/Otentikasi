<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\RateLimiter;

class LoginController extends Controller
{
    public function login()
    {
        if(Auth::check()){
            return redirect('home');
        }else {
            return view ('login');
        }
    }

    public function actionLogin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $emailKey = 'login-attempts:' . $email;
        $globalKey = 'global-login-attempts';

        if (RateLimiter::tooManyAttempts($globalKey, 5) || RateLimiter::tooManyAttempts($emailKey, 5)) {
            $seconds = max(
                RateLimiter::availableIn($globalKey),
                RateLimiter::availableIn($emailKey)
            );
            Session::flash('error', "Anda telah mencoba login terlalu sering. Silakan coba lagi dalam $seconds detik.");
            return redirect()->back();
        }

        $user = User::where('email', $email)->first();
        if (!$user) {
            RateLimiter::hit($emailKey, 60);
            RateLimiter::hit($globalKey, 60);
            Session::flash('error', 'Email Salah');
            return redirect()->back();
        }

        if (!Hash::check($password, $user->password)) {
            RateLimiter::hit($emailKey, 60);
            RateLimiter::hit($globalKey, 60);
            Session::flash('error', 'Password Salah');
            return redirect()->back();
        }
        
        Auth::login($user);
        RateLimiter::clear($emailKey);
        RateLimiter::clear($globalKey);
        return redirect('home');
    }

    public function actionLogout()
    {
        Auth::Logout();
        return redirect ('/');
    }

    public function registrasi()
    {
        return view ('registrasi');
    }

    public function create(Request $request)
    {
        Session::flash('name', $request->name);
        $existingUser = User::where('email', $request->email)->first();
        if ($existingUser) {
            Session::flash('error', 'Email sama, gunakan yang lain.');
            return redirect()->back()->withInput();
        }
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'alamat' => 'required',
            'nohp' => 'required',
        ], [
            'name.required' => 'Nama Wajib Diisi',
            'email.required' => 'Email Wajib Diisi',
            'email.email' => 'Silakan masukan email yang valid',
            'email.unique' => 'Email sudah pernah digunakan, silakan pilih email yang lain',
            'password.required' => 'Password Wajib Diisi',
            'password.min' => 'Password harus minimal 6 karakter.',
            'alamat.required' => 'Alamat Wajib Diisi',
            'nohp.required' => 'Nomor HP Wajib Diisi',
        ]);

        // Jika validasi lolos, buat data baru
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat,
            'nohp' => $request->nohp,
            'role' => 'user',
        ];
        User::create($data);

        return redirect('/')->with('success', 'Registrasi berhasil.');
    }

}


