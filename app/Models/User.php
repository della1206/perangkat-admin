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
        // Fallback ke avatar placeholder
        return asset('assets/img/fotoo.png');
    }

    // Getter untuk thumbnail foto
    public function getPhotoThumbnailUrlAttribute()
    {
        if ($this->photo) {
            return asset('storage/photos/' . $this->photo);
        }
        return asset('assets/img/fotoo.png');
    }
}