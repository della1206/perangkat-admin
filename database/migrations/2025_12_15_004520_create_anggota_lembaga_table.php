<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('anggota_lembaga', function (Blueprint $table) {
            $table->bigIncrements('anggota_id');

            $table->unsignedBigInteger('lembaga_id');
            $table->unsignedBigInteger('warga_id');
            $table->unsignedBigInteger('jabatan_id');

            $table->date('tgl_mulai');
            $table->date('tgl_selesai')->nullable();

            // FOREIGN KEY
            $table->foreign('lembaga_id')
                ->references('lembaga_id')
                ->on('lembaga_desa')
                ->onDelete('cascade');

            $table->foreign('warga_id')
                ->references('warga_id')
                ->on('wargas')
                ->onDelete('cascade');

            $table->foreign('jabatan_id')
                ->references('jabatan_id')
                ->on('jabatan_lembaga')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anggota_lembaga');
    }
};
