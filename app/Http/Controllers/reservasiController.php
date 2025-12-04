<?php

namespace App\Http\Controllers;

use App\Models\pelangganModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class reservasiController extends Controller
{
    //
    public function showResevasi()
    {
        if (session('id_pelanggan') === null) {
            return redirect()->route('login')->with('success', 'untuk melakukan reservasi harap login terlebih dahulu!');
            
        }else {
             // Mengambil Data Session
            $id_pelanggan = session('id_pelanggan');   
            $pelanggan = pelangganModel::where('id_pelanggan', '=', $id_pelanggan)
            ->get();
            return view('User.reservasi', compact('pelanggan'));
        }

        
    }


    public function formReservasi(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'no_hp' => 'required',
            'waktu' => 'required',
            'jumlah_tamu' => 'required|numeric',
            'tanggal' => 'required',
            
        ]);

        // Mengambil Data Session
        $data = [
            'nama' => $request->nama,
            'noHp' => $request->no_hp,
            'jumlahTamu' => $request->jumlah_tamu,
            'waktu' => $request->waktu,
            'tanggal' => $request->tanggal,
        ];

        Session::put('dataReservasi', $data);
        
        // dd(Session::get('dataReservasi'));
        return redirect()->route('tempat-duduk');
    }

    // ============================
    // STEP 2 : PEMILIHAN MEJA
    // ============================
    public function showTempatDuduk()
    {
        
        return view('User.tempat-duduk');
    }

    public function pilihTempatDuduk(Request $request)
    {
        // Validasi: meja wajib dipilih
        $request->validate([
            'meja' => 'required'
        ]);

        // Simpan meja terpilih
        Session::put('mejaDipilih', $request->meja);

        return redirect()->route('detail-pesanan')
                        ->with('success', 'Meja berhasil dipilih!');
    }
 
    // ============================
    // STEP 3 : DETAIL PESANAN
    // ============================
    public function detailPesanan()
    {
        $data = Session::get('dataReservasi');
        $meja = Session::get('mejaDipilih');

        if (!$data || !$meja) {
            return redirect()->route('reservasi')
                ->with('gagal', 'Data reservasi belum lengkap.');
        }

        return view('User.detail-pesanan', compact('data', 'meja'));
    }

    // ============================
    // STEP 4 : SIMPAN KE DATABASE
    // ============================
    public function simpanReservasi()
    {
       
        $data = Session::get('dataReservasi');
        $meja = Session::get('mejaDipilih');

        if (!$data || !$meja) {
            return redirect()->route('reservasi')
                ->with('gagal', 'Data reservasi tidak lengkap.');
        }

        // Simpan ke database
        Reservasi::create([
            'nama'         => $data['nama'],
            'no_hp'        => $data['noHp'],
            'tanggal'      => $data['tanggal'],
            'waktu'        => $data['waktu'],
            'jumlah_tamu'  => $data['jumlahTamu'],
            'meja'         => $meja,
        ]);

        // Hapus session setelah selesai
        Session::forget(['dataReservasi', 'mejaDipilih']);

        return redirect()->route('reservasi-berhasil')
            ->with('success', 'Reservasi berhasil disimpan!');
    
    }
    

    

}
