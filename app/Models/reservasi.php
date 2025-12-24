<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class reservasi extends Model
{
    protected $table = 'reservasi';
    protected $primaryKey = 'id_reservasi';
    public $incrementing = true;
    
    protected $fillable = [
        'id_pelanggan',
        'id_pengelola',
        'tanggal',
        'waktu',
        'jumlah_tamu',
        'ruangan',
        'nomor_meja',
    ];
}
