<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $albums = Album::withCount('photos')->latest()->get();
        return view('gallery.index', compact('albums'));
    }

    public function detail($slug)
    {
        $album = Album::with('photos')->where('slug', $slug)->firstOrFail();
        return view('gallery.detail-galeri', compact('album'));
    }
}