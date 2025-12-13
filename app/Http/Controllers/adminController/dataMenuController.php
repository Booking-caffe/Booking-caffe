<?php

namespace App\Http\Controllers\adminController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\menuModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class dataMenuController extends Controller
{
    // home admin
    public function home()
    {

        if(Session::get('id_pengelola') === null)
        {
            abort(403, 'Unauthorize');
        }
        return view('Admin.dashboard');
    }
    
    //DATA MENU 
    public function showMakanan()
    {
        $makanan = menuModel::where('kategori', 'makanan')->get();
        return view('Admin.makanan', compact('makanan'));
    
    }

    public function showMinuman()
    {

        $minuman = menuModel::where('kategori', 'minuman')->get();
        return view('Admin.minuman', compact('minuman'));
    }

    public function formMakanan()
    {
        return view('Admin.tambahMakanan');
    }

    public function formMinuman()
    {
        return view('Admin.tambahMinuman');
    }


    public function destroy($id)
    {
        $menu = menuModel::findOrFail($id);

        // Hapus gambar dari storage
        if ($menu->gambar && Storage::disk('public')->exists($menu->gambar)) {
            Storage::disk('public')->delete($menu->gambar);
        }

        $menu->delete();

        return redirect()
            ->back()
            ->with('success', 'Menu berhasil dihapus');
    }

    public function edit($id)
    {
        $menu = menuModel::where('id_menu', $id)->findOrFail($id);
        return view('Admin.menuEdit', compact('menu'));

    }


    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'harga'     => 'required|numeric',
            'stok'      => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);


        $menu = menuModel::findOrFail($id);

        // Jika upload gambar baru
        if ($request->hasFile('gambar')) {
            if ($menu->gambar && Storage::disk('public')->exists($menu->gambar)) {
                Storage::disk('public')->delete($menu->gambar);
            }

            $namaFile = Str::random(10) . '.' . $request->gambar->extension();
            $menu->gambar = $request->gambar->storeAs('menu', $namaFile, 'public');
        }

        
        $update = $menu->update([
            'nama_menu' => $request->nama_menu,
            'harga'     => $request->harga,
            'stok'      => $request->stok,
            'deskripsi' => $request->deskripsi,
        ]);

        // dd($update);

        return redirect()
            ->back()
            ->with('success', 'Menu berhasil diperbarui');
    }

    public function show($id)
    {
        return response()->json(
            menuModel::findOrFail($id)
        );
    }


    // private function generateIdMenu()
    // {
    //     // Ambil ID terbesar terakhir
    //     $last = \App\Models\admin\menuModel::orderBy('id_menu', 'DESC')->first();

    //     if (!$last) {
    //         return "MEN001";
    //     }
        
    //     // Ambil angka setelah "MEN"
    //     $num = intval(substr($last->id_menu, 3)) + 1;

    //     // Generate format baru
    //     return "MEN" . str_pad($num, 3, '0', STR_PAD_LEFT);
    // }


    public function addMenu(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'kategori'  => 'required|in:makanan,minuman',
            'harga'     => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'gambar'    => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'stok' => 'required|integer|min:0',
        ]);

        // Simpan gambar
        $namaFile = Str::random(10) . '.' . $request->gambar->extension();
        $path = $request->gambar->storeAs('menu', $namaFile, 'public');


        // Simpan data
        menuModel::create([
            // 'id_menu'   => $this->generateIdMenu(),
            'id_pengelola' => Session::get('id_pengelola'),
            'nama_menu' => $request->nama_menu,
            'kategori'  => $request->kategori,
            'harga'     => $request->harga,
            'deskripsi' => $request->deskripsi,
            'gambar'    => $path, 
            'stok'      => $request->stok, 
        ]);

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Menu berhasil ditambahkan!');
    }
}
