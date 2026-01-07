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
            ->get()
            ->map(function ($r) {
                $r->ruangan = json_decode($r->ruangan, true);
                $r->nomor_meja = json_decode($r->nomor_meja, true);
                return $r;
            });

        return view('admin.riwayat', compact('reservasi'));
    }


    public function hapusReservasi($id)
    {
        DB::beginTransaction();

        try {
            // Ambil reservasi
            $reservasi = Reservasi::findOrFail($id);

            // Ambil semua transaksi milik pelanggan ini
            $transaksiIds = DB::table('transaksi')
                ->where('id_pelanggan', $reservasi->id_pelanggan)
                ->pluck('id_transaksi');

            // Hapus detail pesanan
            DB::table('detail_pesanan')
                ->whereIn('id_transaksi', $transaksiIds)
                ->delete();

            // Hapus transaksi
            DB::table('transaksi')
                ->where('id_reservasi', $reservasi->id_reservasi)
                ->delete();

            // Hapus reservasi
            $reservasi->delete();

            DB::commit();

            return redirect()
                ->back()
                ->with('success', 'Reservasi dan seluruh pesanan berhasil dihapus.');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->with('error', 'Gagal menghapus reservasi.');
        }
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
            ->where('id_reservasi', $id)
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
            ->where('transaksi.id_reservasi', $id)
            ->select(
                'menu.id_menu',
                'menu.nama_menu',
                DB::raw('SUM(detail_pesanan.qty) as total_qty'),
                'menu.harga',
                DB::raw('SUM(detail_pesanan.qty * menu.harga) as subtotal')
            )
            ->groupBy(
                'menu.id_menu',
                'menu.nama_menu',
                'menu.harga'
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
        $idPengelola = session('id_pengelola');

        if (!$idPengelola) {
            return response()->json([
                'message' => 'Pengelola belum login'
            ], 401);
        }

        // dd($transaksi);


        DB::beginTransaction();

        try {
            // 1️⃣ Ambil transaksi
            $transaksi = Transaksi::findOrFail($id);

            if ($transaksi->status === 'tervalidasi') {
                return response()->json([
                    'message' => 'Transaksi sudah tervalidasi'
                ], 400);
            }

            // 2️⃣ Update transaksi
            $transaksi->status = 'tervalidasi';
            $transaksi->save();

            // 3️⃣ Update reservasi (BERDASARKAN ID PELANGGAN)
            Transaksi::where('id_pelanggan', $transaksi->id_pelanggan)
                ->update([
                    'id_pengelola' => $idPengelola
                ]);

            DB::commit();

            return response()->json([
                'message' => 'Transaksi berhasil divalidasi'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            // dd($e);

            return response()->json([
                'message' => 'Gagal melakukan validasi transaksi',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

}
