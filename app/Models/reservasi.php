<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class reservasi extends Model
{
    protected $table = 'reservasi';
    protected $primaryKey = 'id_reservasi';
    public $incrementing = true;
    protected $fillable = [
        'id_reservasi',
        'id_pelanggan',
        'id_pengelola',
        'tanngal',
        'waktu',
        'jumlah_tamu',
        'ruangan',
        'nomor_meja',
        'created_at',
        'update_at',
    ];
}
