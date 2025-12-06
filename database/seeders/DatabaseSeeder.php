<?php

namespace Database\Seeders;

use App\Models\MenuModel;
use App\Models\pelangganModel;
use App\Models\PengelolaModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Container\Attributes\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function Symfony\Component\Clock\now;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // data pengelola dummy
        $pengelolaData = [
            [
                'id_pengelola' => 1,
                'nama_pengelola' => 'admin',
                'username' => 'admin',
                'password' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // data pelanggan dummy
        $pelangganData = [
            [
                'id_pelanggan' => 1,
                'nama_pelanggan' => 'budi',
                'username' => 'budi',
                'password' => 'budi',
                'no_telepon' => '6289',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Data dummy untuk tabel 'menu'
        $menuData = [
            [
                'id_pengelola' => 1, // Pastikan ID pengelola ini ada di tabel 'pengelola'
                'nama_menu' => 'Nasi Goreng Spesial',
                'kategori' => 'Makanan',
                'harga' => 25000,
                'deskripsi' => 'Nasi yang digoreng dengan bumbu rempah spesial, telur, dan irisan ayam.',
                'gambar' => 'images/makanan/makanan-1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pengelola' => 1,
                'nama_menu' => 'Ayam Geprek Sambal Matah',
                'kategori' => 'Makanan',
                'harga' => 22000,
                'deskripsi' => 'Ayam goreng renyah yang digeprek dengan sambal matah segar.',
                'gambar' => 'images/makanan/makanan-3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pengelola' => 1,
                'nama_menu' => 'Jus Jeruk',
                'kategori' => 'Minuman',
                'harga' => 18000,
                'deskripsi' => 'Paduan kopi, susu creamy, dan gula aren otentik.',
                'gambar' => 'images/minuman/minuman-1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pengelola' => 1,
                'nama_menu' => 'Es Kopi Susu Aren',
                'kategori' => 'Minuman',
                'harga' => 18000,
                'deskripsi' => 'Paduan kopi, susu creamy, dan gula aren otentik.',
                'gambar' => 'images/minuman/minuman-3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        
        PengelolaModel::insert($pengelolaData);
        pelangganModel::insert($pelangganData);
        MenuModel::insert($menuData);
    }
}
