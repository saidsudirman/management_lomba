<?php

namespace Database\Seeders;

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
        // Kosongkan tabel untuk mencegah duplikasi
        DB::table('pendaftaran')->delete();
        DB::table('lomba')->delete();
        DB::table('users')->delete();

        // Seed tabel users
        DB::table('users')->insert([
            [
                'username' => 'impas',
                'email' => 'impas@gmail.com',
                'password' => Hash::make('impasss123'),
                'status' => '1',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'Cai',
                'email' => 'cai@gmail.com',
                'password' => Hash::make('12345678'),
                'status' => '1',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'Dwi',
                'email' => 'dwi@gmail.com',
                'password' => Hash::make('12345678'),
                'status' => '1',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Seed tabel lomba
        DB::table('lomba')->insert([
            [
                'nama' => 'Microsoft Office',
                'materi' => 'Microsoft Word, Excel, PowerPoint',
                'tanggal_mulai' => '2023-06-01',
                'tanggal_selesai' => '2023-06-10',
                'foto' => 'img/unsplash/materi4.jpg',
                'harga' => 50000,
                'deskripsi' => 'Paket ini dirancang untuk membekali peserta dengan keterampilan dasar hingga menengah dalam menggunakan aplikasi perkantoran digital dari Microsoft Office. Program ini sangat relevan untuk pelajar, mahasiswa, guru, dan tenaga profesional yang ingin meningkatkan efisiensi kerja serta kemampuan pengolahan data dan dokumen secara modern dan sistematis.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Multi Media',
                'materi' => 'Canva Dan Adobe Photoshop',
                'tanggal_mulai' => '2023-07-01',
                'tanggal_selesai' => '2023-07-10',
                'foto' => 'img/unsplash/materi1.jpg',
                'harga' => 50000,
                'deskripsi' => 'Paket ini merupakan program pelatihan multimedia yang dirancang untuk memperkenalkan serta mengasah keterampilan peserta dalam bidang desain grafis modern menggunakan dua platform populer: Canva dan Adobe Photoshop. Melalui pendekatan teori dan praktik, peserta akan dipandu untuk memahami prinsip dasar desain hingga mampu menghasilkan karya visual yang menarik dan profesional.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Programming Dasar',
                'materi' => 'HTML, CSS',
                'tanggal_mulai' => '2023-08-01',
                'tanggal_selesai' => '2023-08-10',
                'foto' => 'img/unsplash/materi6.jpg',
                'harga' => 50000,
                'deskripsi' => 'Paket ini merupakan program pelatihan dasar yang dirancang khusus bagi pemula yang ingin memasuki dunia pengembangan web. Dengan mempelajari HTML dan CSS, peserta akan memahami fondasi utama dalam membangun tampilan dan struktur halaman website secara mandiri, tanpa tergantung pada platform instan.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);

        // Seed tabel pendaftaran
        DB::table('pendaftaran')->insert([
            [
                'nama_peserta' => 'Sepbrian Apbraham',
                'email' => 'dwi@gmail.com',
                'no_hp' => '081234567890',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Jln. Btpn No. 5',
                'asal_sekolah' => 'SMA Negeri 1 Biak',
                'tanggal_lahir' => '2000-05-15',
                'id_lomba' => 1,
                'status_pembayaran' => '2', // Sudah Bayar
                'tanggal_pendaftaran' => Carbon::now()->subDays(5),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama_peserta' => 'Chindy Lindang',
                'email' => 'cindy@gmail.com',
                'no_hp' => '082345678901',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Jl. Sudirman No. 20',
                'asal_sekolah' => 'SMA Negeri 2 Timika',
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
