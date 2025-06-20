<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class Data extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data yang ada terlebih dahulu untuk menghindari duplikasi
        DB::table('lomba')->delete();
        DB::table('kategori')->delete();
        DB::table('users')->delete();

        // Seed tabel kategoris
        $kategoriIds = DB::table('kategori')->insert([
            [
                'nama_kategori' => 'Robotik',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama_kategori' => 'Teknologi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);

        // Seed tabel users
        DB::table('users')->insert([
            [
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
                'status' => '1',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'alif',
                'email' => 'alif@gmail.com',
                'password' => Hash::make('12345678'),
                'status' => '1',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'Rizqi',
                'email' => 'semuamana@gmail.com',
                'password' => Hash::make('12345678'),
                'status' => '1',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('lomba')->insert([
            [
                'nama' => 'Desain',
                'tanggal_mulai' => '2023-06-01',
                'tanggal_selesai' => '2023-06-10',
                'foto' => 'foto/1685037801.jpg',
                'harga' => 100000,
                'kategori_id' => 1,
                'deskripsi' => 'Lomba Poster merupakan lomba yang mewadahi kreatifitas di bidang desain grafis yang nantinya diharapkan dapat meningkatkan minat dan motivasi dalam berkarya dan memberi informasi kepada pelajar atau masyarakat umum dalam bentuk poster.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Competitive Programming',
                'tanggal_mulai' => '2023-07-01',
                'tanggal_selesai' => '2023-07-10',
                'foto' => 'foto/1684989591.jpg',
                'harga' => 150000,
                'kategori_id' => 2,
                'deskripsi' => 'Competitive Programming adalah salah satu cabang kompetisi pemrograman yang bertujuan untuk menguji kemampuan analisis pemecahan masalah dan berpikir komputasional dengan cara menyelesaikan persoalan yang diberikan dengan bahasa pemrograman tertentu dalam batasan waktu dan memori yang telah ditentukan.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Lomba Robot',
                'tanggal_mulai' => '2023-08-01',
                'tanggal_selesai' => '2023-08-10',
                'foto' => 'foto/1685037801.jpg',
                'harga' => 200000,
                'kategori_id' => 1,
                'deskripsi' => 'Lomba desain dan pemrograman robot untuk siswa SMA/SMK. Peserta diharuskan membuat robot yang dapat menyelesaikan berbagai tantangan menarik.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Aplikasi Inovatif',
                'tanggal_mulai' => '2023-09-01',
                'tanggal_selesai' => '2023-09-10',
                'foto' => 'foto/1685037801.jpg',
                'harga' => 175000,
                'kategori_id' => 2,
                'deskripsi' => 'Lomba pengembangan aplikasi inovatif yang dapat menyelesaikan masalah sehari-hari menggunakan teknologi terkini.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);

        DB::table('pendaftaran')->insert([
            [
                'nama_peserta' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'no_hp' => '081234567890',
                'alamat' => 'Jl. Merdeka No. 10',
                'asal_sekolah' => 'SMA Negeri 1 Jakarta',
                'nisn' => '1234567890',
                'tanggal_lahir' => '2000-05-15',
                'id_lomba' => 1,
                'status_pembayaran' => '2', // Sudah Bayar
                'tanggal_pendaftaran' => Carbon::now()->subDays(5),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama_peserta' => 'Ani Wijaya',
                'email' => 'ani@example.com',
                'no_hp' => '082345678901',
                'alamat' => 'Jl. Sudirman No. 20',
                'asal_sekolah' => 'SMA Negeri 2 Bandung',
                'nisn' => '2345678901',
                'tanggal_lahir' => '2001-08-20',
                'id_lomba' => 2, 
                'status_pembayaran' => '1', // Belum Bayar
                'tanggal_pendaftaran' => Carbon::now()->subDays(3),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}