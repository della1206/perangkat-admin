<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use HasFactory;

    // Jika primary key bukan 'id', tambahkan ini
    protected $primaryKey = 'warga_id';

    // Jika nama tabel berbeda, tambahkan ini
    protected $table = 'warga';

    protected $fillable = [
        'no_ktp',
        'nama',
        'jenis_kelamin',
        'agama',
        'pekerjaan',
        'telp',
        'email'
    ];
}
