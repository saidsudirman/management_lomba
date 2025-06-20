<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran';

    protected $fillable = [
        'id_lomba',
        'kategori_id',
        'nama_peserta',
        'email',
        'no_hp',
        'alamat',
        'asal_sekolah',
        'nisn',
        'tanggal_lahir', // Tambahkan ini
        'status_pembayaran',
        'tanggal_pendaftaran',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'status_pembayaran' => 'integer',
        'tanggal_pendaftaran' => 'datetime',
    ];

    // Accessor untuk usia
    public function getUsiaAttribute()
    {
        return Carbon::parse($this->tanggal_lahir)->age;
    }

    public function lomba()
    {
        return $this->belongsTo(Lomba::class, 'id_lomba');
    }

    public function kategori()
    {
        return $this->belongsTo(Lomba::class, 'kategori_id');
    }
}