<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin\menuModel;
use Illuminate\Support\Facades\Session;


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
        //  $chosedMenu = menuModel::findOrFail($id);

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


    public function fromMenu($id)
    {
        $menu = menuModel::findOrFail($id);

        // Simpan menu ke session
        Session::put('menuReservasi', [
            'id_menu' => $menu->id_menu,
            'nama'    => $menu->nama_menu,
            'harga'   => $menu->harga,
            'gambar'  => $menu->gambar,
            'qty'     => 1,
        ]);

        return redirect()->route('reservasi');
    }


    // ===============================
    // TAMBAHKAN KE KERANJANG
    // ===============================
    public function addToCart(Request $request)
    {
        $userId = session('id_pelanggan');

        if (!$userId) {
            return redirect()->route('login');
        }

        $cartKey = 'keranjang_' . $userId;

        $keranjang = session($cartKey, []);

        $found = false;

        foreach ($keranjang as $index => $item) {
            if ($item['id'] == $request->id) {
                // 🔥 ITEM SUDAH ADA → TAMBAH QTY
                $keranjang[$index]['qty'] += ($request->qty ?? 1);
                $found = true;
                break;
            }
        }

        // 🔥 ITEM BELUM ADA → TAMBAH BARU
        if (!$found) {
            $keranjang[] = [
                'id'     => $request->id,
                'nama'   => $request->nama,
                'harga'  => $request->harga,
                'gambar' => $request->gambar,
                'qty'    => $request->qty ?? 1,
            ];
        }

        session()->put($cartKey, $keranjang);

        return redirect()
            ->route('keranjang')
            ->with('success', 'Ditambahkan ke keranjang!');
    }


    // ===============================
    // HALAMAN KERANJANG
    // ===============================
    public function keranjang()
    {
        $userId = session('id_pelanggan');

        if (!$userId) {
            return redirect()
                ->route('login')
                ->with('success', 'Untuk melihat keranjang harap login terlebih dahulu!');
        }

        $cartKey     = 'keranjang_' . $userId;
        $selectedKey = 'keranjang_terpilih_' . $userId;

        $keranjang = session($cartKey, []);
        $selected  = session($selectedKey, []);

        return view('User.keranjang', compact('keranjang', 'selected'));
    }

    // ===============================
    // CHECKBOX PILIH ITEM
    // ===============================
    public function pilihItem(Request $request)
    {
        $request->validate([
            'index'   => 'required',
            'checked' => 'required|boolean'
        ]);

        $userId = session('id_pelanggan');
        $cartKey = 'keranjang_' . $userId;
        $selectedKey = 'keranjang_terpilih_' . $userId;

        $keranjang = session($cartKey, []);
        $selected  = session($selectedKey, []);

        // Validasi index
        if (!isset($keranjang[$request->index])) {
            return response()->json(['success' => false]);
        }

        // Tambah / hapus pilihan
        if ($request->checked) {
            $selected[$request->index] = $keranjang[$request->index];
        } else {
            unset($selected[$request->index]);
        }

        session([$selectedKey => $selected]);

        return response()->json(['success' => true]);
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



    // ===============================
    // UPDATE QTY ITEM KERANJANG
    // ===============================
    public function updateQty(Request $request, $index)
    {
        $userId = session('id_pelanggan');
        $cartKey = 'keranjang_' . $userId;

        // ✅ WAJIB ambil session dulu
        $keranjang = session($cartKey, []);

        if (!isset($keranjang[$index])) {
            return response()->json(['success' => false], 404);
        }

        $keranjang[$index]['qty'] = (int) $request->qty;

        session()->put($cartKey, $keranjang);

        return response()->json([
            'success' => true,
            'qty' => $keranjang[$index]['qty']
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