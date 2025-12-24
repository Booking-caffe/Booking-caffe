<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class pelangganModel extends Model
{
    protected $table = 'pelanggan';
    protected $primaryKey = 'id_pelanggan';
    public $incrementing = true;
    public $timestamps = true;
    // public $keyTeype = 'string';

    protected $fillable = [
        'id_pelanggan',
        'nama_pelanggan',
        'username',
        'password',
        'no_telepon',
    ];

     public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_pelanggan', 'id_pelanggan');
    }
}
