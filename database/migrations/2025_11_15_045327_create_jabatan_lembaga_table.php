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
            $table->foreignId('lembaga_id')->constrained('lembaga_desa', 'lembaga_id')->onDelete('cascade');
            $table->string('nama_jabatan', 100);
            $table->integer('level')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jabatan_lembaga');
    }
};
