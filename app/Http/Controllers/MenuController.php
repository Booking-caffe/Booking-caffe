<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin\menuModel;

class MenuController extends Controller
{

    // ===============================
    // HALAMAN MENU
    // ===============================
    public function menuMinuman()
    {   
        // mengambil semua data menu dengan kategori munuman saja
        $menuMinuman = menuModel::where('kategori', 'minuman')->latest()->get();

        return view('User.menu-minuman', compact('menuMinuman'));
    }

    public function menuMakanan()
    {   
        // mengambil semua data menu dengan kategori makanan saja
        $menuMakanan = menuModel::where('kategori', 'makanan')->get();
        return view('User.menu-makanan', compact('menuMakanan'));
    }


    // ===============================
    // DETAIL MENU
    // ===============================
    public function detailMinuman($id)
    {
        // mengambil data menu berdasarkan id menu yg dipilih d halaman sebelumnya
        $chosedMenu = menuModel::where('id_menu', $id)->get();

        if (!$chosedMenu) {
            abort(404);
        }

        return view('User.detail-menu', compact('chosedMenu'));
    }


    public function detailMakanan($id)
    {
        // mengambil data menu berdasarkan id menu yg dipilih d halaman sebelumnya
        $chosedMenu = menuModel::where('id_menu', $id)->get();

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

        $userId = session('id_pelanggan'); // pastikan ini ada saat login

        $cartKey = 'keranjang_' . $userId;

        $cartItem = [
            'id'     => $request->id,
            'nama'   => $request->nama,
            'harga'  => $request->harga,
            'gambar' => $request->gambar,
            // 'qty'    => $keranjang,
            'qty'    => $request->qty ?? 1,
        ];

        session()->push($cartKey, $cartItem);

        return redirect()->route('keranjang')->with('success', 'Ditambahkan ke keranjang!');
    }


    // ===============================
    // HALAMAN KERANJANG
    // ===============================
   public function keranjang()
    {
        // Hanya ambil dari SESSION keranjang
        $userId = session('id_pelanggan');
        $cartKey = 'keranjang_' . $userId;

        $keranjang = session($cartKey, []);


        return view('User.keranjang', compact('keranjang'));
    }
    

    // ===============================
    // HPUS ITEM KERANJANG
    // ===============================

   public function removeItem($index)
    {
        $userId = session('id_pelanggan');
        $cartKey = 'keranjang_' . $userId;

        $keranjang = session($cartKey, []);

        if (!isset($keranjang[$index])) {
            return back()->with('error', 'Item tidak ditemukan.');
        }

        unset($keranjang[$index]);
        $keranjang = array_values($keranjang);

        session([$cartKey => $keranjang]);

        return back()->with('success', 'Item berhasil dihapus!');
    }




   public function updateQty(Request $request, $index)
    {
        $userId = session('id_pelanggan');
        $cartKey = 'keranjang_' . $userId;

        $keranjang = session($cartKey, []);

        if (isset($keranjang[$index])) {
            $keranjang[$index]['qty'] = $request->qty;
            session()->put($cartKey, $keranjang);

            return response()->json(['success' => true]);
        }



        return response()->json([
        'received_qty' => $request->qty,
        'index' => $index
        ]);

        // return response()->json(['success' => false], 404);
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