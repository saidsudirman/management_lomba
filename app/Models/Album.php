<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Album extends Model
{
    protected $fillable = [
        'nama_album',
        'slug',
        'deskripsi',
        'cover_image',
        'lokasi',
        'tanggal'
    ];

    public function photos(): HasMany
    {
        return $this->hasMany(GalleryPhoto::class)->orderBy('urutan', 'asc');
    }

    public function getPhotoCountAttribute()
    {
        return $this->photos()->count();
    }
}