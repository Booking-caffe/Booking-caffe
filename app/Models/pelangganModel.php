<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class pelangganModel extends Model
{
    protected $table = 'pelanggan';
    protected $primaryKey = 'id_pelanggan';
    public $incrementing = false;
    protected $fillable = [
        'id_pelanggan',
        'nama_pelanggan',
        'username',
        'password',
        'no_telepon',
        'created_at',
        'updated_at',
    ];
}
