<?php

namespace App\Http\Controllers;

use App\Models\Lomba;
use App\Models\Kategori;
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
        $kategoriCount = Kategori::count();
        $lombas = Lomba::all();
        $kategoris = Kategori::all();
        return view('landing.index', compact('usercount', 'lombaCount', 'pendaftaranCount', 'pembayaranCount', 'kategoriCount', 'lombas', 'kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}