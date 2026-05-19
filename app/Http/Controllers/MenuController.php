<?php

namespace App\Http\Controllers;

use App\Models\admin\menuModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
{
    private function getDefaultDrinkOptions(): array
    {
        return [
            'temperature' => 'ice',
            'sugar_level' => 'normal_sugar',
            'ice_level' => 'normal_ice',
        ];
    }

    private function normalizeDrinkOptions(array $options = []): array
    {
        $defaults = $this->getDefaultDrinkOptions();
        $allowed = [
            'temperature' => ['ice', 'hot'],
            'sugar_level' => ['normal_sugar', 'less_sugar'],
            'ice_level' => ['normal_ice', 'less_ice', 'no_ice'],
        ];

        foreach ($allowed as $key => $values) {
            if (!isset($options[$key]) || !in_array($options[$key], $values, true)) {
                $options[$key] = $defaults[$key];
            }
        }

        return $options;
    }

    public function menuMinuman()
    {
        $menuMinuman = menuModel::where('kategori', 'minuman')->latest()->get();

        return view('User.menu-minuman', compact('menuMinuman'));
    }

    public function menuMakanan()
    {
        $menuMakanan = menuModel::where('kategori', 'makanan')->get();

        return view('User.menu-makanan', compact('menuMakanan'));
    }

    public function detailMinuman($id)
    {
        $chosedMenu = menuModel::where('id_menu', $id)->get();

        if (!$chosedMenu) {
            abort(404);
        }

        return view('User.detail-menu', compact('chosedMenu'));
    }

    public function detailMakanan($id)
    {
        $chosedMenu = menuModel::where('id_menu', $id)->get();

        if (!$chosedMenu) {
            abort(404);
        }

        return view('User.detail-menu', compact('chosedMenu'));
    }

    public function fromMenu($id)
    {
        $menu = menuModel::findOrFail($id);

        Session::put('menuReservasi', [
            'id_menu' => $menu->id_menu,
            'nama' => $menu->nama_menu,
            'harga' => $menu->harga,
            'gambar' => $menu->gambar,
            'qty' => 1,
        ]);

        return redirect()->route('reservasi');
    }

    public function addToCart(Request $request)
    {
        $userId = session('id_pelanggan');

        if (!$userId) {
            return redirect()
                ->route('login')
                ->with('warning', 'Harap login terlebih dahulu sebelum menambahkan menu ke keranjang.');
        }

        $menu = menuModel::findOrFail($request->id);
        $qtyRequest = $request->qty ?? 1;

        if ($qtyRequest > $menu->stok) {
            return back()->with('gagal', 'Stok "' . $menu->nama_menu . '" hanya tersisa ' . $menu->stok);
        }

        $cartKey = 'keranjang_' . $userId;
        $keranjang = session($cartKey, []);
        $found = false;

        foreach ($keranjang as $index => $item) {
            if ($item['id'] == $menu->id_menu) {
                $qtyBaru = $item['qty'] + $qtyRequest;

                if ($qtyBaru > $menu->stok) {
                    return back()->with('gagal', 'Stok "' . $menu->nama_menu . '" hanya tersisa ' . $menu->stok);
                }

                $keranjang[$index]['qty'] = $qtyBaru;
                $keranjang[$index]['stok'] = $menu->stok;
                $keranjang[$index]['kategori'] = $menu->kategori;

                if ($menu->kategori === 'minuman') {
                    $keranjang[$index]['options'] = $this->normalizeDrinkOptions($keranjang[$index]['options'] ?? []);
                }

                $found = true;
                break;
            }
        }

        if (!$found) {
            $keranjang[] = [
                'id' => $menu->id_menu,
                'nama' => $menu->nama_menu,
                'harga' => $menu->harga,
                'gambar' => $menu->gambar,
                'qty' => $qtyRequest,
                'stok' => $menu->stok,
                'kategori' => $menu->kategori,
                'options' => $menu->kategori === 'minuman' ? $this->getDefaultDrinkOptions() : [],
            ];
        }

        session()->put($cartKey, $keranjang);

        return redirect()->route('keranjang')->with('success', 'Ditambahkan ke keranjang!');
    }

    public function keranjang()
    {
        $userId = session('id_pelanggan');

        if (!$userId) {
            return redirect()
                ->route('login')
                ->with('success', 'Untuk melihat keranjang harap login terlebih dahulu!');
        }

        $cartKey = 'keranjang_' . $userId;
        $selectedKey = 'keranjang_terpilih_' . $userId;

        $keranjang = session($cartKey, []);
        $selected = session($selectedKey, []);

        foreach ($keranjang as &$item) {
            if (!isset($item['kategori']) && isset($item['id'])) {
                $menu = menuModel::find($item['id']);
                if ($menu) {
                    $item['kategori'] = $menu->kategori;
                }
            }

            if (($item['kategori'] ?? null) === 'minuman') {
                $item['options'] = $this->normalizeDrinkOptions($item['options'] ?? []);
            }
        }
        unset($item);

        session()->put($cartKey, $keranjang);

        return view('User.keranjang', compact('keranjang', 'selected'));
    }

    public function pilihItem(Request $request)
    {
        $request->validate([
            'index' => 'required',
            'checked' => 'required|boolean',
        ]);

        $userId = session('id_pelanggan');
        $cartKey = 'keranjang_' . $userId;
        $selectedKey = 'keranjang_terpilih_' . $userId;

        $keranjang = session($cartKey, []);
        $selected = session($selectedKey, []);

        if (!isset($keranjang[$request->index])) {
            return response()->json(['success' => false]);
        }

        if ($request->checked) {
            $selected[$request->index] = $keranjang[$request->index];
        } else {
            unset($selected[$request->index]);
        }

        session([$selectedKey => $selected]);

        return response()->json(['success' => true]);
    }

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

        if (!isset($keranjang[$index])) {
            return response()->json(['success' => false], 404);
        }

        $menu = menuModel::findOrFail($keranjang[$index]['id']);
        $qty = max(1, (int) $request->qty);

        if ($qty > $menu->stok) {
            $qty = $menu->stok;
        }

        $keranjang[$index]['qty'] = $qty;
        $keranjang[$index]['stok'] = $menu->stok;
        $keranjang[$index]['kategori'] = $menu->kategori;

        if ($menu->kategori === 'minuman') {
            $options = $request->only(['temperature', 'sugar_level', 'ice_level']);
            $keranjang[$index]['options'] = $this->normalizeDrinkOptions(
                !empty($options) ? $options : ($keranjang[$index]['options'] ?? [])
            );
        }

        session()->put($cartKey, $keranjang);

        return response()->json([
            'success' => true,
            'qty' => $qty,
            'options' => $keranjang[$index]['options'] ?? [],
        ]);
    }

    public function showTempatDuduk()
    {
        $reservasi = session('reservasi');

        return view('user.tempat-duduk', compact('reservasi'));
    }

    public function pilihTempatDuduk(Request $request)
    {
        session([
            'reservasi' => [
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                'waktu' => $request->waktu,
                'tanggal' => $request->tanggal,
                'jumlah_tamu' => $request->jumlah_tamu,
            ],
        ]);

        return redirect()->route('show-tempat-duduk');
    }
}
