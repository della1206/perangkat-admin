<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LembagaDesa extends Model
{
    use HasFactory;

    protected $table = 'lembaga_desa';

    protected $fillable = [
        'nama_lembaga',
        'ketua',
        'bidang',
        'kontak',
        'deskripsi',
    ];
}
