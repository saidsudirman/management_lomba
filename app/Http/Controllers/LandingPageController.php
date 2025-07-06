<?php

namespace App\Http\Controllers;

use App\Models\Lomba;
use App\Models\Pembayaran;
use App\Models\Pendaftaran;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usercount = User::count();
        $lombaCount = Lomba::count();
        $pendaftaranCount = Pendaftaran::count();
        $pembayaranCount = Pembayaran::count();
        $lombas = Lomba::all();

        return view('landing.index', compact(
            'usercount', 'lombaCount', 'pendaftaranCount', 'pembayaranCount', 'lombas'
        ));
    }
}
