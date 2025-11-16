<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanLembaga extends Model
{
    use HasFactory;

    protected $table = 'jabatan_lembaga';
    protected $primaryKey = 'jabatan_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'lembaga_id',
        'nama_jabatan',
        'level'
    ];

    protected $casts = [
        'level' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relasi ke LembagaDesa
    public function lembaga()
    {
        return $this->belongsTo(LembagaDesa::class, 'lembaga_id', 'lembaga_id');
    }
}
