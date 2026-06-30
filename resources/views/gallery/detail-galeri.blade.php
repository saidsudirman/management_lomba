{{-- resources/views/gallery/detail.blade.php --}}
@extends('layout.landing.app')
@section('content')
@push('styles')
<style>
    /* Style untuk Detail Album */
    .album-header {
        background: linear-gradient(135deg, #535151 0%, #5482ff 50%, #0f3460 100%);
        padding: 60px 0;
        color: white;
        position: relative;
    }
    
    .album-header .album-title {
        font-size: 36px;
        font-weight: 700;
        margin-bottom: 10px;
    }
    
    .album-header .album-meta {
        color: rgba(255,255,255,0.8);
        font-size: 14px;
    }
    
    .album-header .album-meta i {
        margin-right: 5px;
    }
    
    .album-header .album-description {
        font-size: 16px;
        color: rgba(255,255,255,0.9);
        margin-top: 15px;
        max-width: 700px;
        line-height: 1.8;
    }
    
    .album-header .back-button {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: white;
        text-decoration: none;
        padding: 10px 20px;
        border: 2px solid rgba(255,255,255,0.3);
        border-radius: 50px;
        transition: all 0.3s ease;
        margin-bottom: 20px;
        font-size: 14px;
    }
    
    .album-header .back-button:hover {
        background: white;
        color: #1a1a2e;
        border-color: white;
        transform: translateX(-5px);
    }
    
    /* Photo Grid */
    .photo-grid-container {
        padding: 50px 0;
        background: #f8f9fa;
    }
    
    .photo-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
    }
    
    .photo-item {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        cursor: pointer;
        aspect-ratio: 1;
        background: white;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    
    .photo-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.2);
    }
    
    .photo-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .photo-item:hover img {
        transform: scale(1.05);
    }
    
    .photo-item .photo-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0,0,0,0.8));
        padding: 30px 20px 20px;
        color: white;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .photo-item:hover .photo-overlay {
        opacity: 1;
    }
    
    .photo-item .photo-overlay h5 {
        margin: 0;
        font-size: 16px;
        font-weight: 600;
    }
    
    .photo-item .photo-overlay p {
        margin: 5px 0 0;
        font-size: 13px;
        opacity: 0.8;
    }
    
    .photo-item .photo-counter {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(0,0,0,0.7);
        color: white;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
    }
    
    .photo-item .photo-counter i {
        margin-right: 5px;
    }
    
    /* Lightbox Fullscreen */
    .lightbox-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.95);
        z-index: 9999;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }
    
    .lightbox-overlay.active {
        display: flex;
    }
    
    .lightbox-overlay .lightbox-content {
        max-width: 90%;
        max-height: 90vh;
        position: relative;
    }
    
    .lightbox-overlay .lightbox-content img {
        max-width: 100%;
        max-height: 90vh;
        object-fit: contain;
        border-radius: 10px;
        box-shadow: 0 10px 50px rgba(0,0,0,0.5);
    }
    
    .lightbox-overlay .lightbox-close {
        position: absolute;
        top: -50px;
        right: 0;
        color: white;
        font-size: 30px;
        cursor: pointer;
        background: none;
        border: none;
        padding: 10px;
        transition: transform 0.3s ease;
    }
    
    .lightbox-overlay .lightbox-close:hover {
        transform: rotate(90deg);
    }
    
    .lightbox-overlay .lightbox-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        color: white;
        font-size: 40px;
        cursor: pointer;
        background: rgba(255,255,255,0.1);
        border: 2px solid rgba(255,255,255,0.2);
        padding: 15px 22px;
        border-radius: 50%;
        transition: all 0.3s ease;
        backdrop-filter: blur(5px);
    }
    
    .lightbox-overlay .lightbox-nav:hover {
        background: rgba(255,255,255,0.2);
        border-color: rgba(255,255,255,0.4);
        transform: translateY(-50%) scale(1.1);
    }
    
    .lightbox-overlay .lightbox-nav.prev {
        left: 20px;
    }
    
    .lightbox-overlay .lightbox-nav.next {
        right: 20px;
    }
    
    .lightbox-overlay .lightbox-counter {
        position: absolute;
        bottom: -50px;
        left: 50%;
        transform: translateX(-50%);
        color: white;
        font-size: 14px;
        background: rgba(0,0,0,0.5);
        padding: 8px 20px;
        border-radius: 20px;
    }
    
    .lightbox-overlay .lightbox-info {
        position: absolute;
        bottom: -100px;
        left: 50%;
        transform: translateX(-50%);
        color: white;
        text-align: center;
        background: rgba(0,0,0,0.5);
        padding: 15px 30px;
        border-radius: 10px;
        backdrop-filter: blur(10px);
        width: 80%;
        max-width: 500px;
    }
    
    .lightbox-overlay .lightbox-info h5 {
        margin: 0;
        font-size: 18px;
    }
    
    .lightbox-overlay .lightbox-info p {
        margin: 5px 0 0;
        font-size: 14px;
        opacity: 0.8;
    }
    
    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
    }
    
    .empty-state i {
        font-size: 80px;
        color: #ddd;
        margin-bottom: 20px;
    }
    
    .empty-state h4 {
        color: #666;
        margin-bottom: 10px;
    }
    
    .empty-state p {
        color: #999;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .album-header {
            padding: 40px 0;
        }
        
        .album-header .album-title {
            font-size: 28px;
        }
        
        .photo-grid {
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 15px;
        }
        
        .lightbox-overlay .lightbox-nav {
            padding: 10px 15px;
            font-size: 30px;
        }
        
        .lightbox-overlay .lightbox-nav.prev {
            left: 10px;
        }
        
        .lightbox-overlay .lightbox-nav.next {
            right: 10px;
        }
        
        .lightbox-overlay .lightbox-info {
            bottom: -80px;
            padding: 10px 20px;
            width: 90%;
        }
        
        .lightbox-overlay .lightbox-info h5 {
            font-size: 16px;
        }
    }
    
    @media (max-width: 480px) {
        .photo-grid {
            grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
            gap: 10px;
        }
        
        .album-header .album-title {
            font-size: 24px;
        }
    }
