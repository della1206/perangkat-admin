<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerangkatDesa extends Model
{
    use HasFactory;
    
    protected $table = 'perangkat_desa';
    protected $primaryKey = 'perangkat_id';
    
    protected $fillable = [
        'warga_id', 
        'jabatan', 
        'nip', 
        'kontak', 
        'foto', 
        'periode_mulai', 
        'periode_selesai'
    ];

    protected $casts = [
        'periode_mulai' => 'date',
        'periode_selesai' => 'date',
    ];

    // Relasi ke Warga
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }

    // Scope untuk search
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where('jabatan', 'like', "%{$search}%")
                        ->orWhere('nip', 'like', "%{$search}%")
                        ->orWhereHas('warga', function($q) use ($search) {
                            $q->where('nama', 'like', "%{$search}%");
                        });
        }
        return $query;
    }

    // Scope untuk filter jabatan
    public function scopeFilterJabatan($query, $jabatan)
    {
        if ($jabatan) {
            return $query->where('jabatan', $jabatan);
        }
        return $query;
    }
}