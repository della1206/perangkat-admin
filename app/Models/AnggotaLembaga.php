<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaLembaga extends Model
{
    use HasFactory;
    protected $primaryKey = 'anggota_id';
    protected $fillable = ['lembaga_id', 'warga_id', 'jabatan_id', 'tgl_mulai', 'tgl_selesai'];

    public function lembaga()
    {
        return $this->belongsTo(LembagaDesa::class, 'lembaga_id');
    }

    public function jabatan()
    {
        return $this->belongsTo(JabatanLembaga::class, 'jabatan_id');
    }
}

