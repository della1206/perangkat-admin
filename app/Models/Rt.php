<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rt extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'rt_id';
    protected $fillable = ['rw_id', 'nomor_rt', 'ketua_rt_warga_id', 'keterangan'];

    // Relasi ke RW
    public function rw()
    {
        return $this->belongsTo(Rw::class, 'rw_id');
    }

    // Relasi ke Warga (ketua RT)
    public function ketuaRt()
    {
        return $this->belongsTo(Warga::class, 'ketua_rt_warga_id', 'warga_id');
    }

    // Scope untuk pencarian
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where('nomor_rt', 'like', "%{$search}%")
                        ->orWhere('keterangan', 'like', "%{$search}%")
                        ->orWhereHas('ketuaRt', function($q) use ($search) {
                            $q->where('nama', 'like', "%{$search}%");
                        })
                        ->orWhereHas('rw', function($q) use ($search) {
                            $q->where('nomor_rw', 'like', "%{$search}%");
                        });
        }
        return $query;
    }

    // Scope untuk filter RW
    public function scopeFilterRw($query, $rwId)
    {
        if ($rwId) {
            return $query->where('rw_id', $rwId);
        }
        return $query;
    }
}
