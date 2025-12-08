<?php

namespace App\Http\Controllers\adminController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
