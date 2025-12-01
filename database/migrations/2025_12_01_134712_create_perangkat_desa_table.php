<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('perangkat_desa', function (Blueprint $table) {
            $table->id('perangkat_id');
            $table->unsignedBigInteger('warga_id');
            $table->string('jabatan');
            $table->string('nip')->nullable();
            $table->string('kontak')->nullable();
            $table->date('periode_mulai')->nullable();
            $table->date('periode_selesai')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('perangkat_desa');
    }
};
