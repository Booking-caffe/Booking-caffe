<?php

namespace App\Http\Controllers\adminController;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\menuModel;
use App\Models\pelangganModel;
use App\Models\reservasi;
use App\Models\detailPesanan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class dataUser extends Controller
{
    public function dataUserReservasi(){
       
        $dataUser = pelangganModel::all();
              
        return view('admin.datauser', compact('dataUser'));
    }
    
    public function hapusUser($id)
    {
        $user = pelangganModel::findOrFail($id);

        $user->delete();
        return redirect()
            ->back()
            ->with('success', 'User berhasil dihapus!!.');
    }

    public function editUser($id)
    {
        $userEdit = pelangganModel::where('id_pelanggan', $id)->findOrFail($id);
        return view('Admin.userEdit', compact('userEdit'));

    }

    public function updateUser(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'username'     => 'required|numeric',
            'password'      => 'required|integer|min:0',
            'no_telepon' => 'nullable|string',
        ]);


        $userEdit = pelangganModel::findOrFail($id);

        // Jika upload gambar baru
        // if ($request->hasFile('gambar')) {
        //     if ($menu->gambar && Storage::disk('public')->exists($menu->gambar)) {
        //         Storage::disk('public')->delete($menu->gambar);
        //     }

        //     $namaFile = Str::random(10) . '.' . $request->gambar->extension();
        //     $menu->gambar = $request->gambar->storeAs('menu', $namaFile, 'public');
        // }

        
        $update = $userEdit->update([
            'nama_pelanggan' => $request->nama_pelanggan,
            'username'     => $request->username,
            'password'      => $request->password,
            'no_telepon' => $request->no_telepon,
        ]);

        // dd($update);

        return redirect()
            ->back()
            ->with('success', 'Menu berhasil diperbarui');
    }

}
