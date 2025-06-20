<?php

namespace App\Http\Controllers;

use App\Models\{Lomba, Pendaftaran};
use App\Rules\MinUsia;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DataPendaftaranController extends Controller
{
    public function index()
    {
        // // Clear cache sebelum mengambil data
        // DataPendaftaran::forget('pendaftaran_data');
        
        $pendaftaran = Pendaftaran::with(['lomba', 'kategori'])
            ->orderByDesc('tanggal_pendaftaran')
            ->get();
            
        $lombas = Lomba::all();

        return view('admin.datapendaftaran', compact('pendaftaran', 'lombas'));
    }

    public function create()
    {
        return view('landing.daftar', [
            'lombas' => Lomba::all(),
            'kategoris' => \App\Models\Kategori::all()
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:pendaftaran,email',
            'alamat' => 'required|string',
            'nisn' => 'required|string|max:20|unique:pendaftaran,nisn',
            'id_lomba' => 'required|exists:lomba,id',
            'kategori_id' => 'required|exists:kategori,id',
            'no_hp' => 'required|string|max:15',
            'asal_sekolah' => 'required|string|max:255',
            'tanggal_lahir' => ['required', 'date', new MinUsia],
            'status_pembayaran' => 'required|in:1,2',
        ]);

        Pendaftaran::create([
            'nama_peserta' => $validatedData['username'],
            'email' => $validatedData['email'],
            'alamat' => $validatedData['alamat'],
            'nisn' => $validatedData['nisn'],
            'id_lomba' => $validatedData['id_lomba'],
            'kategori_id' => $validatedData['kategori_id'],
            'no_hp' => $validatedData['no_hp'],
            'asal_sekolah' => $validatedData['asal_sekolah'],
            'tanggal_lahir' => $validatedData['tanggal_lahir'],
            'tanggal_pendaftaran' => Carbon::now(),
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
            'nisn' => 'required|string|max:20|unique:pendaftaran,nisn',
            'id_lomba' => 'required|exists:lomba,id',
            'kategori_id' => 'required|exists:kategori,id',
            'no_hp' => 'required|string|max:15',
            'asal_sekolah' => 'required|string|max:255',
            'tanggal_lahir' => ['required', 'date', new MinUsia],
        ]);

        $pendaftaran = Pendaftaran::create([
            'nama_peserta' => $validatedData['username'],
            'email' => $validatedData['email'],
            'alamat' => $validatedData['alamat'],
            'nisn' => $validatedData['nisn'],
            'id_lomba' => $validatedData['id_lomba'],
            'kategori_id' => $validatedData['kategori_id'],
            'no_hp' => $validatedData['no_hp'],
            'asal_sekolah' => $validatedData['asal_sekolah'],
            'tanggal_lahir' => $validatedData['tanggal_lahir'],
            'tanggal_pendaftaran' => now(),
            'status_pembayaran' => 1,
        ]);

        return redirect()->route('pendaftaran.detail', $pendaftaran->id)->with('success', 'Pendaftaran berhasil!');
    }

    public function pendaftaranDetail($id)
    {
        $pendaftaran = Pendaftaran::with(['lomba', 'kategori'])->findOrFail($id);
        $usia = Carbon::parse($pendaftaran->tanggal_lahir)->age;

        if ($usia < 20) {
            return redirect()->back()->with('error', 'Maaf, peserta harus berusia minimal 20 tahun. Usia Anda: ' . $usia . ' tahun');
        }

        return view('cetak.cetak', compact('pendaftaran'));
    }

    public function getLombaByKategori($id)
    {
        $lombas = \App\Models\Lomba::where('kategori_id', $id)->get(['id', 'nama']);
        return response()->json($lombas);
    }

    public function cetak()
    {
        $data = Pendaftaran::with(['lomba', 'kategori'])->get();
        return view('cetak.cetak-pendaftaran', compact('data'));
    }

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

    public function destroy($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->delete();

        return redirect()->route('pendaftaran.index')->with('success', 'Data pendaftaran berhasil dihapus');
    }
}
