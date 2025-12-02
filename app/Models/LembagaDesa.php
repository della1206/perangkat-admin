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

    protected $fillable = [
        'nama_lembaga',
        'deskripsi',
        'kontak',
    ];

    // Relasi semua media (multiple upload)
    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id')
            ->where('ref_table', 'lembaga');
    }
}
