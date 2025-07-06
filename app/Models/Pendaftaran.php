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
        'nama_peserta',
        'email',
        'no_hp',
        'jenis_kelamin',
        'alamat',
        'asal_sekolah',
        'tanggal_lahir',
        'status_pembayaran',
        'tanggal_pendaftaran',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'status_pembayaran' => 'integer',
        'tanggal_pendaftaran' => 'datetime',
    ];

    // Accessor untuk menghitung usia
    public function getUsiaAttribute()
    {
        return Carbon::parse($this->tanggal_lahir)->age;
    }

    public function lomba()
    {
        return $this->belongsTo(Lomba::class, 'id_lomba');
    }
}
