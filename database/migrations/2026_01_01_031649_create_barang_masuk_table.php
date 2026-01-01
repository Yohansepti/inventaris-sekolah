<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('barang_masuk', function (Blueprint $table) {
            $table->id();

            // Jenis KIB
            $table->enum('jenis_kib', ['a','b','c','d','e','f']);

            // Barang
            $table->string('kode_barang');

            // Tanggal & jumlah
            $table->date('tanggal_masuk');
            $table->integer('jumlah');

            // Relasi
            $table->foreignId('guru_id')
                  ->constrained('guru')
                  ->cascadeOnDelete();

            $table->string('ruang_kode');

            // Opsional (untuk filter)
            $table->year('tahun');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barang_masuk');
    }
};

