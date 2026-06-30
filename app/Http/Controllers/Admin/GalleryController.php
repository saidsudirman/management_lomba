<?php
// app/Http/Controllers/Admin/GalleryController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\GalleryPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $albums = Album::withCount('photos')->latest()->get();
        return view('admin.gallery.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_album' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'lokasi' => 'nullable|string|max:255',
            'tanggal' => 'nullable|date',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->nama_album) . '-' . time();

        // Upload Cover Image ke public/img/gallery/covers
        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            
            // Buat folder jika belum ada
            $folderPath = public_path('img/gallery/covers');
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }
            
            // Generate nama file
            $filename = time() . '_cover_' . Str::slug($request->nama_album) . '.' . $file->getClientOriginalExtension();
            
            // Pindahkan file
            $file->move($folderPath, $filename);
            
            // Simpan path ke database
            $data['cover_image'] = 'img/gallery/covers/' . $filename;
        }

        Album::create($data);

        return redirect()->route('gallery.index')
            ->with('notification', [
                'title' => 'Berhasil!',
                'text' => 'Album berhasil ditambahkan.',
                'type' => 'success'
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $album = Album::with('photos')->findOrFail($id);
        return view('admin.gallery.show', compact('album'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $album = Album::findOrFail($id);
        return view('admin.gallery.edit', compact('album'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $album = Album::findOrFail($id);

        $request->validate([
            'nama_album' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'lokasi' => 'nullable|string|max:255',
            'tanggal' => 'nullable|date',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $data = $request->all();

        // Upload Cover Image ke public/img/gallery/covers
        if ($request->hasFile('cover_image')) {
            // Hapus cover lama
            if ($album->cover_image && file_exists(public_path($album->cover_image))) {
                unlink(public_path($album->cover_image));
            }
            
            $file = $request->file('cover_image');
            
            // Buat folder jika belum ada
            $folderPath = public_path('img/gallery/covers');
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }
            
            // Generate nama file
            $filename = time() . '_cover_' . Str::slug($request->nama_album) . '.' . $file->getClientOriginalExtension();
            
            // Pindahkan file
            $file->move($folderPath, $filename);
            
            // Simpan path ke database
            $data['cover_image'] = 'img/gallery/covers/' . $filename;
        }

        $album->update($data);

        return redirect()->route('gallery.index')
            ->with('notification', [
                'title' => 'Berhasil!',
                'text' => 'Album berhasil diperbarui.',
                'type' => 'success'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $album = Album::with('photos')->findOrFail($id);

        // Hapus cover
        if ($album->cover_image && file_exists(public_path($album->cover_image))) {
            unlink(public_path($album->cover_image));
        }

        // Hapus semua foto
        foreach ($album->photos as $photo) {
            if ($photo->foto && file_exists(public_path($photo->foto))) {
                unlink(public_path($photo->foto));
            }
            $photo->delete();
        }

        $album->delete();

        return redirect()->route('gallery.index')
            ->with('notification', [
                'title' => 'Berhasil!',
                'text' => 'Album dan semua fotonya berhasil dihapus.',
                'type' => 'success'
            ]);
    }

    // ============ MANAJEMEN FOTO ============

    /**
     * Store a newly created photo in storage.
     */
    public function storePhoto(Request $request)
    {
        $request->validate([
            'album_id' => 'required|exists:albums,id',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,heic',
        ]);

        $album = Album::findOrFail($request->album_id);
        
        // Upload Foto ke public/img/gallery/photos
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            
            // Buat folder jika belum ada
            $folderPath = public_path('img/gallery/photos');
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }
            
            // Buat folder per album
            $albumFolder = $folderPath . '/' . $album->id;
            if (!file_exists($albumFolder)) {
                mkdir($albumFolder, 0777, true);
            }
            
            // Generate nama file
            $filename = time() . '_' . Str::slug($request->judul ?? 'foto') . '.' . $file->getClientOriginalExtension();
            
            // Pindahkan file ke folder album
            $file->move($albumFolder, $filename);
            
            // Simpan path ke database
            $path = 'img/gallery/photos/' . $album->id . '/' . $filename;
            
            GalleryPhoto::create([
                'album_id' => $request->album_id,
                'foto' => $path,
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'urutan' => $album->photos()->count() + 1,
            ]);
        }

        return redirect()->route('gallery.show', $request->album_id)
            ->with('notification', [
                'title' => 'Berhasil!',
                'text' => 'Foto berhasil ditambahkan.',
                'type' => 'success'
            ]);
    }

    /**
     * Update the specified photo in storage.
     */
    public function updatePhoto(Request $request, $id)
    {
        $photo = GalleryPhoto::findOrFail($id);

        $request->validate([
            'judul' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'urutan' => 'nullable|integer|min:0',
        ]);

        $data = $request->only(['judul', 'deskripsi', 'urutan']);

        // Upload Foto ke public/img/gallery/photos
        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($photo->foto && file_exists(public_path($photo->foto))) {
                unlink(public_path($photo->foto));
            }
            
            $file = $request->file('foto');
            
            // Buat folder jika belum ada
            $albumId = $photo->album_id;
            $folderPath = public_path('img/gallery/photos/' . $albumId);
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }
            
            // Generate nama file
            $filename = time() . '_' . Str::slug($request->judul ?? 'foto') . '.' . $file->getClientOriginalExtension();
            
            // Pindahkan file
            $file->move($folderPath, $filename);
            
            // Simpan path ke database
            $data['foto'] = 'img/gallery/photos/' . $albumId . '/' . $filename;
        }

        $photo->update($data);

        return redirect()->route('gallery.show', $photo->album_id)
            ->with('notification', [
                'title' => 'Berhasil!',
                'text' => 'Foto berhasil diperbarui.',
                'type' => 'success'
            ]);
    }

    /**
     * Remove the specified photo from storage.
     */
    public function destroyPhoto($id)
    {
        $photo = GalleryPhoto::findOrFail($id);
        $albumId = $photo->album_id;

        // Hapus file foto
        if ($photo->foto && file_exists(public_path($photo->foto))) {
            unlink(public_path($photo->foto));
            
            // Hapus folder album jika kosong
            $folderPath = dirname(public_path($photo->foto));
            if (is_dir($folderPath) && count(scandir($folderPath)) == 2) {
                rmdir($folderPath);
            }
        }

        $photo->delete();

        return redirect()->route('gallery.show', $albumId)
            ->with('notification', [
                'title' => 'Berhasil!',
                'text' => 'Foto berhasil dihapus.',
                'type' => 'success'
            ]);
    }
}