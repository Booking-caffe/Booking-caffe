<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengelola', function (Blueprint $table) {
            $table->bigIncrements('id_pengelola');
            $table->string('nama_pengelola', 50);
            $table->string('username', 25);
            $table->string('password');
            $table->timestamps();
        });

        Schema::create('pelanggan', function (Blueprint $table) {
            $table->bigIncrements('id_pelanggan'); 
            $table->string('nama_pelanggan', 50);   
            $table->string('username', 25);   
            $table->string('password');   
            $table->string('no_telepon', 15);
            $table->timestamps();
        });

        Schema::create('reservasi', function (Blueprint $table) {
            $table->bigIncrements('id_reservasi');
            $table->unsignedBigInteger('id_pelanggan');
            $table->unsignedBigInteger('id_pengelola')->nullable();
            $table->date('tanggal');
            $table->time('waktu');
            $table->integer('jumlah_tamu');
            $table->text('ruangan');
            $table->text('nomor_meja');
            $table->timestamps();

            $table->foreign('id_pelanggan')
                ->references('id_pelanggan')
                ->on('pelanggan');
                
            $table->foreign('id_pengelola')
                ->references('id_pengelola')
                ->on('pengelola');
        });

        Schema::create('menu', function (Blueprint $table) {
            $table->bigIncrements('id_menu');
            $table->unsignedBigInteger('id_pengelola');
            $table->string('nama_menu', 50);
            $table->string('kategori', 25);
            $table->integer('harga');
            $table->string('deskripsi');
            $table->string('gambar');
            $table->integer('stok');
            $table->timestamps();
                
            $table->foreign('id_pengelola')
                ->references('id_pengelola')
                ->on('pengelola');
        });

        Schema::create('transaksi', function (Blueprint $table) {
            $table->bigIncrements('id_transaksi');
            $table->unsignedBigInteger('id_pelanggan');
            $table->integer('total');
            // $table->integer('pajak', 12);
            $table->string('metode_pembayaran', 25);
            $table->string('status', 25);
            $table->timestamps();

            $table->foreign('id_pelanggan')
                ->references('id_pelanggan')
                ->on('pelanggan');
        });

        Schema::create('detail_pesanan', function (Blueprint $table) {
            $table->bigIncrements('id_detail_pesanan');
            $table->unsignedBigInteger('id_transaksi');
            $table->unsignedBigInteger('id_menu');
            $table->integer('qty');
            $table->timestamps();

            $table->foreign('id_transaksi')
                ->references('id_transaksi')
                ->on('transaksi');

            $table->foreign('id_menu')
                ->references('id_menu')
                ->on('menu');
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
