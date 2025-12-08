<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lembaga_desa', function (Blueprint $table) {
            $table->string('logo')->nullable()->after('nama_lembaga');
            $table->json('foto')->nullable()->after('logo');
            $table->string('ketua')->nullable()->after('nama_lembaga');
        });
    }

    public function down(): void
    {
        Schema::table('lembaga_desa', function (Blueprint $table) {
            $table->dropColumn(['logo', 'foto', 'ketua']);
        });
    }
};