<?php

namespace App\Http\Controllers\adminController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\pelangganModel;
use App\Models\reservasi;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class homeAdminController extends Controller
{
    // home admin
    public function home(){

        // ===== DATA CHART RESERVASI (punyamu yang sekarang) =====
        $reservasi = Reservasi::selectRaw('tanggal, COUNT(*) as total')
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();


        $period = CarbonPeriod::create(
            now()->subDays(6),
            now()
        );

        $map = $reservasi->pluck('total', 'tanggal');

        $labels = [];
        $data = [];

        foreach ($period as $date) {
            $tgl = $date->format('Y-m-d');
            $labels[] = $date->format('d M');
            $data[] = $map[$tgl] ?? 0;
        }

        // ===== TOTAL TRANSAKSI VALID =====
        $totalRevenue = Transaksi::where('status', 'tervalidasi')
            ->sum('total');

        return view('admin.dashboard', compact(
            'labels',
            'data',
            'totalRevenue'
        ));

        return view('admin.dashboard', compact(
            'labels',
            'data',
            'totalRevenue'
        ));
    }

    public function dataUser(){
       
        $reservasi = reservasi::all(); 
        // atau pakai where jika perlu
        
        return view('admin.datauser', compact('reservasi'));
    }

    
}
