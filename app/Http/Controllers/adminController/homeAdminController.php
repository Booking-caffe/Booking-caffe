<?php

namespace App\Http\Controllers\adminController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\pelangganModel;
use App\Models\reservasi;

class homeAdminController extends Controller
{
    // home admin
    public function home(){

        if(Session::get('id_pengelola') === null)
        {
            abort(403, 'Unauthorize');
        }
        return view('Admin.dashboard');
    }

    public function dataUser(){
       
        $reservasi = reservasi::all(); 
        // atau pakai where jika perlu
        
        return view('admin.datauser', compact('reservasi'));
    }

    
}
