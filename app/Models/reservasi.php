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

    public function pelanggan()
    {
        return $this->belongsTo(pelangganModel::class, 'id_pelanggan', 'id_pelanggan');
    }

    public function pengelola()
    {
        return $this->belongsTo(pengelolaModel::class, 'id_pengelola', 'id_pengelola'); 
    }
}
