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
            $table->enum('tipe_papan_bunga', ['Ucapan Selamat', 'Duka Cita', 'Pernikahan', 'Sunat Rasul']);
            $table->enum('ukuran', ['Kecil', 'Sedang', 'Besar']);
            $table->enum('status', ['Bayar', 'Belum Bayar'])->default('Belum Bayar');
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
