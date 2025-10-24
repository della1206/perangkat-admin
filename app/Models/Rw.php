<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rw extends Model
{
    use HasFactory;
    protected $primaryKey = 'rw_id';
    protected $fillable = ['nomor_rw', 'ketua_rw_warga_id', 'keterangan'];

    public function rts()
    {
        return $this->hasMany(Rt::class, 'rw_id');
    }
}

