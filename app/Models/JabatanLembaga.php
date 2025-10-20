<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanLembaga extends Model
{
    use HasFactory;
    protected $primaryKey = 'jabatan_id';
    protected $fillable = ['lembaga_id', 'nama_jabatan', 'level'];

    public function lembaga()
    {
        return $this->belongsTo(LembagaDesa::class, 'lembaga_id');
    }

    public function anggota()
    {
        return $this->hasMany(AnggotaLembaga::class, 'jabatan_id');
    }
}

