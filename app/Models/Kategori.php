<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    protected $fillable = [
        'nama_kategori',
    ];

    public function lomba()
    {
        return $this->hasMany(Lomba::class, 'kategori_id');
    }

    public function pendaftaran()
    {
        return $this->hasManyThrough(
            Pendaftaran::class,
            Lomba::class,
            'kategori_id',
            'id_lomba',
            'id',
            'id' 
        );
    }
}