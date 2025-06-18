<?php

namespace App\Http\Controllers;

use App\Models\Lomba;
use App\Models\Pendaftaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataPendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pendaftaran = Pendaftaran::with('lomba')
            ->orderBy('tanggal_pendaftaran', 'desc')
            ->get();
            
        return view('admin.datapendaftaran', [
            'pendaftaran' => $pendaftaran,
            'lombas' => Lomba::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('landing.daftar', [
            'lombas' => Lomba::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'alamat' => 'required|string',
            'nisn' => 'required|string|max:20',
            'id_lomba' => 'required|exists:lomba,id',
            'no_hp' => 'required|string|max:15',
            'asal_sekolah' => 'required|string|max:255',
        ]);

        Pendaftaran::create([
            'nama_peserta' => $validatedData['username'],
            'email' => $validatedData['email'],
            'alamat' => $validatedData['alamat'],
            'nisn' => $validatedData['nisn'],
            'id_lomba' => $validatedData['id_lomba'],
            'no_hp' => $validatedData['no_hp'],
            'asal_sekolah' => $validatedData['asal_sekolah'],
            'tanggal_pendaftaran' => Carbon::now(),
            'status_pembayaran' => 'required|in:1,2',
        ]);

        return redirect()->route('pendaftaran.index')
            ->with('success', 'Data pendaftar berhasil ditambahkan.');
    }

    /**
     * Store from landing page
     */
    public function storeLanding(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'alamat' => 'required|string',
            'nisn' => 'required|string|max:20',
            'id_lomba' => 'required|exists:lomba,id',
            'no_hp' => 'required|string|max:15',
            'asal_sekolah' => 'required|string|max:255',
        ]);

        $pendaftaran = Pendaftaran::create([
            'nama_peserta' => $validatedData['username'],
            'email' => $validatedData['email'],
            'alamat' => $validatedData['alamat'],
            'nisn' => $validatedData['nisn'],
            'id_lomba' => $validatedData['id_lomba'],
            'no_hp' => $validatedData['no_hp'],
            'asal_sekolah' => $validatedData['asal_sekolah'],
            'tanggal_pendaftaran' => now(),
            'status_pembayaran' => 1,
        ]);

        return redirect()->route('pendaftaran.detail', $pendaftaran->id)
            ->with('success', 'Pendaftaran berhasil!');
    }

    /**
     * Display registration detail
     */
    public function pendaftaranDetail($id)
    {
        $pendaftaran = Pendaftaran::with('lomba')->findOrFail($id);
        return view('cetak.cetak', compact('pendaftaran'));
    }

    /**
     * Print all registrations
     */
    public function cetak()
    {
        $data = Pendaftaran::with('lomba')->get();
        return view('cetak.cetak-pendaftaran', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'alamat' => 'required|string',
            'nisn' => 'required|string|max:20',
            'id_lomba' => 'required|exists:lomba,id',
            'no_hp' => 'required|string|max:15',
            'asal_sekolah' => 'required|string|max:255',
            'status_pembayaran' => 'required|in:1,2',
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update([
            'nama_peserta' => $validatedData['username'],
            'email' => $validatedData['email'],
            'alamat' => $validatedData['alamat'],
            'nisn' => $validatedData['nisn'],
            'id_lomba' => $validatedData['id_lomba'],
            'no_hp' => $validatedData['no_hp'],
            'asal_sekolah' => $validatedData['asal_sekolah'],
            'status_pembayaran' => $validatedData['status_pembayaran'],
        ]);

        return redirect()->back()
            ->with('success', 'Data pendaftaran berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->delete();

        return redirect()->route('pendaftaran.index')
            ->with('success', 'Data pendaftaran berhasil dihapus');
    }
}