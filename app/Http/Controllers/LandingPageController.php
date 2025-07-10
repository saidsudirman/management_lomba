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


    public function tampilkanMateri()
    {
        $Lombas = Lomba::all();

        return view('landing.index', [
            "title" => "Materi Impas",
            "Lombas" => $Lombas
        ]);
    }

    public function detailMateri($id)
    {
        $Lomba = Lomba::findOrFail($id);
        $LombaTerbaru = Lomba::where('id', '!=', $id)
            ->latest()
            ->take(3)
            ->get();

        return view('materi', [
            "title" => $Lomba->nama,
            "Lomba" => $Lomba,
            "LombaTerbaru" => $LombaTerbaru
        ]);
    }
}
