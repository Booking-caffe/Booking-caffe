<?php

namespace App\Http\Controllers\adminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\reservasi;
use App\Models\Transaksi;
use App\Models\MenuModel;
use Illuminate\Support\Facades\DB;

class dataReservasi extends Controller
{
     public function reservasiData(){
       
        // $reservasi = reservasi::all();
    
        $reservasi = DB::table('reservasi')
            ->join('pelanggan', 'reservasi.id_pelanggan', '=', 'pelanggan.id_pelanggan')
            ->select('reservasi.*', 'pelanggan.nama_pelanggan')
            ->get();

        return view('admin.riwayat', compact('reservasi'));
    }


    public function hapusReservasi($id)
    {
        $reservasi = reservasi::findOrFail($id);

        $reservasi->delete();
        return redirect()
            ->back()
            ->with('success', 'Reservasi berhasil dihapus!!.');
    }

    public function detail($id)
    {
        $reservasi = Reservasi::with(['pelanggan', 'dataPesanan.transaksi'])
            ->where('id_reservasi', $id)
            ->firstOrFail();

        return view('reservasi.detail', compact('reservasi'));
    }


    public function detailJson($id)
    {
        /**
            * STEP 1
            * Ambil data reservasi + pelanggan
        */
        $reservasi = DB::table('reservasi')
            ->join('pelanggan', 'reservasi.id_pelanggan', '=', 'pelanggan.id_pelanggan')
            ->where('reservasi.id_reservasi', $id)
            ->select(
                'reservasi.id_pelanggan',
                'pelanggan.nama_pelanggan',
                'reservasi.waktu',
                'reservasi.jumlah_tamu'
            )
            ->first();

        // ❌ Jika ID tidak ada (sudah dihapus)
        if (!$reservasi) {
            return response()->json([
                'message' => 'Data reservasi tidak ditemukan',
                'pesanan' => []
            ]);
        }


        /**
            * STEP 2
            * Ambil transaksi milik pelanggan tsb
        */
         $transaksi = DB::table('transaksi')
            ->where('id_pelanggan', $reservasi->id_pelanggan)
            ->select(
                'id_transaksi', 
                'status', 
                'total', 
                'metode_pembayaran'
            ) // tambahkan kolom yang dibutuhkan
            ->get(); // Bisa banyak transaksi, jadi pakai get()



        /**
            * STEP 3
            * Ambil detail pesanan + menu
        */
        $pesanan = DB::table('detail_pesanan')
            ->join('transaksi', 'detail_pesanan.id_transaksi', '=', 'transaksi.id_transaksi')
            ->join('menu', 'detail_pesanan.id_menu', '=', 'menu.id_menu')
            ->where('transaksi.id_pelanggan', $reservasi->id_pelanggan)
            ->select(
                'menu.nama_menu',
                'detail_pesanan.qty',
                'menu.harga',
                'detail_pesanan.id_transaksi' // <-- tambahkan ini
            )
            ->get();


        /**
            * STEP 4
            * Return JSON
        */
        return response()->json([
            'nama_pelanggan' => $reservasi->nama_pelanggan,
            'waktu' => $reservasi->waktu,
            'jumlah_tamu' => $reservasi->jumlah_tamu,
            'transaksi' => $transaksi,   // <-- tambahkan ini
            'pesanan' => $pesanan
        ]);
    }


    public function validasiTransaksi($id)
    {
        $transaksi = Transaksi::find($id);

        if (!$transaksi) {
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }

        $transaksi->status = 'tervalidasi';
        $transaksi->save();

        return response()->json(['message' => 'Transaksi berhasil divalidasi']);
    }

}
