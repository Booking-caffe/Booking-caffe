<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuModel;

class MenuController extends Controller
{

    // ===============================
    // HALAMAN MENU
    // ===============================
    public function menuMinuman()
    {   
        // mengambil semua data menu dengan kategori munuman saja
        $menuMinuman = MenuModel::where('kategori', 'Minuman')->latest()->get();

        return view('User.menu-minuman', compact('menuMinuman'));
    }

    public function menuMakanan()
    {   
        // mengambil semua data menu dengan kategori makanan saja
        $menuMakanan = MenuModel::where('kategori', 'Makanan')->get();
        return view('User.menu-makanan', compact('menuMakanan'));
    }

    // ===============================
    // DETAIL MENU
    // ===============================
    public function detailMinuman($id)
    {
        // mengambil data menu berdasarkan id menu yg dipilih d halaman sebelumnya
        $chosedMenu = MenuModel::where('id_menu', $id)->get();

        if (!$chosedMenu) {
            abort(404);
        }

        return view('User.detail-menu', compact('chosedMenu'));
    }

    public function detailMakanan($id)
    {
        // mengambil data menu berdasarkan id menu yg dipilih d halaman sebelumnya
        $chosedMenu = MenuModel::where('id_menu', $id)->get();

        if (!$chosedMenu) {
            abort(404);
        }

        return view('User.detail-menu', compact('chosedMenu'));
    }

    // ===============================
    // TAMBAHKAN KE KERANJANG
    // ===============================
   public function addToCart(Request $request)
    {
        $cartItem = [
            'id'     => $request->id,
            'nama'   => $request->nama,
            'harga'  => $request->harga,
            'gambar' => $request->gambar,
            'qty'    => $request->qty ?? 1,
        ];

        session()->push('keranjang', $cartItem);

        return redirect()->route('keranjang')->with('success', 'Ditambahkan ke keranjang!');
    }

    // ===============================
    // HALAMAN KERANJANG
    // ===============================
   public function keranjang()
    {
        // Hanya ambil dari SESSION keranjang
        $keranjang = session('keranjang', []);

        return view('User.keranjang', compact('keranjang'));
    }

    // ===============================
    // HPUS ITEM KERANJANG
    // ===============================

   public function removeItem($index)
    {
        $keranjang = session('keranjang', []);

        // Jika index tidak valid
        if (!isset($keranjang[$index])) {
            return back()->with('error', 'Item tidak ditemukan.');
        }

        // Hapus item berdasarkan index
        unset($keranjang[$index]);

        // Reindex array agar tidak bolong
        $keranjang = array_values($keranjang);

        // Simpan kembali ke session
        session(['keranjang' => $keranjang]);

        return back()->with('success', 'Item berhasil dihapus!');
    }

    // ===============================
    // MENAMPILKAN TEMPAT DUDUK
    // ===============================

    public function showTempatDuduk()
    {
        $reservasi = session('reservasi');

        return view('user.tempat-duduk', compact('reservasi'));
    }

    // ===============================
    // PILIH TEMPAT DUDUK
    // ===============================
    
    public function pilihTempatDuduk(Request $request)
    {
        // simpan data reservasi sementara ke session
        session([
            'reservasi' => [
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                'waktu' => $request->waktu,
                'tanggal' => $request->tanggal,
                'jumlah_tamu' => $request->jumlah_tamu,
            ]
        ]);

        return redirect()->route('show-tempat-duduk');
    }

}