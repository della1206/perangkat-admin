<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lembaga_desa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lembaga');
            $table->string('ketua');
            $table->string('bidang')->nullable();
            $table->string('kontak')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lembaga_desa');
    }
};