</style>
@endpush

<!-- Album Header -->
<div class="album-header">
    <div class="container">
        <a href="{{ route('user.gallery.index') }}" class="back-button">
            <i class="fas fa-arrow-left"></i> Kembali ke Galeri
        </a>
        <h1 class="album-title">{{ $album->nama_album }}</h1>
        <div class="album-meta">
            @if($album->tanggal)
                <span><i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($album->tanggal)->format('d F Y') }}</span>
            @endif
            @if($album->lokasi)
                <span class="mx-3">|</span>
                <span><i class="fas fa-map-marker-alt"></i> {{ $album->lokasi }}</span>
            @endif
            <span class="mx-3">|</span>
            <span><i class="fas fa-images"></i> {{ $album->photos->count() }} Foto</span>
        </div>
        @if($album->deskripsi)
            <p class="album-description">{{ $album->deskripsi }}</p>
        @endif
    </div>
</div>

<!-- Photo Grid -->
<section class="photo-grid-container">
    <div class="container">
        @if($album->photos->count() > 0)
            <div class="photo-grid" id="photoGrid">
                @foreach ($album->photos as $index => $photo)
                    <div class="photo-item" onclick="openLightbox({{ $index }})">
                        <img src="{{ asset($photo->foto) }}" alt="{{ $photo->judul ?? 'Foto ' . ($index + 1) }}" 
                             onerror="this.src='{{ asset('img/default-photo.jpg') }}'">
                        <div class="photo-overlay">
                            @if($photo->judul)
                                <h5>{{ $photo->judul }}</h5>
                            @endif
                            @if($photo->deskripsi)
                                <p>{{ $photo->deskripsi }}</p>
                            @endif
                        </div>
                        <div class="photo-counter">
                            <i class="fas fa-search-plus"></i>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-images"></i>
                <h4>Belum Ada Foto</h4>
                <p>Album ini belum memiliki foto. Silahkan cek kembali nanti.</p>
            </div>
        @endif
    </div>
