<?php

namespace App\Http\Controllers\adminController;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\menuModel;
use App\Models\pelangganModel;
use App\Models\reservasi;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class dataUser extends Controller
{
    public function dataUserReservasi(){
       
        $dataUser = reservasi::all(); 
        // atau pakai where jika perlu

        dd($dataUser);
        
        return view('admin.datauser', compact('dataUser'));
    }

}
