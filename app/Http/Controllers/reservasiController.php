<?php

namespace App\Http\Controllers;

use App\Models\pelangganModel;
use App\Models\reservasi;
use App\Models\detailPesanan;
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
            'jumlah_meja' => 'required|numeric',
            'tanggal' => 'required',
            
        ]);

        // Mengambil Data Session
        $data = [
            'nama' => $request->nama,
            'noHp' => $request->no_hp,
            'jumlahTamu' => $request->jumlah_tamu,
            'jumlahMeja' => $request->jumlah_meja,
            'waktu' => $request->waktu,
            'tanggal' => $request->tanggal,
        ];

        session([
            'dataReservasi' => $data,
            'jumlahMejaDipilih' => 0,
            'mejaDipilih' => []
        ]);
        
        // dd(Session::get('dataReservasi'));
        return redirect()->route('tempat-duduk');
    }

    // ============================
    // STEP 2 : PEMILIHAN MEJA
    // ============================
    public function showTempatDuduk()
    {
        $data = session('dataReservasi');

        // dd(session()->all());
        if (!$data) {
            return redirect()->route('reservasi')
                ->with('gagal', 'Silakan isi form reservasi terlebih dahulu.');
        }

        $jumlahMeja = $data['jumlahMeja'];
        $mejaDipilih = session('mejaDipilih', []);

        return view('User.tempat-duduk', compact('jumlahMeja', 'mejaDipilih'));
    }

    public function pilihTempatDuduk(Request $request)
    {
        $request->validate([
        'meja' => 'required'
        ]);

        $jumlahMeja = Session::get('dataReservasi')['jumlahMeja'];
        $mejaDipilih = Session::get('mejaDipilih', []);

        // Cegah meja duplicate
        if (in_array($request->meja, $mejaDipilih)) {
            return back()->with('gagal', 'Meja sudah dipilih!');
        }

        // Simpan meja yang baru dipilih
        $mejaDipilih[] = $request->meja;
        Session::put('mejaDipilih', $mejaDipilih);

        // Jika belum cukup → tetap di halaman yang sama
        if (count($mejaDipilih) < $jumlahMeja) {
            return back()->with('success', 'Meja berhasil dipilih!');
        }

        // Jika sudah cukup → lanjut ke detail pesanan
        return redirect()->route('detail-pesanan')->with('success', 'Semua meja berhasil dipilih!');
    }
 
    // ============================
    // STEP 3 : DETAIL PESANAN
    // ============================
    public function detailPesanan()
    {
        $data = Session::get('dataReservasi');
        $meja = Session::get('mejaDipilih');
        $pesanan = Session::get('keranjang');
        


        $totalHarga = 0;

        if ($pesanan) {
            foreach ($pesanan as $item) {
                $totalHarga += $item['harga'] * $item['qty'];
            }
        }

        $pajak = $totalHarga*0.1;
        $totalBayar = $totalHarga + $pajak;



        if (!$data || !$meja) {
            return redirect()->route('reservasi')
                ->with('gagal', 'Data reservasi belum lengkap.');
        }

        return view('User.detail-pesanan', compact('data', 'meja', 'pesanan', 'totalHarga', 'pajak', 'totalBayar'));
    }


     // ============================
    // STEP 3 : DETAIL PESANAN
    // ============================
    public function detailTransaksi()
    {
        $data = Session::get('dataReservasi');
        $meja = Session::get('mejaDipilih');
        $pesanan = Session::get('keranjang');
        $totalHarga = 0;

        if ($pesanan) {
            foreach ($pesanan as $item) {
                $totalHarga += $item['harga'] * $item['qty'];
            }
        }

        $pajak = $totalHarga*0.1;
        $totalBayar = $totalHarga + $pajak;



        if (!$data || !$meja) {
            return redirect()->route('reservasi')
                ->with('gagal', 'Data reservasi belum lengkap.');
        }

        return view('User.detail-transaksi', compact('data', 'meja', 'pesanan', 'totalHarga', 'pajak', 'totalBayar'));
    }


    
    // ============================
    // STEP 4 : BUKTI PEMBAYARAN 
    // ============================
    public function uploadBukti(Request $request)
    {
        
        $request->validate([
            'bukti-pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);
        
        // Simpan file
        $path = $request->file('bukti-pembayaran')->store('bukti-pembayaran');
        
        // dd($request->file('bukti-pembayaran'));
        
        // Simpan ke database jika perlu
        // Pembayaran::create([
        //     'user_id' => auth()->id(),
        //     'bukti' => $path
        // ]);

        return Redirect()->route('detail-transaksi')->with('success', 'Bukti pembayaran berhasil diupload!');
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
