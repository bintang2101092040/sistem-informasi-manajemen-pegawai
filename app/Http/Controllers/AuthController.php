<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    // login user
    // login user
    public function proseslogin(Request $request)
    {
        $credentials = $request->only('nama_lengkap_or_email', 'password');

        // Cek apakah pengguna memasukkan email atau nama lengkap
        $field = filter_var($credentials['nama_lengkap_or_email'], FILTER_VALIDATE_EMAIL) ? 'email' : 'nama_lengkap';

        // Buat array baru hanya dengan kunci yang valid
        if ($field == 'email') {
            $credentials = [
                'email' => $credentials['nama_lengkap_or_email'],
                'password' => $credentials['password']
            ];
        } else {
            $nama_depan = explode(' ', $credentials['nama_lengkap_or_email'])[0];
            $karyawan = Karyawan::whereRaw('LOWER(SUBSTRING_INDEX(nama_lengkap, " ", 1)) = ?', [strtolower($nama_depan)])->first();

            if ($karyawan && Hash::check($credentials['password'], $karyawan->password)) {
                Auth::guard('karyawan')->login($karyawan);
                return redirect('/dashboard');
            } else {
                return redirect('/')->with(['warning' => 'Username atau Password Salah']);
            }
        }

        if (Auth::guard('karyawan')->attempt($credentials)) {
            return redirect('/dashboard');
        } else {
            return redirect('/')->with(['warning' => 'Email atau Password Salah']);
        }
    }


    //logout user
    public function proseslogout(Request $request)
    {
        if (Auth::guard('karyawan')->check()) {
            Auth::guard('karyawan')->logout();
            return redirect('/');
        }
    }

    //logout admin
    public function proseslogoutadmin(Request $request)
    {
        if (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
            return redirect('/panel');
        }
    }

    //login admin
    public function prosesloginadmin(Request $request)
    {
        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
            if ($request->email === 'gilanghandevis03@gmail.com') {
                return redirect('/panelowner');
            } else {
                return redirect('panel/dashboardadmin');
            }
        } else {
            return redirect('/panel')->with(['warning' => 'Email / Password Salah']);
        }
    }
}
