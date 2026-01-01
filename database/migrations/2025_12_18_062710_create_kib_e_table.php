<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kib_e', function (Blueprint $table) {
            $table->string('kode_barang', 30)->primary();

            $table->string('merk', 100)->nullable();
            $table->string('bahan', 100)->nullable();
            $table->string('tipe', 100)->nullable();
            $table->string('keadaan', 100)->nullable();

            // FK ke tabel barang
            $table->foreign('kode_barang')
                  ->references('kode_barang')
                  ->on('barang')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kib_e');
    }
};
