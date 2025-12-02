<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengelola', function (Blueprint $table) {
            $table->integer('id_pengelola', 12)->primary();
            $table->string('nama_pengelola', 50);
            $table->string('username', 25);
            $table->string('password', 25);
            $table->timestamps();
        });

        Schema::create('pelanggan', function (Blueprint $table) {
            $table->integer('id_pelanggan', 12)->primary();
            $table->string('nama_pelanggan', 50);   
            $table->string('username', 25);   
            $table->string('password', 25);   
            $table->integer('no_telepon', 12);
            $table->timestamps();
        });

        Schema::create('reservasi', function (Blueprint $table) {
            $table->integer('id_reservasi', 12)->primary();
            $table->integer('id_pelanggan', 12);
            $table->integer('id_pengelola', 12);
            $table->date('tanggal');
            $table->time('waktu');
            $table->integer('jumlah_tamu', 12);
            $table->string('ruangan', 10);
            $table->string('nomor_meja', 10);
            $table->timestamps();

            $table->foreign('id_pelanggan')
                ->references('id_pelanggan')
                ->on('pelanggan');
                
            $table->foreign('id_pengelola')
                ->references('id_pengelola')
                ->on('pengelola');
        });

        Schema::create('menu', function (Blueprint $table) {
            $table->integer('id_menu', 12)->primary();
            $table->integer('id_pengelola', 12);
            $table->integer('id_reservasi', 12);
            $table->string('nama_menu', 50);
            $table->string('ketegori', 25);
            $table->integer('harga', 12);
            $table->timestamps();

            $table->foreign('id_reservasi')
                ->references('id_reservasi')
                ->on('reservasi');
                
            $table->foreign('id_pengelola')
                ->references('id_pengelola')
                ->on('pengelola');
        });

        Schema::create('transaksi', function (Blueprint $table) {
            $table->integer('id_transaksi', 12)->primary();
            $table->integer('id_pelanggan', 12);
            $table->integer('total', 12);
            $table->string('metode_pembayaran', 25);
            $table->string('status', 25);
            $table->timestamps();

            $table->foreign('id_pelanggan')
                ->references('id_pelanggan')
                ->on('pelanggan');
        });

        Schema::create('detail_pesanan', function (Blueprint $table) {
            $table->integer('id_detail_pesanan', 12)->primary();
            $table->integer('id_transaksi', 12);
            $table->integer('id_pelanggan', 12);
            $table->integer('total_belanja', 12);
            $table->integer('pajak', 12);
            $table->integer('total', 12);
            $table->timestamps();

            $table->foreign('id_transaksi')
                ->references('id_transaksi')
                ->on('transaksi');

            $table->foreign('id_pelanggan')
                ->references('id_pelanggan')
                ->on('pelanggan');
        });
        
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_pesanan');
        Schema::dropIfExists('transaksi');
        Schema::dropIfExists('menu');
        Schema::dropIfExists('reservasi');
        Schema::dropIfExists('pelanggan');
        Schema::dropIfExists('pengelola');
    }
};
