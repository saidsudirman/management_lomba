<?php
// database/seeders/GallerySeeder.php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\GalleryPhoto;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run()
    {
        // Buat Album 1
        $album1 = Album::create([
            'nama_album' => 'Kegiatan Pengabdian Masyarakat',
            'slug' => 'kegiatan-pengabdian-masyarakat',
            'deskripsi' => 'Dokumentasi kegiatan pengabdian masyarakat yang dilakukan oleh IMPAS DIPA di daerah sekitar Makassar.',
            'cover_image' => 'img/unsplash/impas4.jpeg',
            'lokasi' => 'Desa Bonto Parang, Gowa',
            'tanggal' => '2026-03-15',
        ]);

        $album1->photos()->createMany([
            ['foto' => 'img/unsplash/impas1.jpg', 'judul' => 'Pembukaan Acara', 'deskripsi' => 'Pembukaan kegiatan pengabdian masyarakat', 'urutan' => 1],
            ['foto' => 'img/unsplash/impas2.jpg', 'judul' => 'Sesi Belajar', 'deskripsi' => 'Sesi belajar bersama anak-anak desa', 'urutan' => 2],
            ['foto' => 'img/unsplash/impas3.jpg', 'judul' => 'Penyerahan Bantuan', 'deskripsi' => 'Penyerahan bantuan kepada masyarakat', 'urutan' => 3],
            ['foto' => 'img/unsplash/impas4.jpeg', 'judul' => 'Foto Bersama', 'deskripsi' => 'Foto bersama peserta kegiatan', 'urutan' => 4],
            ['foto' => 'img/unsplash/impas4.jpeg', 'judul' => 'Diskusi', 'deskripsi' => 'Sesi diskusi dengan masyarakat', 'urutan' => 5],
        ]);

        // Buat Album 2
        $album2 = Album::create([
            'nama_album' => 'Seminar dan Workshop IT',
            'slug' => 'seminar-dan-workshop-it',
            'deskripsi' => 'Kegiatan seminar dan workshop teknologi informasi yang diadakan untuk meningkatkan kompetensi mahasiswa.',
            'cover_image' => 'img/unsplash/impas4.jpeg',
            'lokasi' => 'Aula Universitas Dipa Makassar',
            'tanggal' => '2026-02-10',
        ]);

        $album2->photos()->createMany([
            ['foto' => 'img/unsplash/impas1.jpg', 'judul' => 'Pembukaan Seminar', 'deskripsi' => 'Pembukaan acara seminar IT', 'urutan' => 1],
            ['foto' => 'img/unsplash/impas2.jpg', 'judul' => 'Materi Utama', 'deskripsi' => 'Penyampaian materi oleh pembicara', 'urutan' => 2],
            ['foto' => 'img/unsplash/impas3.jpg', 'judul' => 'Sesi Tanya Jawab', 'deskripsi' => 'Sesi tanya jawab dengan peserta', 'urutan' => 3],
            ['foto' => 'img/unsplash/impas3.jpg', 'judul' => 'Workshop', 'deskripsi' => 'Sesi workshop praktik langsung', 'urutan' => 4],
            ['foto' => 'img/unsplash/impas3.jpg', 'judul' => 'Penutupan', 'deskripsi' => 'Penutupan acara dan foto bersama', 'urutan' => 5],
            ['foto' => 'img/unsplash/impas3.jpg', 'judul' => 'Sertifikat', 'deskripsi' => 'Pembagian sertifikat kepada peserta', 'urutan' => 6],
        ]);

        // Tambahkan album lainnya sesuai kebutuhan...
    }
}