<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerangkatDesa extends Model
{
    use HasFactory;
    protected $primaryKey = 'perangkat_id';
    protected $fillable = ['warga_id', 'jabatan', 'nip', 'kontak', 'foto', 'periode_mulai', 'periode_selesai'];
}

