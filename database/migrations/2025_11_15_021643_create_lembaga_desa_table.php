<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('lembaga_desa', function (Blueprint $table) {
            $table->id('lembaga_id');
            $table->string('nama_lembaga', 100);
            $table->text('deskripsi')->nullable();
            $table->string('kontak', 50)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lembaga_desa');
    }
};
