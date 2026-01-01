<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kib_d', function (Blueprint $table) {
            // PRIMARY KEY sekaligus FOREIGN KEY
            $table->string('kode_barang', 30)->primary();

            $table->string('ukuran', 100)->nullable();
            $table->string('bahan', 100)->nullable();
            $table->string('keadaan', 100)->nullable();
            $table->string('nomor_pabrik', 100)->nullable();
            $table->string('nomor_mesin', 100)->nullable();
            $table->string('nomor_rangka', 100)->nullable();

            $table->timestamps();

            // RELASI KE BARANG
            $table->foreign('kode_barang')
                  ->references('kode_barang')
                  ->on('barang')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kib_d');
    }
};
