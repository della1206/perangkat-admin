<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LembagaDesa extends Model
{
    use HasFactory;

    protected $table = 'lembaga_desa';
    protected $primaryKey = 'lembaga_id'; // 👈 WAJIB ADA
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nama_lembaga',
        'ketua',
        'bidang',
        'kontak',
        'deskripsi'
    ];
}
