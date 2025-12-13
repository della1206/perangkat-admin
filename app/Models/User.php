<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'photo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = ['photo_url', 'photo_thumbnail_url'];

    // Helper methods dengan underscore konsisten
    public function isSuperAdmin()
    {
        return $this->role === 'super_admin';
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isWarga()
    {
        return $this->role === 'warga';
    }

    public function hasRole($role)
    {
        return $this->role === $role;
    }

    // Getter untuk foto
    public function getPhotoUrlAttribute()
    {
        if ($this->photo) {
            return asset('storage/photos/' . $this->photo);
        }
        // Generate avatar dari nama
        $name = urlencode($this->name);
        return "https://ui-avatars.com/api/?name={$name}&background=random&color=fff&size=400";
    }

    // Getter untuk thumbnail foto
    public function getPhotoThumbnailUrlAttribute()
    {
        if ($this->photo) {
            // Asumsi: Foto thumbnail disimpan di public/storage/photos/thumbnails
            // Untuk skenario tanpa package image processing, kita gunakan foto asli dulu.
            // Namun, untuk display list yang optimal, sebaiknya gunakan logic thumbnail yang benar.
            // Sesuai logic sederhana yang Anda buat, kita tetap gunakan yang besar,
            // atau jika Anda ingin skenario yang lebih baik, buat folder 'thumbnails'.
            // Untuk konsistensi dengan index.blade.php yang Anda buat (meski salah path), 
            // saya akan ubah index.blade.php untuk menggunakan accessor ini.
            
            // Saya akan kembalikan path foto asli dulu, dan nanti di index.blade.php
            // akan menggunakan accessor ini.
            return asset('storage/photos/' . $this->photo);
        }
        // Generate avatar thumbnail dari nama
        $name = urlencode($this->name);
        return "https://ui-avatars.com/api/?name={$name}&background=random&color=fff&size=100";
    }
}