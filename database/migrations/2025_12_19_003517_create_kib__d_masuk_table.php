<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    public function up(): void
    {
   Schema::create('kib_d_masuk', function (Blueprint $table) {
    $table->id();

    $table->string('kode_barang', 30);

    // atribut khusus KIB D
    $table->string('merk')->nullable();
    $table->string('ukuran')->nullable();
    $table->string('bahan')->nullable();
    $table->string('no_pabrik')->nullable();
    $table->string('no_rangka')->nullable();
    $table->string('no_mesin')->nullable();

    // transaksi
    $table->string('kode_sumber_dana', 20);
    $table->date('tanggal_masuk');
    $table->decimal('harga', 15, 2);
    $table->enum('keadaan', ['Baik', 'Rusak', 'Rusak Berat']);
    $table->integer('jumlah');

    // relasi
    $table->unsignedBigInteger('guru_id');
    $table->string('ruang_kode', 30);
    $table->year('tahun');

    $table->timestamps();

    // FK
    $table->foreign('kode_barang')
          ->references('kode_barang')->on('kib_d')
          ->cascadeOnDelete();

    $table->foreign('kode_sumber_dana')
          ->references('kode_sumber_dana')->on('sumber_dana');

    $table->foreign('guru_id')
          ->references('id')->on('guru');

    $table->foreign('ruang_kode')
          ->references('kode_ruangan')->on('ruang');
});
}
    

    public function down(): void
    {
        Schema::dropIfExists('kib__d_masuk');
    }
};
