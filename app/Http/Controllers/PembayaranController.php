<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembayaran = Pembayaran::with('pendaftaran')->get();

        return view('admin.datapembayaran', compact('pembayaran'));
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|numeric',
            'tanggal_pembayaran' => 'required|date',
        ]);

        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update([
            'jumlah' => $request->jumlah,
            'tanggal_pembayaran' => $request->tanggal_pembayaran,
        ]);

        return redirect()->route('pembayaran.index')->with('success', 'Data pembayaran berhasil diperbarui.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Pembayaran::findOrFail($id);
        $user->delete();

        // $notification = [
        //     'title' => 'Selamat!',
        //     'text' => 'Data pengguna berhasil dihapus',
        //     'type' => 'success',
        // ];

        return redirect()->route('pendaftaran.index')->with('success', 'Profil berhasil diperbarui');
    }
}