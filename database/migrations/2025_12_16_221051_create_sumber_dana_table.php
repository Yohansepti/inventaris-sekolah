<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sumber_dana', function (Blueprint $table) {
            $table->string('kode_sumber_dana', 20)->primary();
            $table->string('nama_sumber_dana', 100);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sumber_dana');
    }
};

