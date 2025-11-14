<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('jabatan_lembaga', function (Blueprint $table) {
            $table->id('jabatan_id');
            $table->unsignedBigInteger('lembaga_id');
            $table->string('nama_jabatan');
            $table->integer('level')->default(1);
            $table->timestamps();

            // FIX: tabel yang benar adalah lembaga_desa
            $table->foreign('lembaga_id')
                  ->references('lembaga_id')
                  ->on('lembaga_desa')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('jabatan_lembaga');
    }
};
