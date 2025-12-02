<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerangkatDesa extends Model
{
    protected $table = 'perangkat_desa';
    protected $primaryKey = 'perangkat_id';
    protected $fillable = [
        'warga_id',
        'jabatan',
        'nip',
        'kontak',
        'periode_mulai',
        'periode_selesai'
    ];

    // 🔥 Relasi ke tabel warga WAJIB ADA
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }

    // Relasi ke media
    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'perangkat_id')
                    ->where('ref_table', 'perangkat_desa')
                    ->orderBy('sort_order');
    }
}
