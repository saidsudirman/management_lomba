<?php

namespace App\Http\Controllers;

use App\Models\Lomba;
use App\Models\Pendaftaran;
use App\Rules\MinUsia;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DataPendaftaranController extends Controller
{
    public function index()
    {
        $pendaftaran = Pendaftaran::with('lomba')
            ->orderByDesc('tanggal_pendaftaran')
            ->get();

        $lombas = Lomba::all();

        return view('admin.datapendaftaran', compact('pendaftaran', 'lombas'));
    }

    public function create()
    {
        return view('landing.daftar', [
            'lombas' => Lomba::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:pendaftaran,email',
            'alamat' => 'required|string',
            'id_lomba' => 'required|exists:lomba,id',
            'no_hp' => 'required|string|max:15',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'asal_sekolah' => 'required|string|max:255',
            'tanggal_lahir' => ['required', 'date'], // ← HAPUS new MinUsia
            'status_pembayaran' => 'required|in:1,2',
        ]);

        Pendaftaran::create([
            'nama_peserta' => $validatedData['username'],
            'email' => $validatedData['email'],
            'alamat' => $validatedData['alamat'],
            'id_lomba' => $validatedData['id_lomba'],
            'no_hp' => $validatedData['no_hp'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            'asal_sekolah' => $validatedData['asal_sekolah'],
            'tanggal_lahir' => $validatedData['tanggal_lahir'],
            'tanggal_pendaftaran' => now(),
            'status_pembayaran' => $validatedData['status_pembayaran'],
        ]);

        return redirect()->route('pendaftaran.index')->with('success', 'Data pendaftar berhasil ditambahkan.');
    }


    public function storeLanding(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:pendaftaran,email',
            'alamat' => 'required|string',
            'id_lomba' => 'required|exists:lomba,id',
            'no_hp' => 'required|string|max:15',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'asal_sekolah' => 'required|string|max:255',
            'tanggal_lahir' => ['required', 'date'], // ← HAPUS new MinUsia
        ]);

        $pendaftaran = Pendaftaran::create([
            'nama_peserta' => $validatedData['username'],
            'email' => $validatedData['email'],
            'alamat' => $validatedData['alamat'],
            'id_lomba' => $validatedData['id_lomba'],
            'no_hp' => $validatedData['no_hp'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            'asal_sekolah' => $validatedData['asal_sekolah'],
            'tanggal_lahir' => $validatedData['tanggal_lahir'],
            'tanggal_pendaftaran' => now(),
            'status_pembayaran' => 1,
        ]);

        return redirect()->route('pendaftaran.detail', $pendaftaran->id)->with('success', 'Pendaftaran berhasil!');
    }


    public function pendaftaranDetail($id)
    {
        $pendaftaran = Pendaftaran::with('lomba')->findOrFail($id);
        $usia = Carbon::parse($pendaftaran->tanggal_lahir)->age;
        return view('cetak.cetak', compact('pendaftaran'));
    }

    public function cetak()
    {
        $data = Pendaftaran::with('lomba')->get();
        return view('cetak.cetak-pendaftaran', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'alamat' => 'required|string',
            'id_lomba' => 'required|exists:lomba,id',
            'no_hp' => 'required|string|max:15',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'asal_sekolah' => 'required|string|max:255',
            'status_pembayaran' => 'required|in:1,2',
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update([
            'nama_peserta' => $validatedData['username'],
            'email' => $validatedData['email'],
            'alamat' => $validatedData['alamat'],
            'id_lomba' => $validatedData['id_lomba'],
            'no_hp' => $validatedData['no_hp'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            'asal_sekolah' => $validatedData['asal_sekolah'],
            'status_pembayaran' => $validatedData['status_pembayaran'],
        ]);

        return redirect()->back()->with('success', 'Data pendaftaran berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->delete();

        return redirect()->route('pendaftaran.index')->with('success', 'Data pendaftaran berhasil dihapus');
    }
}
