<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Rw extends Model
{
    use HasFactory;
    
    protected $table = 'rw'; // TAMBAHKAN INI
    protected $primaryKey = 'rw_id';
    // TAMBAHKAN 'foto' ke fillable
    protected $fillable = [
        'nomor_rw',
        'ketua_rw_warga_id',
        'keterangan',
        'foto'
    ];

    // Boot method untuk menangani events
    protected static function boot()
    {
        parent::boot();

        // Event saat model akan disimpan (create atau update)
        static::saving(function ($model) {
            // Jika ada file foto di request
            if (request()->hasFile('foto')) {
                // Hapus foto lama jika ada
                if ($model->foto) {
                    Storage::delete('public/rw/' . $model->foto);
                }
                
                // Upload foto baru
                $file = request()->file('foto');
                $fileName = 'rw_' . time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/rw', $fileName);
                
                // Simpan nama file ke model
                $model->foto = $fileName;
            }
        });

        // Event saat model dihapus
        static::deleting(function ($model) {
            // Hapus file foto jika ada
            if ($model->foto) {
                Storage::delete('public/rw/' . $model->foto);
            }
        });
    }

    // Relasi ke Warga (ketua RW)
    public function ketuaRw()
    {
        return $this->belongsTo(Warga::class, 'ketua_rw_warga_id', 'warga_id');
    }

    // Relasi ke RT
    public function rts()
    {
        return $this->hasMany(Rt::class, 'rw_id');
    }

    // Accessor untuk URL foto
    public function getFotoUrlAttribute()
    {
        if ($this->foto) {
            return asset('storage/rw/' . $this->foto);
        }
        return asset('images/default-rw.png'); // Foto default
    }

    // Scope untuk pencarian
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where('nomor_rw', 'like', "%{$search}%")
                        ->orWhere('keterangan', 'like', "%{$search}%")
                        ->orWhereHas('ketuaRw', function($q) use ($search) {
                            $q->where('nama', 'like', "%{$search}%");
                        });
        }
        return $query;
    }
}
