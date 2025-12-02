<?php

namespace App\Http\Controllers;

use App\Models\pelangganModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    // show halaman login 
    public function showLogin(){
        
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

        // cek apakah password ada atau tidak di db
        $pelanggan = pelangganModel::where('username', '=', $request->username)
            ->where('password', '=', $request->password)
            ->get();

        // instance var id_pelanggan dan nama pelanggan
        $id_pelanggan = null;
        $nama_pelanggan = null;

        // ambil id_pelanggan dan nama pelanggan dan menyinpan di var id pelanggan dan nama pelanggan
        foreach ($pelanggan  as $ambilDataPelanggan) {
            $id_pelanggan = $ambilDataPelanggan->id_pelanggan;
            $nama_pelanggan = $ambilDataPelanggan->nama_pelanggan;
        }

        // menyimpan id dan nama pelanggan di session
        if (count($pelanggan) !== 0) {
            Session::put('id_pelanggan', $id_pelanggan);
            Session::put('nama_pelanggan', $nama_pelanggan);
            return redirect()->route('home');
        }else {
            return back()->with('gagal', 'username dan password tidak sesuai!');
        }
        
    }

    // logout pelanggan
    public function logutPelanggan(Request $request)
    {
        // hapus session id dan nama pelanggan
        Session::forget('id_pelanggan');
        Session::forget('nama_pelanggan');

        // back landing page
        return view('home');
    }
}
