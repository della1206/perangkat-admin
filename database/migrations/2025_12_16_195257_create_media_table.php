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
        Schema::create('media', function (Blueprint $table) {
            $table->id('media_id'); // Primary key dengan nama media_id
            $table->string('ref_table', 50)->comment('Nama tabel referensi');
            $table->unsignedBigInteger('ref_id')->comment('ID baris dari tabel referensi');
            $table->string('file_name')->comment('Nama file media yang disimpan');
            $table->string('caption')->nullable()->comment('Keterangan atau deskripsi media');
            $table->string('mime_type', 100)->comment('Tipe MIME file (misalnya: image/jpeg)');
            $table->integer('sort_order')->nullable()->comment('Urutan tampilan media');
            $table->timestamps();

            // Index untuk pencarian lebih cepat
            $table->index(['ref_table', 'ref_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};