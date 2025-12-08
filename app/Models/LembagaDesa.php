<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LembagaDesa extends Model
{
    use HasFactory;

    protected $table = 'lembaga_desa';
    protected $primaryKey = 'lembaga_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nama_lembaga',
        'ketua',
        'deskripsi',
        'kontak',
        'logo',
    ];

    // Untuk multiple foto
    public function getFotoAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    public function setFotoAttribute($value)
    {
        $this->attributes['foto'] = json_encode($value);
    }
}