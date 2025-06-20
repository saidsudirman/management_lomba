<?php

namespace App\Observers;

use App\Models\Pendaftaran;
use Carbon\Carbon;
use Exception;

class PendaftaranObserver
{
    public function creating(Pendaftaran $pendaftaran)
    {
        $usia = Carbon::parse($pendaftaran->tanggal_lahir)->age;
        if ($usia < 20) {
            throw new Exception('Usia minimal 20 tahun untuk mendaftar. Usia Anda: '.$usia.' tahun');
        }
    }
}