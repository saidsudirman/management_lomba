<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $akun = [
            [
                'username' => 'admin',
                'name' => 'Admin Satu',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('12345678'),
                // 'role' => 'admin',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'user',
                'name' => 'User Satu',
                'email' => 'user@gmail.com',
                'password' => bcrypt('12345678'),
                // 'role' => 'user',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($akun as $v) {
            Admin::create([
                'username' => $v['username'],
                'password' => $v['password'],
                // 'role' => $v['role'],
                'email_verified_at' => $v['email_verified_at'],
                'created_at' => $v['created_at'],
                'updated_at' => $v['updated_at'],
            ]);

            User::create([
                'username' => $v['username'],
                'name' => $v['name'],
                'email' => $v['email'],
                'password' => $v['password'],
                // 'role' => $v['role'],
                'email_verified_at' => $v['email_verified_at'],
                'created_at' => $v['created_at'],
                'updated_at' => $v['updated_at'],
            ]);
        }
    }
}
