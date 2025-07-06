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
    }
}