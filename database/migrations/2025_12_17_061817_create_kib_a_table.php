<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kib_a', function (Blueprint $table) {
            $table->string('kode_barang', 30)->primary();
            $table->string('ukuran', 100)->nullable();

            // foreign key ke tabel barang
            $table->foreign('kode_barang')->references('kode_barang')->on('barang')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kib_a');
    }
};
