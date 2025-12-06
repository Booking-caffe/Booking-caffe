<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';

    // Ambil semua makanan
    public static function getMakanan()
    {
        return self::where('kategori', 'makanan')->get();
    }

    // Ambil semua minuman
    public static function getMinuman()
    {
        return self::where('kategori', 'minuman')->get();
    }
}