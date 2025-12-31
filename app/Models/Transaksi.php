<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    public $incrementing = true;

     protected $fillable = [
        'id_pelanggan',
        'total',
        'status',
        'metode_pembayaran'
        // tambahkan kolom lain yang ingin bisa di mass assign
    ];

    public function pelanggan()
    {
        return $this->belongsTo(pelangganModel::class, 'id_pelanggan', 'id_pelanggan');
    }

    public function detailPesanan()
    {
        return $this->hasMany(detailPesanan::class, 'id_transaksi', 'id_transaksi');
    }

    
}