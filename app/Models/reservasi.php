<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class reservasi extends Model
{
    protected $table = 'reservasi';
    protected $primaryKey = 'id_reservasi';
    public $incrementing = true;

    protected $fillable = [
        'reservasi_meja',
        'id_meja',
        'id_pelanggan',
        'id_pengelola',
        'tanggal',
        'waktu',
        'jumlah_tamu',
        'ruangan',
        'ruangan' => 'array',
    ];

    // ========================
    // RELASI
    // ========================

    public function pelanggan()
    {
        return $this->belongsTo(
            pelangganModel::class,
            'id_pelanggan',
            'id_pelanggan'
        );
    }

    public function pengelola()
    {
        return $this->belongsTo(
            pengelolaModel::class,
            'id_pengelola',
            'id_pengelola'
        );
    }

    /**
     * 🔥 RELASI KE MEJA (MELALUI PIVOT reservasi_meja)
     */
    public function meja()
    {
        return $this->belongsToMany(
            Meja::class,          // model tujuan
            'reservasi_meja',     // tabel pivot
            'id_reservasi',       // FK di pivot ke reservasi
            'id_meja'             // FK di pivot ke meja
        );
    }
}
