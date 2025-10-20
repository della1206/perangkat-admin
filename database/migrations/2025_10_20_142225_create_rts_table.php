<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rts', function (Blueprint $table) {
        $table->id('rt_id');
        $table->unsignedBigInteger('rw_id');
        $table->string('nomor_rt');
        $table->unsignedBigInteger('ketua_rt_warga_id')->nullable();
        $table->text('keterangan')->nullable();
        $table->timestamps();

        $table->foreign('rw_id')->references('rw_id')->on('rws')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rts');
    }
};
