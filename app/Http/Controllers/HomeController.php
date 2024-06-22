<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Session\Session;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index()
    {

        $data = [
            'title' => 'Beranda',

        ];
        return view('beranda', $data);
    }
    public function login()
    {
        $data = [
            'title' => 'Login',
        ];
        return view('login', $data);
    }

    public function logincek(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $akun = DB::table('pengguna')
            ->where('email', $email)
            ->where('password', $password)
            ->first();
        if ($akun) {
            session(['pengguna' => $akun]);
            return redirect('pengguna/dashboard')->with('success', 'Login Berhasil');
        } else {
            return redirect()->back()->with('error', 'Anda gagal login, Email atau password salah');
        }
    }

    public function daftar()
    {
        return view('daftar');
    }

    public function dodaftar(Request $request)
    {
        $namapengguna = $request->input('namapengguna');
        $email = $request->input('email');
        $password = $request->input('password');
        $notelp = $request->input('notelp');
        $existingUser = DB::table('pengguna')->where('email', $email)->count();
        if ($existingUser == 1) {
            return redirect()->back()->with('alert', 'Pendaftaran Gagal, email sudah ada');
        } else {
            DB::table('pengguna')->insert([
                'namapengguna' => $namapengguna,
                'email' => $email,
                'password' => $password,
                'notelp' => $notelp,
            ]);
            return redirect('loginakun')->with('success', 'Pendaftaran Berhasil, Silahkan login');
        }
    }
}
