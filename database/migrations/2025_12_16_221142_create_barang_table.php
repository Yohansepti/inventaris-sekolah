<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->string('kode_barang', 30)->primary();
            $table->string('nama_barang', 150);
            $table->decimal('harga', 15, 2);
            $table->string('kode_sumber_dana', 20)->nullable();
            $table->timestamps();

            $table->foreign('kode_sumber_dana')
                  ->references('kode_sumber_dana')
                  ->on('sumber_dana')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};

