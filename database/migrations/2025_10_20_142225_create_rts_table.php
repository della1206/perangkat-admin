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
        Schema::create('rt', function (Blueprint $table) {
            $table->id('rt_id');
            $table->foreignId('rw_id')
                  ->constrained('rw', 'rw_id')
                  ->cascadeOnDelete(); // Foreign key ke tabel rw
            $table->string('nomor_rt', 10);
            $table->foreignId('ketua_rt_warga_id')
                  ->nullable()
                  ->constrained('warga', 'warga_id')
                  ->nullOnDelete(); // Foreign key ke tabel warga
            $table->text('keterangan')->nullable();
            $table->timestamps();

            // Composite unique key: nomor_rt harus unik per RW
            $table->unique(['rw_id', 'nomor_rt']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rt');
    }
};