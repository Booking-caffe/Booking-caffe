<?php

namespace App\Http\Controllers;

use App\Models\pelangganModel;
use App\Models\PengelolaModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // show halaman login 
    public function showLogin()
    {

        return view('auth.login');
    }

    // login pelanggan
    public function loginPelanggan(Request $request)
    {
        // ambil input username dan password
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // CARI pelanggan berdasarkan username
        $pelanggan = pelangganModel::where('username', $request->username)->first();

        // Jika username ditemukan dan password cocok
        // if ($pelanggan && Hash::check($request->password, $pelanggan->password)) {
        //     Session::put('id_pelanggan', $pelanggan->id_pelanggan);
        //     Session::put('nama_pelanggan', $pelanggan->nama_pelanggan);
        //     return redirect()->route('home');
        // }
        
        if ($pelanggan && $request->password === $pelanggan->password) {
            Session::put('id_pelanggan', $pelanggan->id_pelanggan);
            Session::put('nama_pelanggan', $pelanggan->nama_pelanggan);
            return redirect()->route('home');
        }

        // CARI pengelola berdasarkan username
        $pengelola = PengelolaModel::where('username', $request->username)->first();

        // mengambil password dan usernma pelanggan ada atau tidak di db
        // if ($pelanggan && Hash::check($request->password, $pelanggan->password)) {
        //     Session::put('id_pelanggan', $pelanggan->id_pelanggan);
        //     Session::put('nama_pelanggan', $pelanggan->nama_pelanggan);
        //     return redirect()->route('home');
        // }

        // $pelanggan = pelangganModel::where('username', '=', $request->username)
        //     ->where('password', '=', $request->password)
        //     ->get();

        // mengambil password dan usernma pengelola di db
        $pengelola = PengelolaModel::where('username', '=', $request->username)
            ->where('password', '=', $request->password)
            ->get();

        // intance var id pengelola dan nama pengelola
        $id_pengelola = null;
        $nama_pengelola = null;

        // instance var id_pelanggan dan nama pelanggan
        $id_pelanggan = null;
        $nama_pelanggan = null;

        // ambil id_pelanggan dan nama pelanggan dan menyinpan di var id pelanggan dan nama pelanggan
        // foreach ($pelanggan  as $ambilDataPelanggan) {
        //     $id_pelanggan = $ambilDataPelanggan->id_pelanggan;
        //     $nama_pelanggan = $ambilDataPelanggan->nama_pelanggan;
        // }

        // ambil id pengelola dan nama pengelola kemudian menyimpan di var instace id dan nama pengelola
        // foreach ($pengelola  as $ambilDataPengelola) {
        //     $id_pengelola = $ambilDataPengelola->id_pengelola;
        //     $nama_pengelola = $ambilDataPengelola->nama_pengelola;
        // }

        // Jika username ditemukan dan password cocok
        // if ($pelanggan && Hash::check($request->password, $pelanggan->password)) {
        //     Session::put('id_pelanggan', $pelanggan->id_pelanggan);
        //     Session::put('nama_pelanggan', $pelanggan->nama_pelanggan);
        //     return redirect()->route('home');
        // }
        
        // if ($pelanggan && $request->password === $pelanggan->password) {
        //     Session::put('id_pelanggan', $pelanggan->id_pelanggan);
        //     Session::put('nama_pelanggan', $pelanggan->nama_pelanggan);
        //     return redirect()->route('home');
        // }
        
         // CARI pengelola berdasarkan username
        $pengelola = PengelolaModel::where('username', $request->username)->first();

        if ($pengelola && $request->password === $pengelola->password) {
            Session::put('id_pengelola', $pengelola->id_pengelola);
            Session::put('nama_pengelola', $pengelola->nama_pengelola);
            return redirect()->route('admin.dashboard');
        }


        // menyimpan id dan nama pelanggan di session
        // if (count($pelanggan) !== 0) {
        //     Session::put('id_pelanggan', $id_pelanggan);
        //     Session::put('nama_pelanggan', $nama_pelanggan);
        //     return redirect()->route('home');
        // } elseif (count($pengelola) !== 0) {
        //     Session::put('id_pengelola', $id_pengelola);
        //     Session::put('nama_pengelola', $nama_pengelola);
        //     return redirect()->route('home-admin');
        // } else {
        //     return back()->with('gagal', 'username dan password tidak sesuai!');
        // }
    }

    // logout pelanggan
    public function logutPelanggan(Request $request)
    {
        // hapus session id dan nama pelanggan
        Session::forget('id_pelanggan');
        Session::forget('nama_pelanggan');
        session()->forget('keranjang');
        session()->forget('reservasi');

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // back landing page
        return view('home');
    }

    // logout pengelola
    public function logutPengelola(Request $request)
    {
        // hapus session id dan nama pelanggan
        Session::forget('id_pengelola');
        Session::forget('nama_pengelola');

        // back landing page
        return Redirect()->route('login');
    }
    
}