</section>

<!-- Lightbox Fullscreen -->
<div class="lightbox-overlay" id="lightbox">
    <button class="lightbox-close" onclick="closeLightbox()">
        <i class="fas fa-times"></i>
    </button>
    <button class="lightbox-nav prev" onclick="changePhoto(-1)">
        <i class="fas fa-chevron-left"></i>
    </button>
    <div class="lightbox-content">
        <img id="lightboxImg" src="" alt="Foto Preview">
    </div>
    <button class="lightbox-nav next" onclick="changePhoto(1)">
        <i class="fas fa-chevron-right"></i>
    </button>
    <div class="lightbox-counter" id="lightboxCounter">1 / 1</div>
    <div class="lightbox-info" id="lightboxInfo">
        <h5 id="lightboxTitle">Judul Foto</h5>
        <p id="lightboxDesc">Deskripsi foto</p>
    </div>
</div>

@push('scripts')
<script>
    // Data Photos dari Laravel
    const photos = @json($album->photos);
    let currentPhotoIndex = 0;

    function openLightbox(index) {
        currentPhotoIndex = index;
        const lightbox = document.getElementById('lightbox');
        const img = document.getElementById('lightboxImg');
        const counter = document.getElementById('lightboxCounter');
        const title = document.getElementById('lightboxTitle');
        const desc = document.getElementById('lightboxDesc');
        
        img.src = `{{ asset('') }}${photos[index].foto}`;
        img.alt = photos[index].judul || 'Foto ' + (index + 1);
        counter.textContent = `${index + 1} / ${photos.length}`;
        title.textContent = photos[index].judul || 'Foto ' + (index + 1);
        desc.textContent = photos[index].deskripsi || '';
        
        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        document.getElementById('lightbox').classList.remove('active');
        document.body.style.overflow = '';
    }

    function changePhoto(direction) {
        const newIndex = currentPhotoIndex + direction;
        if (newIndex < 0 || newIndex >= photos.length) return;
        
        currentPhotoIndex = newIndex;
        const img = document.getElementById('lightboxImg');
        const counter = document.getElementById('lightboxCounter');
        const title = document.getElementById('lightboxTitle');
        const desc = document.getElementById('lightboxDesc');
        
        img.src = `{{ asset('') }}${photos[newIndex].foto}`;
        img.alt = photos[newIndex].judul || 'Foto ' + (newIndex + 1);
        counter.textContent = `${newIndex + 1} / ${photos.length}`;
        title.textContent = photos[newIndex].judul || 'Foto ' + (newIndex + 1);
        desc.textContent = photos[newIndex].deskripsi || '';
    }

    // Keyboard Navigation
    document.addEventListener('keydown', function(e) {
        const lightbox = document.getElementById('lightbox');
        if (!lightbox.classList.contains('active')) return;
        
        if (e.key === 'ArrowLeft') changePhoto(-1);
        else if (e.key === 'ArrowRight') changePhoto(1);
        else if (e.key === 'Escape') closeLightbox();
    });

    // Close lightbox on click outside image
    document.getElementById('lightbox').addEventListener('click', function(e) {
        if (e.target === this) {
            closeLightbox();
        }
    });

    // Touch support for mobile
    let touchStartX = 0;
    let touchEndX = 0;
    
    document.getElementById('lightbox').addEventListener('touchstart', function(e) {
        touchStartX = e.changedTouches[0].screenX;
    }, {passive: true});
    
    document.getElementById('lightbox').addEventListener('touchend', function(e) {
        touchEndX = e.changedTouches[0].screenX;
        const diff = touchStartX - touchEndX;
        if (Math.abs(diff) > 50) {
            if (diff > 0) {
                changePhoto(1);
            } else {
                changePhoto(-1);
            }
        }
    }, {passive: true});
</script>
@endpush
@endsection