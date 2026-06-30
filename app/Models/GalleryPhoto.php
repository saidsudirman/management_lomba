<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GalleryPhoto extends Model
{
    protected $fillable = [
        'album_id',
        'foto',
        'judul',
        'deskripsi',
        'urutan'
    ];

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }
}