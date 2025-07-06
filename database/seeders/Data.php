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

        // Seed tabel lomba
        DB::table('lomba')->insert([
            [
                'nama' => 'Canva',
                'tanggal_mulai' => '2023-06-01',
                'tanggal_selesai' => '2023-06-10',
                'foto' => 'img/unsplash/materi1.jpg',
                'harga' => 100000,
                'deskripsi' => 'Canva adalah platform desain grafis berbasis web yang memungkinkan pengguna membuat berbagai jenis desain seperti poster, presentasi, logo, media sosial, kartu undangan, dan lainnya dengan mudah. Canva menyediakan ribuan template siap pakai, elemen desain (ikon, foto, font), serta fitur drag-and-drop, sehingga cocok digunakan oleh pemula maupun profesional tanpa perlu keahlian desain khusus',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'HTML (HyperText Markup Language)',
                'tanggal_mulai' => '2023-07-01',
                'tanggal_selesai' => '2023-07-10',
                'foto' => 'img/unsplash/materi2.jpg',
                'harga' => 150000,
                'deskripsi' => 'HTML (HyperText Markup Language) adalah bahasa standar yang digunakan untuk membuat dan menyusun halaman web. HTML berfungsi untuk menentukan struktur dan isi dari sebuah halaman, seperti teks, gambar, tautan, tabel, dan elemen lainnya. ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'CSS (Cascading Style Sheets)',
                'tanggal_mulai' => '2023-08-01',
                'tanggal_selesai' => '2023-08-10',
                'foto' => 'img/unsplash/materi3.jpg',
                'harga' => 200000,
                'deskripsi' => 'CSS (Cascading Style Sheets) adalah bahasa pemrograman yang digunakan untuk mengatur tampilan dan gaya elemen dalam halaman web.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Microsoft Office ',
                'tanggal_mulai' => '2023-09-01',
                'tanggal_selesai' => '2023-09-10',
                'foto' => 'img/unsplash/materi4.jpg',
                'harga' => 175000,
                'deskripsi' => 'Microsoft Office adalah sebuah paket aplikasi produktivitas buatan Microsoft yang terdiri dari berbagai program seperti Word, Excel, PowerPoint, Outlook, dan lainnya.',
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
