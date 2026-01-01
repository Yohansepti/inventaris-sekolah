<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
    Schema::create('peminjaman', function (Blueprint $table) {
    $table->id();

    $table->date('tanggal_peminjaman');
    $table->date('tanggal_pesan');
    $table->date('tanggal_pengembalian')->nullable();

    $table->unsignedBigInteger('guru_id');   // ke guru.id
    $table->string('kode_barang', 30);
    $table->string('jenis_kib', 1); // A,B,C,D,E,F

    $table->string('jam_pemakaian', 30);
    $table->string('ruang_kode', 30);

    $table->enum('status', ['Dipinjam', 'Dikembalikan'])
          ->default('Dipinjam');

    $table->year('tahun');

    $table->timestamps();

    // ===== FK =====
    $table->foreign('guru_id')->references('id')->on('guru');
    $table->foreign('ruang_kode')->references('kode_ruangan')->on('ruang');
});
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
