<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lomba extends Model
{
    use HasFactory;
    protected $table = 'lomba';

    protected $fillable = [
        'nama',
        'tanggal_mulai',
        'tanggal_selesai',
        'foto',
        'deskripsi',
    ];

    protected $dates = [
        'tanggal_mulai',
        'tanggal_selesai',
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'tanggal_mulai' => 'datetime',
    'tanggal_selesai' => 'datetime',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'id_lomba');
    }
}