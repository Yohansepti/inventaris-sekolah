<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kib_e_masuk', function (Blueprint $table) {
    $table->id();

    $table->string('kode_barang', 30);
    $table->string('kode_sumber_dana', 20);
    $table->date('tanggal_masuk');
    $table->decimal('harga', 15, 2);
    $table->integer('jumlah');
    $table->enum('keadaan', ['Baik', 'Rusak', 'Rusak Berat']);
    $table->year('tahun');

    // ===== FK YANG BENAR =====
    $table->unsignedBigInteger('guru_id'); // ke guru.id
    $table->string('ruang_kode', 30);

    $table->timestamps();

    // ===== RELASI =====
    $table->foreign('kode_barang')
          ->references('kode_barang')
          ->on('kib_e')
          ->cascadeOnDelete();

    $table->foreign('kode_sumber_dana')
          ->references('kode_sumber_dana')
          ->on('sumber_dana');

    $table->foreign('guru_id')
          ->references('id')
          ->on('guru');

    $table->foreign('ruang_kode')
          ->references('kode_ruangan')
          ->on('ruang');
});

    }

    public function down(): void
    {
        Schema::dropIfExists('kib_e_masuk');
    }
};
