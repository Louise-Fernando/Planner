<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Session\Session;
use Illuminate\View\View;

class PenggunaController extends Controller
{
    public function dashboard()
    {
        // if (empty(session('pengguna'))) {
        //     session()->flash('error', 'Harap login terlebih dahulu');
        //     return redirect('loginakun');
        // }
        $idpengguna = session('pengguna')->idpengguna;
        $kegiatan = DB::table('kegiatan')->where('idpengguna', $idpengguna)->get();
        $jumlahkegiatan = DB::table('kegiatan')->where('idpengguna', $idpengguna)->count();
        $data = [
            'title' => 'Selamat Datang ' . session('pengguna')->namapengguna . ' Di Panel Web Time Schedule',
            'kegiatan' => $kegiatan,
            'jumlahkegiatan' => $jumlahkegiatan,
        ];
        return view('pengguna/dashboard', $data);
    }
    public function logout()
    {
        session()->flush();
        return redirect('/loginakun');
    }

    public function kegiatandaftar()
    {
        if (empty(session('pengguna'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $idpengguna = session('pengguna')->idpengguna;
        $kegiatan = DB::table('kegiatan')->where('idpengguna', $idpengguna)->get();
        $data = [
            'title' => 'Daftar Kegiatan',
            'kegiatan' => $kegiatan,
        ];
        return view('pengguna/kegiatandaftar', $data);
    }

    public function kegiatantambah()
    {
        $idpengguna = session('pengguna')->idpengguna;
        $data = [
            'title' => 'Tambah Kegiatan',
        ];
        return view('pengguna/kegiatantambah', $data);
    }

    public function kegiatantambahsimpan(Request $request)
    {
        $idpengguna = session('pengguna')->idpengguna;

        $namafile = null;
        if ($request->hasFile('file')) {
            $filekegiatan = $request->file('file')->getClientOriginalName();
            $namafile = date('YmdHis') . $filekegiatan;
            $request->file('file')->move(public_path('kegiatan'), $namafile);
        }

        $namakegiatan = $request->input('namakegiatan');
        $deskripsikegiatan = $request->input('deskripsikegiatan');
        $tanggal = $request->input('tanggal');
        $simpan = [
            'idpengguna' => $idpengguna,
            'namakegiatan' => $namakegiatan,
            'deskripsikegiatan' => $deskripsikegiatan,
            'tanggal' => $tanggal,
            'file' => $namafile,
        ];
        DB::table('kegiatan')->insert($simpan);

        session()->flash('success', 'Berhasil menambahkan data!');
        return redirect('pengguna/kegiatandaftar');
    }


    public function kegiatanedit($id)
    {

        $row = DB::table('kegiatan')->where('idkegiatan', $id)->first();
        $data = [
            'title' => 'Edit Kegiatan',
            'row' => $row,
        ];
        return view('pengguna/kegiatanedit', $data);
    }
    public function kegiataneditsimpan(Request $request, $id)
    {

        $namakegiatan = $request->input('namakegiatan');
        $deskripsikegiatan = $request->input('deskripsikegiatan');
        $tanggal = $request->input('tanggal');
        $data = [
            'namakegiatan' => $namakegiatan,
            'deskripsikegiatan' => $deskripsikegiatan,
            'tanggal' => $tanggal,
        ];
        if ($request->hasFile('file')) {
            $filekegiatan = $request->file('file')->getClientOriginalName();
            $namafile = date('YmdHis') . $filekegiatan;
            $request->file('file')->move(public_path('kegiatan'), $namafile);
            $data['file'] = $namafile;
        }
        DB::table('kegiatan')->where('idkegiatan', $id)->update($data);
        session()->flash('success', 'Data berhasil diedit!');
        return redirect('pengguna/kegiatandaftar');
    }
    public function kegiatanhapus($id)
    {

        DB::table('kegiatan')->where('idkegiatan', $id)->delete();
        session()->flash('success', 'Berhasil menghapus data!');
        return redirect('pengguna/kegiatandaftar');
    }
    public function profil()
    {
        if (empty(session('pengguna'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $id = session('pengguna')->idpengguna;
        $row = DB::table('pengguna')->where('idpengguna', $id)->first();
        $data = [
            'title' => 'Profil',
            'row' => $row,
        ];
        return view('pengguna/profil', $data);
    }
    public function profiledit()
    {
        if (empty(session('pengguna'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $id = session('pengguna')->idpengguna;
        $row = DB::table('pengguna')->where('idpengguna', $id)->first();
        $data = [
            'title' => 'Edit Profile',
            'row' => $row,
        ];
        return view('pengguna/profiledit', $data);
    }
    public function profileditsimpan(Request $request)
    {
        if (empty(session('pengguna'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $id = session('pengguna')->idpengguna;
        $data = [
            'namapengguna' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'notelp' => $request->input('notelp'),
        ];
        DB::table('pengguna')->where('idpengguna', $id)->update($data);
        session()->flash('success', 'Data berhasil diedit!');
        return redirect('pengguna/profil');
    }

    // Keuangan
    public function keuangandaftar()
    {
        if (empty(session('pengguna'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $idpengguna = session('pengguna')->idpengguna;
        $data['keuangan'] = DB::table('keuangan')->join('pengguna', 'keuangan.idpengguna', '=', 'pengguna.idpengguna')->where('keuangan.idpengguna', $idpengguna)->get();
        $data['title'] = 'Keuangan';
        return view('pengguna.keuangandaftar', $data);
    }

    public function keuangantambah()
    {
        if (empty(session('pengguna'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $pengguna = DB::table('pengguna')->get();
        $data = [
            'title' => 'Tambah Keuangan',
            'pengguna' => $pengguna,
        ];
        return view('pengguna.keuangantambah', $data);
    }

    public function keuangantambahsimpan(Request $request)
    {
        if (empty(session('pengguna'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $idpengguna = session('pengguna')->idpengguna;
        DB::table('keuangan')->insert([
            'idpengguna' => $idpengguna,
            'judul' => $request->judul,
            'keterangan' => $request->keterangan,
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
            'tipe' => $request->tipe,
        ]);
        session()->flash('success', 'Berhasil menambahkan data!');
        return redirect('pengguna/keuangandaftar');
    }

    public function keuanganedit($id)
    {
        if (empty(session('pengguna'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        $row = DB::table('keuangan')->where('idkeuangan', $id)->first();
        $data = [
            'title' => 'Edit Keuangan',
            'row' => $row,
        ];
        // dd($data);
        return view('pengguna/keuanganedit', $data);
    }

    public function keuanganeditsimpan(Request $request, $id)
    {
        if (empty(session('pengguna'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        DB::table('keuangan')->where('idkeuangan', $id)->update([
            'judul' => $request->judul,
            'keterangan' => $request->keterangan,
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
            'tipe' => $request->tipe,
        ]);
        session()->flash('success', 'Berhasil mengedit data!');
        return redirect('pengguna/keuangandaftar');
    }

    public function keuanganhapus($id)
    {
        if (empty(session('pengguna'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }
        DB::table('keuangan')->where('idkeuangan', $id)->delete();
        session()->flash('success', 'Berhasil mengedit data!');
        return back();
    }

    public function keuanganfilter(Request $request)
    {
        if (empty(session('pengguna'))) {
            session()->flash('error', 'Harap login terlebih dahulu');
            return redirect('loginakun');
        }

        $idpengguna = session('pengguna')->idpengguna;

        $data['keuangan'] = DB::table('keuangan')
            ->join('pengguna', 'keuangan.idpengguna', '=', 'pengguna.idpengguna')
            ->where('keuangan.idpengguna', $idpengguna)
            ->where('keuangan.tanggal', '>=', $request->tanggal_awal)
            ->where('keuangan.tanggal', '<=', $request->tanggal_akhir)
            ->get();

        $data['title'] = 'Keuangan';
        return view('pengguna.keuangandaftar', $data);
    }
}
