<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    private $menus = [
        1 => [
            'nama' => 'Jus Jeruk',
            'harga' => 100,
            'deskripsi' => 'Minuman segar dari jeruk asli.',
            'gambar' => 'images/minuman/minuman-1.jpg'
        ],
        2 => [
            'nama' => 'Jus Frifayer',
            'harga' => 100,
            'deskripsi' => 'Minuman unik khas Thailand.',
            'gambar' => 'images/minuman/minuman-2.jpg'
        ],
        3 => [
            'nama' => 'Jus Darah',
            'harga' => 100,
            'deskripsi' => 'Minuman khusus vampir.',
            'gambar' => 'images/minuman/minuman-3.jpg'
        ],
    ];

    private $makanan = [
        1 => [
            'nama' => 'Sate Wirog',
            'harga' => 100,
            'deskripsi' => 'Minuman segar dari jeruk asli.',
            'gambar' => 'images/makanan/makanan-1.jpg'
        ],
        2 => [
            'nama' => 'Sate Pupu',
            'harga' => 100,
            'deskripsi' => 'Minuman unik khas Thailand.',
            'gambar' => 'images/makanan/makanan-2.jpg'
        ],
        3 => [
            'nama' => 'Sate Rangda',
            'harga' => 100,
            'deskripsi' => 'Minuman khusus vampir.',
            'gambar' => 'images/makanan/makanan-3.jpg'
        ],
    ];

    // ===============================
    // HALAMAN MENU
    // ===============================
    public function menuMinuman()
    {
        $menus = $this->menus;
        return view('User.menu-minuman', compact('menus'));
    }

    public function menuMakanan()
    {
        $makanan = $this->makanan;
        return view('User.menu-makanan', compact('makanan'));
    }

    // ===============================
    // DETAIL MENU
    // ===============================
    public function detailMinuman($id)
    {
        if (!isset($this->menus[$id])) {
            abort(404);
        }

        return view('User.detail-menu', [
            'menu' => $this->menus[$id],
            'id'   => $id
        ]);
    }

    public function detailMakanan($id)
    {
        if (!isset($this->makanan[$id])) {
            abort(404);
        }

        return view('User.detail-menu', [
            'menu' => $this->makanan[$id],
            'id'   => $id
        ]);
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