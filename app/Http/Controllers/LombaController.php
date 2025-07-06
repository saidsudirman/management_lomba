<?php

namespace App\Http\Controllers;

use App\Models\Lomba;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LombaController extends Controller
{
    public function index()
    {
        $lomba = Lomba::all();
        return view('admin.lomba', compact('lomba'));
    }

    public function create(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'tanggal_mulai' => 'required|date',
                'tanggal_selesai' => 'required|date',
                'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'harga' => 'required|integer',
                'deskripsi' => 'required',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $fileName = time() . '.' . $foto->getClientOriginalExtension();
                $foto->move(public_path('foto'), $fileName);
                $path = 'foto/' . $fileName;
            }

            $lomba = new Lomba;
            $lomba->nama = $request->input('nama');
            $lomba->tanggal_mulai = $request->input('tanggal_mulai');
            $lomba->tanggal_selesai = $request->input('tanggal_selesai');
            $lomba->foto = $path ?? null;
            $lomba->harga = $request->input('harga');
            $lomba->deskripsi = $request->input('deskripsi');
            $lomba->save();

            return redirect()->route('lomba.index')->with('notification', [
                'title' => 'Selamat!',
                'text' => 'Data lomba berhasil ditambahkan',
                'type' => 'success',
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->getMessageBag()->toArray())->withInput();
        } catch (\Exception $e) {
            return redirect()->route('lomba.index')->with('notification', [
                'title' => 'Oops!',
                'text' => 'Terjadi kesalahan, coba lagi.',
                'type' => 'error',
            ]);
        }
    }

    public function store(Request $request)
    {
        // Not used
    }

    public function show(string $id)
    {
        // Not used
    }

    public function edit(string $id)
    {
        // Not used
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'tanggal_mulai' => 'required|date',
                'tanggal_selesai' => 'required|date',
                'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
                'harga' => 'required|integer',
                'deskripsi' => 'required',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $lomba = Lomba::findOrFail($id);

            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $fileName = time() . '.' . $foto->getClientOriginalExtension();
                $foto->move(public_path('foto'), $fileName);
                $path = 'foto/' . $fileName;

                if ($lomba->foto && file_exists(public_path($lomba->foto))) {
                    unlink(public_path($lomba->foto));
                }

                $lomba->foto = $path;
            }

            $lomba->nama = $request->input('nama');
            $lomba->tanggal_mulai = $request->input('tanggal_mulai');
            $lomba->tanggal_selesai = $request->input('tanggal_selesai');
            $lomba->harga = $request->input('harga');
            $lomba->deskripsi = $request->input('deskripsi');
            $lomba->save();

            return redirect()->route('lomba.index')->with('notification', [
                'title' => 'Berhasil!',
                'text' => 'Data Lomba berhasil diperbarui',
                'type' => 'success',
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->getMessageBag()->toArray())->withInput();
        } catch (\Exception $e) {
            return redirect()->route('lomba.index')->with('notification', [
                'title' => 'Oops!',
                'text' => 'Terjadi kesalahan, coba lagi.',
                'type' => 'error',
            ]);
        }
    }

    public function destroy(string $id)
    {
        $lomba = Lomba::findOrFail($id);
        $lomba->delete();

        return redirect()->route('lomba.index')->with('notification', [
            'title' => 'Selamat!',
            'text' => 'Data lomba berhasil dihapus',
            'type' => 'success',
        ]);
    }
}
