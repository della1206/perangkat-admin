<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanLembaga extends Model
{
    use HasFactory;

    protected $table = 'jabatan_lembaga';

    protected $fillable = [
        'lembaga_id',
        'nama_jabatan',
        'level',
    ];

    public function lembaga()
    {
        return $this->belongsTo(Lembaga::class);
    }
}
