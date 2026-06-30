{{-- resources/views/gallery/detail.blade.php --}}
@extends('layout.landing.app')
@section('content')
@push('styles')
<style>
    /* Style untuk Detail Album */
    .album-header {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
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
        display: none;
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

@php
    // Data Album Detail
    $albumDetail = [
        '1' => [
            'id' => 1,
            'slug' => 'kegiatan-pengabdian-masyarakat',
            'nama' => 'Kegiatan Pengabdian Masyarakat',
            'deskripsi' => 'Kegiatan pengabdian masyarakat ini dilaksanakan di Desa Bonto Parang, Kabupaten Gowa. Kami memberikan pelatihan keterampilan dan pendidikan kepada masyarakat setempat. Program ini bertujuan untuk meningkatkan kualitas hidup masyarakat melalui pemberdayaan dan pendidikan.',
            'tanggal' => '15 Maret 2026',
            'lokasi' => 'Desa Bonto Parang, Gowa',
            'photos' => [
                ['foto' => 'img/gallery/album1/photo1.jpg', 'judul' => 'Pembukaan Acara', 'deskripsi' => 'Pembukaan kegiatan pengabdian masyarakat oleh ketua pelaksana'],
                ['foto' => 'img/gallery/album1/photo2.jpg', 'judul' => 'Sesi Belajar', 'deskripsi' => 'Sesi belajar bersama anak-anak desa dengan penuh antusias'],
                ['foto' => 'img/gallery/album1/photo3.jpg', 'judul' => 'Penyerahan Bantuan', 'deskripsi' => 'Penyerahan bantuan kepada masyarakat yang membutuhkan'],
                ['foto' => 'img/gallery/album1/photo4.jpg', 'judul' => 'Foto Bersama', 'deskripsi' => 'Foto bersama peserta kegiatan dan masyarakat'],
                ['foto' => 'img/gallery/album1/photo5.jpg', 'judul' => 'Diskusi', 'deskripsi' => 'Sesi diskusi dengan masyarakat untuk mendengar aspirasi'],
            ]
        ],
        '2' => [
            'id' => 2,
            'slug' => 'seminar-dan-workshop-it',
            'nama' => 'Seminar dan Workshop IT',
            'deskripsi' => 'Seminar dan workshop teknologi informasi yang menghadirkan pembicara dari berbagai perusahaan teknologi terkemuka. Acara ini bertujuan untuk meningkatkan kompetensi mahasiswa di bidang IT dan mempersiapkan mereka untuk dunia kerja.',
            'tanggal' => '10 Februari 2026',
            'lokasi' => 'Aula Universitas Dipa Makassar',
            'photos' => [
                ['foto' => 'img/gallery/album2/photo1.jpg', 'judul' => 'Pembukaan Seminar', 'deskripsi' => 'Pembukaan acara seminar IT oleh rektor universitas'],
                ['foto' => 'img/gallery/album2/photo2.jpg', 'judul' => 'Materi Utama', 'deskripsi' => 'Penyampaian materi oleh pembicara dari perusahaan teknologi'],
                ['foto' => 'img/gallery/album2/photo3.jpg', 'judul' => 'Sesi Tanya Jawab', 'deskripsi' => 'Sesi tanya jawab yang interaktif dengan peserta'],
                ['foto' => 'img/gallery/album2/photo4.jpg', 'judul' => 'Workshop', 'deskripsi' => 'Sesi workshop praktik langsung membuat aplikasi'],
                ['foto' => 'img/gallery/album2/photo5.jpg', 'judul' => 'Penutupan', 'deskripsi' => 'Penutupan acara dan foto bersama semua peserta'],
                ['foto' => 'img/gallery/album2/photo6.jpg', 'judul' => 'Sertifikat', 'deskripsi' => 'Pembagian sertifikat kepada seluruh peserta workshop'],
            ]
        ],
        '3' => [
            'id' => 3,
            'slug' => 'olahraga-dan-kebersamaan',
            'nama' => 'Olahraga dan Kebersamaan',
            'deskripsi' => 'Kegiatan olahraga rutin yang diadakan setiap minggu untuk mempererat tali persaudaraan antar mahasiswa Papua. Kegiatan ini mencakup berbagai cabang olahraga seperti futsal, voli, dan atletik.',
            'tanggal' => '25 Januari 2026',
            'lokasi' => 'Lapangan Olahraga UNM',
            'photos' => [
                ['foto' => 'img/gallery/album3/photo1.jpg', 'judul' => 'Pertandingan Futsal', 'deskripsi' => 'Pertandingan futsal antar tim yang sangat kompetitif'],
                ['foto' => 'img/gallery/album3/photo2.jpg', 'judul' => 'Tim Pemenang', 'deskripsi' => 'Foto tim pemenang pertandingan futsal'],
                ['foto' => 'img/gallery/album3/photo3.jpg', 'judul' => 'Kebersamaan', 'deskripsi' => 'Momen kebersamaan setelah pertandingan'],
                ['foto' => 'img/gallery/album3/photo4.jpg', 'judul' => 'Voli', 'deskripsi' => 'Pertandingan voli yang seru dan penuh semangat'],
            ]
        ],
        '4' => [
            'id' => 4,
            'slug' => 'perayaan-hari-besar',
            'nama' => 'Perayaan Hari Besar',
            'deskripsi' => 'Perayaan hari besar nasional dan acara adat Papua yang diselenggarakan dengan meriah. Acara ini menjadi wadah untuk melestarikan budaya Papua dan mempererat kebersamaan.',
            'tanggal' => '1 Januari 2026',
            'lokasi' => 'Kampus Universitas Dipa Makassar',
            'photos' => [
                ['foto' => 'img/gallery/album4/photo1.jpg', 'judul' => 'Persiapan Acara', 'deskripsi' => 'Persiapan perayaan hari besar yang dilakukan bersama-sama'],
                ['foto' => 'img/gallery/album4/photo2.jpg', 'judul' => 'Pembukaan', 'deskripsi' => 'Pembukaan acara perayaan dengan penuh semangat'],
                ['foto' => 'img/gallery/album4/photo3.jpg', 'judul' => 'Tarian Adat', 'deskripsi' => 'Pertunjukan tarian adat Papua yang memukau'],
                ['foto' => 'img/gallery/album4/photo4.jpg', 'judul' => 'Kebersamaan', 'deskripsi' => 'Makan bersama dalam suasana kebersamaan'],
                ['foto' => 'img/gallery/album4/photo5.jpg', 'judul' => 'Penutupan', 'deskripsi' => 'Penutupan acara dengan doa bersama'],
            ]
        ],
        '5' => [
            'id' => 5,
            'slug' => 'kunjungan-studi',
            'nama' => 'Kunjungan Studi',
            'deskripsi' => 'Kunjungan studi ke berbagai perusahaan dan instansi untuk menambah wawasan dan pengalaman mahasiswa. Kegiatan ini memberikan gambaran langsung tentang dunia kerja dan industri.',
            'tanggal' => '5 Desember 2025',
            'lokasi' => 'PT. Teknologi Indonesia, Makassar',
            'photos' => [
                ['foto' => 'img/gallery/album5/photo1.jpg', 'judul' => 'Kedatangan', 'deskripsi' => 'Kedatangan rombongan di lokasi kunjungan'],
                ['foto' => 'img/gallery/album5/photo2.jpg', 'judul' => 'Sambutan', 'deskripsi' => 'Sambutan dari pihak perusahaan'],
                ['foto' => 'img/gallery/album5/photo3.jpg', 'judul' => 'Presentasi', 'deskripsi' => 'Presentasi tentang teknologi terbaru'],
                ['foto' => 'img/gallery/album5/photo4.jpg', 'judul' => 'Tour Perusahaan', 'deskripsi' => 'Tur melihat langsung proses kerja'],
                ['foto' => 'img/gallery/album5/photo5.jpg', 'judul' => 'Diskusi', 'deskripsi' => 'Diskusi dengan para profesional'],
                ['foto' => 'img/gallery/album5/photo6.jpg', 'judul' => 'Sertifikat', 'deskripsi' => 'Pemberian sertifikat kunjungan'],
                ['foto' => 'img/gallery/album5/photo7.jpg', 'judul' => 'Foto Bersama', 'deskripsi' => 'Foto bersama di akhir kunjungan'],
            ]
        ],
        '6' => [
            'id' => 6,
            'slug' => 'bakti-sosial',
            'nama' => 'Bakti Sosial',
            'deskripsi' => 'Kegiatan bakti sosial yang bertujuan untuk membantu masyarakat yang membutuhkan. Kami memberikan bantuan berupa sembako, pakaian, dan pelayanan kesehatan gratis.',
            'tanggal' => '20 November 2025',
            'lokasi' => 'Panti Asuhan Yatim Piatu, Makassar',
            'photos' => [
                ['foto' => 'img/gallery/album6/photo1.jpg', 'judul' => 'Pembagian Sembako', 'deskripsi' => 'Pembagian sembako kepada masyarakat'],
                ['foto' => 'img/gallery/album6/photo2.jpg', 'judul' => 'Pelayanan Kesehatan', 'deskripsi' => 'Pelayanan kesehatan gratis'],
                ['foto' => 'img/gallery/album6/photo3.jpg', 'judul' => 'Kebersamaan', 'deskripsi' => 'Momen kebersamaan dengan anak-anak'],
                ['foto' => 'img/gallery/album6/photo4.jpg', 'judul' => 'Penutupan', 'deskripsi' => 'Penutupan acara bakti sosial'],
            ]
        ],
    ];
    
    // Get album by slug
    $currentAlbum = null;
    $slug = request()->route('slug');
    foreach ($albumDetail as $album) {
        if ($album['slug'] == $slug) {
            $currentAlbum = $album;
            break;
        }
    }
    
    // If album not found, redirect or show 404
    if (!$currentAlbum) {
        abort(404, 'Album tidak ditemukan');
    }
@endphp

<!-- Album Header -->
<div class="album-header">
    <div class="container">
        <a href="{{ route('gallery.index') }}" class="back-button">
            <i class="fas fa-arrow-left"></i> Kembali ke Galeri
        </a>
        <h1 class="album-title">{{ $currentAlbum['nama'] }}</h1>
        <div class="album-meta">
            <span><i class="far fa-calendar-alt"></i> {{ $currentAlbum['tanggal'] }}</span>
            <span class="mx-3">|</span>
            <span><i class="fas fa-map-marker-alt"></i> {{ $currentAlbum['lokasi'] }}</span>
            <span class="mx-3">|</span>
            <span><i class="fas fa-images"></i> {{ count($currentAlbum['photos']) }} Foto</span>
        </div>
        <p class="album-description">{{ $currentAlbum['deskripsi'] }}</p>
    </div>
</div>

<!-- Photo Grid -->
<section class="photo-grid-container">
    <div class="container">
        @if(count($currentAlbum['photos']) > 0)
            <div class="photo-grid" id="photoGrid">
                @foreach ($currentAlbum['photos'] as $index => $photo)
                    <div class="photo-item" onclick="openLightbox({{ $index }})">
                        <img src="{{ asset($photo['foto']) }}" alt="{{ $photo['judul'] }}" 
                             onerror="this.src='{{ asset('img/default-photo.jpg') }}'">
                        <div class="photo-overlay">
                            <h5>{{ $photo['judul'] }}</h5>
                            <p>{{ $photo['deskripsi'] }}</p>
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
    // Data Photos dari PHP
    const photos = @json($currentAlbum['photos']);
    let currentPhotoIndex = 0;

    function openLightbox(index) {
        currentPhotoIndex = index;
        const lightbox = document.getElementById('lightbox');
        const img = document.getElementById('lightboxImg');
        const counter = document.getElementById('lightboxCounter');
        const title = document.getElementById('lightboxTitle');
        const desc = document.getElementById('lightboxDesc');
        
        img.src = `{{ asset('') }}${photos[index].foto}`;
        img.alt = photos[index].judul;
        counter.textContent = `${index + 1} / ${photos.length}`;
        title.textContent = photos[index].judul;
        desc.textContent = photos[index].deskripsi;
        
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
        img.alt = photos[newIndex].judul;
        counter.textContent = `${newIndex + 1} / ${photos.length}`;
        title.textContent = photos[newIndex].judul;
        desc.textContent = photos[newIndex].deskripsi;
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