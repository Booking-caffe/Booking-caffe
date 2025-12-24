<?php

namespace App\Http\Controllers;

use App\Models\pelangganModel;
use App\Models\reservasi;
use App\Models\detailPesanan;
use App\Models\Transaksi;
use App\Models\admin\menuModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


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
        'tipe_ruangan' => 'required',
        'nomor_meja' => 'required'
        ]);

        $jumlahMeja = Session::get('dataReservasi')['jumlahMeja'];
        $mejaDipilih = Session::get('mejaDipilih', []);

        // Bentuk data meja TERSTRUKTUR
        $mejaBaru = [
            'tipe_ruangan' => $request->tipe_ruangan,
            'nomor_meja'   => $request->nomor_meja,
        ];

        // Cegah meja duplicate
        foreach ($mejaDipilih as $meja) {
            if (
                $meja['tipe_ruangan'] === $mejaBaru['tipe_ruangan'] &&
                $meja['nomor_meja'] === $mejaBaru['nomor_meja']
            ) {
                return back()->with('gagal', 'Meja sudah dipilih!');
            }
        }

        // Simpan meja baru
        $mejaDipilih[] = $mejaBaru;
        Session::put('mejaDipilih', $mejaDipilih);

        // Jika belum cukup → tetap di halaman
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
    public function detailTransaksi($id)
    {
        $reservasi = Reservasi::findOrFail($id);
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

        return view('User.detail-transaksi', compact('data', 'meja', 'pesanan', 'totalHarga', 'pajak', 'totalBayar', 'reservasi'));
    }

    
    // ============================
    // STEP 4 : BUKTI PEMBAYARAN & SIMPAN  DATA
    // ============================
    public function uploadBukti(Request $request)
    {
        
        $request->validate([
            'bukti-pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        
        $id_pelanggan = session('id_pelanggan');
        $jumlahMeja  = Session::get('dataReservasi.jumlahMeja');
        $mejaDipilih = Session::get('mejaDipilih', []);

        // gabungan ruangan + meja
        $meja = [
            'ruangan'    => $request->tipe_ruangan,
            'nomor_meja' => $request->nomor_meja,
        ];

        $data = Session::get('dataReservasi');
        // $meja = Session::get('mejaDipilih');

        $pesanan = Session::get('keranjang');

        if (!$data || !$meja) {
            return redirect()->route('reservasi')
                ->with('gagal', 'Data reservasi tidak lengkap.');
        }


        // Simpan file
        $path = $request->file('bukti-pembayaran')->store('bukti-pembayaran');

        
        DB::beginTransaction();

        try {

            // SIMPAN RESERVASI
            $ruanganChosed = [];
            $mejaChosed = [];
            
            foreach ($mejaDipilih as $ruanganMeja) {
                array_push($ruanganChosed, 
                    $ruanganMeja['tipe_ruangan']
                );

                array_push($mejaChosed, 
                    $ruanganMeja['nomor_meja']
                );
            }

            
            // dd($mejaChosed,$ruanganChosed);  
            // Simpan ke database
            $reservasi = Reservasi::create([
                
                'id_pelanggan' => $id_pelanggan, // ✅ WAJIB// 'nama'             => $data['nama'],
                //  'id_pengelola' => Session::get('id_pengelola'),
                 'id_pengelola' => null,
                
                // (ID_PENGELOLA MASIH BERMASALAH (Defaultnya dibuatkan menjadi null dulu, setelah di konfirmasi baru nanti terupdate menjadi id_pengelola yang mengupdatenya))
                // 'id_pengelola'     => 1, 
                'no_hp'            => $data['noHp'],
                'tanggal'          => $data['tanggal'],
                'waktu'            => $data['waktu'],
                'jumlah_tamu'      => $data['jumlahTamu'],
                'ruangan'          => json_encode($ruanganChosed),
                'nomor_meja'       => json_encode($mejaChosed),
                // 'bukti_pembayaran' => $path,
                
            ]);

            // dd($reservasi);


            //  SIMPAN TRANSAKSI
            $transaksi = Transaksi::create([
                // 'id_transaksi' => time(), // contoh generate id
                'id_pelanggan'      => $id_pelanggan,
                'total'             => 0,
                'status'            => 'menunggu',
                'metode_pembayaran' => 'QRIS'
            ]);

            // dd($transaksi);

            $pesanan = Session::get('keranjang');
            $totalHarga = 0;

            if ($pesanan) {
                foreach ($pesanan as $item) {
                    $totalHarga += $item['harga'] * $item['qty'];
                }
            }

            // SIMPAN DETAIL PESANAN
            $total = 0;
            // $noDetail = 1;

            foreach ($pesanan as $item) {

                $menu = menuModel::findOrFail($item['id_menu']);

                DetailPesanan::create([
                    // 'id_detail_pesanan' => $transaksi->id_transaksi . $noDetail,
                    'id_transaksi'      => $transaksi->id_transaksi,
                    'id_menu'           => $menu->id_menu,
                    'qty'               => $item['qty'],
                ]);

                $total += $item['harga'] * $item['qty'];
                // $noDetail++;
            }

            // dd($menu); 

            // UPDATE TRANSAKSI
            $transaksi->update(['total' => $total]);

            DB::commit();

            // Bersihkan session
            Session::forget([
                'dataReservasi',
                'mejaDipilih',
                'keranjang'
            ]);

            return Redirect()->route('detail-transaksi', $reservasi->id_reservasi)->with('success', 'Bukti pembayaran berhasil diupload!');

        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            // return back()->with('error', $th->getMessage());
        }
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
