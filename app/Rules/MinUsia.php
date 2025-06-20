<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Carbon\Carbon;

class MinUsia implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $tanggalLahir = Carbon::parse($value);
        $usia = $tanggalLahir->diffInYears(Carbon::now());
        
        if ($usia < 20) {
            $fail('Usia minimal 20 tahun untuk mendaftar. Usia Anda: '.$usia.' tahun');
        }
    }
}