<?php

namespace App\Http\Controllers;

use App\Models\pelangganModel;
use App\Models\reservasi;
use App\Models\detailPesanan;
use App\Models\Transaksi;
use App\Models\Meja;
use App\Models\ReservasiMeja;
use App\Models\admin\menuModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class reservasiController extends Controller
{
    // Download Transaksi (PDF)
    public function downloadTransaksi($id)
    {
        // Cek apakah dompdf tersedia
        if (!class_exists('Barryvdh\\DomPDF\\Facade\\Pdf')) {
            return response('Fitur download PDF belum tersedia. Silakan install barryvdh/laravel-dompdf.', 501);
        }

        $userId = session('id_pelanggan');
        $cartKey = 'keranjang_' . $userId;

        $reservasi = Reservasi::findOrFail($id);
        $data = Session::get('dataReservasi');
        $meja = Session::get('mejaDipilih');
        $pesanan = Session::get($cartKey, []);

        $totalHarga = 0;
        if ($pesanan) {
            foreach ($pesanan as $item) {
                $totalHarga += $item['harga'] * $item['qty'];
            }
        }

        // dd($pesanan);

        // $pajak = $totalHarga * 0.1;
        $totalBayar = $totalHarga;

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('User.detail-transaksi-pdf', compact('data', 'meja', 'pesanan', 'totalHarga', 'totalBayar', 'reservasi'));
        return $pdf->download('transaksi-' . $id . '.pdf');
    }


    public function showResevasi()
    {
        if (session('id_pelanggan') === null) {
            return redirect()->route('login')->with('success', 'untuk melakukan reservasi harap login terlebih dahulu!');
        } else {
            // Mengambil Data Session
            $id_pelanggan = session('id_pelanggan');

            // 🔑 WAJIB: definisikan cartKey
            $cartKey = 'keranjang_' . $id_pelanggan;

            // Ambil data pelanggan
            $pelanggan = pelangganModel::where('id_pelanggan', $id_pelanggan)->get();
            $pelanggan = pelangganModel::where('id_pelanggan', '=', $id_pelanggan)
                ->get();

            // 🔥 QTY TERBARU SUDAH ADA
            $keranjang = session($cartKey, []);

            // dd($keranjang);
            return view('User.reservasi', compact('pelanggan', 'keranjang'));
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

        $jumlahTamu = $request->jumlah_tamu;
        $jumlahMeja = $request->jumlah_meja;

        // 1 meja max 4 orang
        $minimalMeja = ceil($jumlahTamu / 4);

        // ❌ VALIDASI LOGIKA
        if ($jumlahMeja < $minimalMeja) {
            return redirect()->back()
                ->withErrors([
                    'jumlah_meja' => "Jumlah tamu $jumlahTamu orang membutuhkan minimal $minimalMeja meja"
                ])
                ->withInput();
        }

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
    // PEMILIHAN MEJA
    // ============================
    public function showTempatDuduk()
    {
        $data = session('dataReservasi');
        $inputWaktuReservasi = $data['waktu'];
        $inputTglReservasi = $data['tanggal'];

        // data rata rata orang di coffe shop selama 2 jam
        $perkiraanWaktuSelesai = Carbon::createFromFormat('H:i', $inputWaktuReservasi)->addHours(2)->format('H:i');

        // dd($data);

        if (!$data) {
            return redirect()->route('reservasi')
                ->with('gagal', 'Silakan isi form reservasi terlebih dahulu.');
        }

        $jumlahMeja = $data['jumlahMeja'];
        $mejaDipilih = session('mejaDipilih', []);

        // $mejaIndr = DB::table('reservasi')
        //     ->join('')
        //     ->get();

        // $mejaIndoor = Meja::where('meja.ruangan', 'Indoor')
        //     ->leftJoin('reservasi_meja', 'meja.id_meja', '=', 'reservasi_meja.id_meja')
        //     ->leftJoin('reservasi', 'reservasi_meja.id_reservasi', '=', 'reservasi.id_reservasi')
        //     ->leftJoin('transaksi', 'transaksi.id_reservasi', '=', 'reservasi.id_reservasi')
        //     ->select(
        //         'meja.*',
        //         'reservasi.tanggal',
        //         'reservasi.waktu',
        //         'transaksi.status as status_transaksi',
        //         DB::raw("
        //             CASE 
        //                 WHEN transaksi.status = 'selesai' THEN 'KOSONG'
        //                 WHEN reservasi.tanggal != '$inputTglReservasi' THEN 'KOSONG'
        //                 WHEN reservasi_meja.id_meja IS NULL THEN 'KOSONG' 
        //                 ELSE 'TERBOOKING' 
        //             END AS status
        //         ")
        //     )
        //     ->get();

        $mejaIndoor = Meja::where('meja.ruangan', 'Indoor')
            ->leftJoin('reservasi_meja', 'meja.id_meja', '=', 'reservasi_meja.id_meja')
            ->leftJoin('reservasi', function ($join) use ($inputTglReservasi) {
                $join->on('reservasi_meja.id_reservasi', '=', 'reservasi.id_reservasi')
                    ->where('reservasi.tanggal', '=', $inputTglReservasi);
            })
            ->leftJoin('transaksi', 'transaksi.id_reservasi', '=', 'reservasi.id_reservasi')
            ->select(
                DB::raw('DISTINCT ON (meja.id_meja) meja.id_meja'), // Kunci agar meja tidak dobel
                'meja.*',
                'reservasi.tanggal',
                'reservasi.waktu',
                'transaksi.status as status_transaksi',
                DB::raw("
            CASE 
                WHEN transaksi.status = 'selesai' THEN 'KOSONG'
                WHEN reservasi.id_reservasi IS NULL THEN 'KOSONG' 
                ELSE 'TERBOOKING' 
            END AS status
        ")
            )
            ->orderBy('meja.id_meja') // Wajib ada orderBy jika pakai DISTINCT ON
            ->orderBy('status', 'DESC') // Biar 'TERBOOKING' muncul duluan dibanding 'KOSONG' jika ada dua baris
            ->get();

        $mejaOutdoor = Meja::where('meja.ruangan', 'Outdoor')
            ->leftJoin('reservasi_meja', 'meja.id_meja', '=', 'reservasi_meja.id_meja')
            ->leftJoin('reservasi', function ($join) use ($inputTglReservasi) {
                $join->on('reservasi_meja.id_reservasi', '=', 'reservasi.id_reservasi')
                    ->where('reservasi.tanggal', '=', $inputTglReservasi);
            })
            ->leftJoin('transaksi', 'transaksi.id_reservasi', '=', 'reservasi.id_reservasi')
            ->select(
                DB::raw('DISTINCT ON (meja.id_meja) meja.id_meja'), // Kunci agar meja tidak dobel
                'meja.*',
                'reservasi.tanggal',
                'reservasi.waktu',
                'transaksi.status as status_transaksi',
                DB::raw("
            CASE 
                WHEN transaksi.status = 'selesai' THEN 'KOSONG'
                WHEN reservasi.id_reservasi IS NULL THEN 'KOSONG' 
                ELSE 'TERBOOKING' 
            END AS status
        ")
            )
            ->orderBy('meja.id_meja') // Wajib ada orderBy jika pakai DISTINCT ON
            ->orderBy('status', 'DESC') // Biar 'TERBOOKING' muncul duluan dibanding 'KOSONG' jika ada dua baris
            ->get();

        // $mejaIndoor = Meja::where('ruangan', 'Indoor')->get();
        // $mejaOutdoor = Meja::where('ruangan', 'Outdoor')->get();

        // dd($mejaIndoor, $mejaOutdoor);

        return view('User.tempat-duduk', compact('jumlahMeja', 'mejaDipilih', 'mejaIndoor', 'mejaOutdoor'));
    }

    public function pilihTempatDuduk(Request $request)
    {
        // $request->validate([
        // 'ruangan' => 'required',
        // 'kode_meja' => 'required'
        // ]);

        // dd($request->id_meja);

        $inputMeja = $request->id_meja;


        $jumlahMeja = Session::get('dataReservasi')['jumlahMeja'];
        $mejaDipilih = Session::get('mejaDipilih', []);

        // cek apakah meja yg d inputkan sesuai dengan data jumlh meja di reservasi
        if (count($request->id_meja) > $jumlahMeja || count($request->id_meja) < $jumlahMeja) {
            return back()->with('gagal', 'Pilih ' . $jumlahMeja . ' meja');
        }

        // dd($inputMeja[0]);

        // array penyimpan data meja dan ruangan sementara
        $mejaBaru = [];

        for ($i = 0; $i < $jumlahMeja; $i++) {
            $data = DB::table('meja')
                ->where('kode_meja', $inputMeja[$i])
                ->select('ruangan')
                ->first();

            // dd($data->ruangan);

            if ($data->ruangan === 'Indoor') {
                array_push($mejaBaru, [
                    'ruangan' => $data->ruangan,
                    'kode_meja'   => $inputMeja[$i],
                ]);
            } else {
                array_push($mejaBaru, [
                    'ruangan' => $data->ruangan,
                    'kode_meja'   => $inputMeja[$i],
                ]);
            }
        }

        // dd($mejaBaru);

        session(['mejaDipilih' => $mejaBaru]);

        // dd(Session::get('mejaDipilih', []));

        // Bentuk data meja TERSTRUKTUR
        // $mejaBaru = [
        //     'ruangan' => $request->ruangan,
        //     'kode_meja'   => $request->kode_meja,
        // ];

        // // Cegah meja duplicate
        // foreach ($mejaDipilih as $meja) {
        //     if (
        //         $meja['ruangan'] === $mejaBaru['ruangan'] &&
        //         $meja['kode_meja'] === $mejaBaru['kode_meja']
        //     ) {
        //         return back()->with('gagal', 'Meja sudah dipilih!');
        //     }
        // }

        // // Simpan meja baru
        // $mejaDipilih[] = $mejaBaru;
        // Session::put('mejaDipilih', $mejaDipilih);


        // // Jika belum cukup → tetap di halaman
        // if (count($mejaDipilih) < $jumlahMeja) {
        //     return back()->with('success', 'Meja berhasil dipilih!');
        // }

        // // Jika sudah cukup → lanjut ke detail pesanan
        return redirect()->route('detail-pesanan');
        // // return redirect()->route('detail-pesanan')->with('success', 'Semua meja berhasil dipilih!');
    }


    public function detailPesanan()
    {
        $userId = session('id_pelanggan');

        $data = Session::get('dataReservasi');
        $meja = Session::get('mejaDipilih');

        $menuReservasi = Session::get('menuReservasi');
        $keranjang = Session::get('keranjang_' . $userId, []);

        // dd($keranjang);

        // ================================
        // JALUR 1️⃣ : DARI RESERVASI
        // ================================
        if ($menuReservasi) {

            $pesanan = [[
                'id'     => $menuReservasi['id_menu'],
                'nama'   => $menuReservasi['nama'],
                'harga'  => $menuReservasi['harga'],
                'gambar' => $menuReservasi['gambar'],
                'qty'    => $menuReservasi['qty'], // ✅
            ]];

            $totalHarga = $menuReservasi['harga'] * $menuReservasi['qty'];
        }

        // ================================
        // JALUR 2️⃣ : DARI KERANJANG
        // ================================
        elseif (!empty($keranjang)) {

            $pesanan = $keranjang;

            $totalHarga = 0;
            foreach ($keranjang as $item) {
                $totalHarga += $item['harga'] * $item['qty'];
            }
        }

        // ================================
        // VALIDASI
        // ================================
        else {
            return redirect()->route('menu')
                ->with('gagal', 'Pesanan tidak ditemukan.');
        }

        // dd("menu Keranjang: {{$keranjang}}");

        // $pajak = $totalHarga * 0.1;
        // $totalBayar = $totalHarga + $pajak;
        $totalBayar = $totalHarga;

        // hanya wajib jika reservasi
        if ($menuReservasi && (!$data || !$meja)) {
            return redirect()->route('reservasi')
                ->with('gagal', 'Data reservasi belum lengkap.');
        }

        return view('User.detail-pesanan', compact(
            'data',
            'meja',
            'pesanan',
            'totalHarga',
            // 'pajak',
            'totalBayar',
            'keranjang'
        ));
    }


    public function uploadBukti(Request $request)
    {
        $request->validate([
            'bukti-pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $id_pelanggan = session('id_pelanggan');
        $id_pengelola = session('id_pengelola');

        // =========================
        // AMBIL SESSION
        // =========================
        $dataReservasi = Session::get('dataReservasi');
        $mejaDipilih   = Session::get('mejaDipilih', []);
        $menuReservasi = Session::get('menuReservasi');
        $cartKey       = 'keranjang_' . $id_pelanggan;
        $keranjang     = Session::get($cartKey, []);


        // =========================
        // VALIDASI RESERVASI
        // =========================
        if (!$dataReservasi || empty($mejaDipilih)) {
            return redirect()->route('reservasi')
                ->with('gagal', 'Data reservasi tidak lengkap.');
        }

        // =========================
        // TENTUKAN JALUR PESANAN
        // =========================
        if (!empty($keranjang)) {
            // 🔹 JALUR KERANJANG
            $pesananFinal = $keranjang;
        } elseif (!empty($menuReservasi)) {
            // 🔹 JALUR RESERVASI LANGSUNG
            $pesananFinal = [[
                'id'    => $menuReservasi['id_menu'],
                'harga' => $menuReservasi['harga'],
                'qty'   => $menuReservasi['qty'] ?? 1,
            ]];
        } else {
            return redirect()->route('menu')
                ->with('gagal', 'Pesanan tidak ditemukan.');
        }

        // =========================
        // SIMPAN FILE BUKTI
        // =========================
        $path = $request->file('bukti-pembayaran')
            ->store('bukti-pembayaran', 'public');

        // dd($mejaDipilih);
        DB::beginTransaction();

        try {

            // =========================
            // OLAH RUANGAN
            // =========================
            $ruanganChosed = [];
            foreach ($mejaDipilih as $m) {
                $ruanganChosed[] = $m['ruangan'];
            }

            // =========================
            // SIMPAN RESERVASI
            // =========================
            $reservasi = Reservasi::create([
                'id_pelanggan'     => $id_pelanggan,
                'tanggal'          => $dataReservasi['tanggal'],
                'waktu'            => $dataReservasi['waktu'],
                'jumlah_tamu'      => $dataReservasi['jumlah_tamu'] ?? 1,
                'ruangan'          => json_encode($ruanganChosed),
                'bukti_pembayaran' => $path,
            ]);

            // =========================
            // HITUNG TOTAL
            // =========================
            $totalHarga = 0;
            foreach ($pesananFinal as $item) {
                $totalHarga += $item['harga'] * $item['qty'];
            }

            // =========================
            // SIMPAN TRANSAKSI
            // =========================
            $transaksi = Transaksi::create([
                'id_pelanggan'      => $id_pelanggan,
                'id_reservasi'      => $reservasi->id_reservasi,
                'id_pengelola'      => $id_pengelola,
                'total'             => $totalHarga,
                'status'            => 'menunggu',
                'metode_pembayaran' => 'QRIS',
            ]);

            // =========================
            // DETAIL PESANAN
            // =========================
            foreach ($pesananFinal as $item) {
                DetailPesanan::create([
                    'id_transaksi' => $transaksi->id_transaksi,
                    'id_menu'      => $item['id'],
                    'qty'          => $item['qty'],
                ]);
            }

            // =========================
            // KURANGI STOK MENU
            // =========================
            foreach ($pesananFinal as $item) {

                $menu = MenuModel::where('id_menu', $item['id'])
                    ->lockForUpdate() // 🔒 cegah race condition
                    ->firstOrFail();

                // VALIDASI STOK
                if ($menu->stok < $item['qty']) {
                    throw new \Exception(
                        'Stok menu "' . $menu->nama_menu . '" tidak mencukupi'
                    );
                }

                // KURANGI STOK
                $menu->stok = $menu->stok - $item['qty'];
                $menu->save();
            }


            // =========================
            // RELASI MEJA
            // =========================
            foreach ($mejaDipilih as $m) {
                $meja = Meja::where('ruangan', $m['ruangan'])
                    ->where('kode_meja', $m['kode_meja'])
                    ->firstOrFail();

                ReservasiMeja::create([
                    'id_reservasi' => $reservasi->id_reservasi,
                    'id_meja'      => $meja->id_meja,
                ]);
            }

            DB::commit();

            // =========================
            // BERSIHKAN SESSION
            // =========================

            // Session::forget([
            //     'menuReservasi',
            //     'mejaDipilih',
            //     'dataReservasi',
            //     $cartKey
            // ]);

            return redirect()
                ->route('detail-transaksi', $reservasi->id_reservasi)
                ->with('success', 'Bukti pembayaran berhasil diupload!');
        } catch (\Throwable $e) {
            // DB::rollBack();
            dd($e);
        }
    }




    // ============================
    // RESET SESSION
    // ============================
    public function resetSession(Request $request)
    {
        // Hapus session reservasi
        Session::forget([
            'dataReservasi',
            'mejaDipilih',
            'menuReservasi',
        ]);

        // Hapus semua keranjang user (jika ada)
        $userId = session('id_pelanggan');
        if ($userId) {
            Session::forget('keranjang_' . $userId);
        }

        // (Opsional) flash message
        return redirect()->route('home')
            ->with('success', 'Pesanan berhasil dibatalkan.');
    }




    // ============================
    // DETAIL TRANSAKSI
    // ============================
    public function detailTransaksi($id)
    {
        $idPelanggan = session('id_pelanggan');
        if (!$idPelanggan) {
            return redirect()->route('login');
        }

        $cartKey = 'keranjang_' . $idPelanggan;

        $reservasi = Reservasi::findOrFail($id);
        $data = Session::get('dataReservasi');
        $meja = Session::get('mejaDipilih');

        $keranjang = Session::get($cartKey, []);
        $menuFromReservasi = Session::get('menuReservasi');

        $pesanan = [];

        // 1️⃣ Menu dari tombol reservasi
        if ($menuFromReservasi) {
            $pesanan[] = [
                'id'     => $menuFromReservasi['id_menu'],
                'nama'   => $menuFromReservasi['nama'],
                'harga'  => $menuFromReservasi['harga'],
                'gambar' => $menuFromReservasi['gambar'],
                'qty'    => 1,
            ];
        }

        // 2️⃣ Gabungkan keranjang
        foreach ($keranjang as $item) {
            $pesanan[] = $item;
        }

        // Hitung total
        $totalHarga = 0;
        foreach ($pesanan as $item) {
            $totalHarga += $item['harga'] * $item['qty'];
        }

        // $pajak = $totalHarga * 0.1;
        // $totalBayar = $totalHarga + $pajak;
        $totalBayar = $totalHarga;

        if (!$data || !$meja) {
            return redirect()->route('reservasi')
                ->with('gagal', 'Data reservasi belum lengkap.');
        }

        return view('User.detail-transaksi', compact(
            'data',
            'meja',
            'pesanan',
            'totalHarga',
            // 'pajak',
            'totalBayar',
            'reservasi'
        ));
    }
}
