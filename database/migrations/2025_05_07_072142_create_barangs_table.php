<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->enum('tipe_barang', ['ucapan selamat', 'duka cita', 'pernikahan', 'sunat rasul']);
            $table->enum('ukuran_barang', ['kecil', 'sedang', 'besar']);
            $table->enum('status', ['bayar', 'belum bayar'])->default('belum bayar');
            $table->decimal('harga', 15, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
