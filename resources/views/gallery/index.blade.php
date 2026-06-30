{{-- resources/views/gallery/index.blade.php --}}
@extends('layout.landing.app')
@section('content')
@push('styles')
<style>
    /* Style untuk Album Gallery */
    .gallery-album-card {
        transition: all 0.3s ease;
        cursor: pointer;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        background: white;
        height: 100%;
    }
    
    .gallery-album-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.2);
    }
    
    .gallery-album-card .album-cover {
        position: relative;
        height: 250px;
        overflow: hidden;
    }
    
    .gallery-album-card .album-cover img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .gallery-album-card:hover .album-cover img {
        transform: scale(1.1);
    }
    
    .gallery-album-card .album-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(255, 255, 255, 0.7));
        padding: 30px 20px 20px;
        color: white;
    }
    
    .gallery-album-card .album-overlay h4 {
        margin: 0;
        font-weight: 600;
        font-size: 18px;
    }
    
    .gallery-album-card .album-overlay .photo-count {
        font-size: 14px;
        opacity: 0.9;
    }
    
    .gallery-album-card .album-body {
        padding: 20px;
    }
    
    .gallery-album-card .album-body p {
        color: #666;
        margin-bottom: 10px;
        font-size: 14px;
        line-height: 1.6;
    }
    
    .gallery-album-card .album-body .album-date {
        color: #999;
        font-size: 12px;
    }
    
    .gallery-album-card .album-body .album-date i {
        margin-right: 5px;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .gallery-album-card .album-cover {
            height: 200px;
        }
    }
</style>
@endpush

<!-- Banner/Hero Section -->
<div class="banner-carousel banner-carousel-1 mb-0">
    <div class="banner-carousel-item" style="background-image:url({{ asset('img/unsplash/impas4.jpeg') }})">
        <div class="slider-content">
            <div class="container h-100">
                <div class="row align-items-center h-100">
                    <div class="col-md-12 text-center">
                        <h2 class="slide-title" data-animation-in="slideInLeft">Galeri Kegiatan</h2>
                        <h3 class="slide-sub-title" data-animation-in="slideInRight">IMPAS DIPA MAKASSAR</h3>
                        <p data-animation-in="slideInLeft" data-duration-in="1.2">
                            Dokumentasi momen berharga dalam setiap kegiatan kami
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Album Gallery Section -->
<section id="gallery-albums" class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="into-title">Album Galeri</h2>
            <h3 class="into-sub-title">Koleksi Foto Kegiatan</h3>
            <p class="text-muted">Klik pada album untuk melihat foto-foto di dalamnya</p>
        </div>

        <div class="row">
            @forelse ($albums as $album)
                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="{{ route('gallery.detail', $album->slug) }}" class="text-decoration-none">
                        <div class="gallery-album-card">
                            <div class="album-cover">
                                <img src="{{ asset($album->cover_image ?? 'img/default-album.jpg') }}" 
                                     alt="{{ $album->nama_album }}">
                                <div class="album-overlay">
                                    <h4>{{ $album->nama_album }}</h4>
                                    <span class="photo-count">
                                        <i class="fas fa-images"></i> {{ $album->photos_count }} Foto
                                    </span>
                                </div>
                            </div>
                            <div class="album-body">
                                <p>{{ Str::limit($album->deskripsi, 80) }}</p>
                                <div class="album-date">
                                    <i class="far fa-calendar-alt"></i> 
                                    {{ $album->tanggal ? \Carbon\Carbon::parse($album->tanggal)->format('d F Y') : 'Tanggal tidak tersedia' }}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="fas fa-images fa-3x text-muted mb-3"></i>
                    <h4>Belum Ada Album</h4>
                    <p class="text-muted">Belum ada album galeri yang tersedia saat ini.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection