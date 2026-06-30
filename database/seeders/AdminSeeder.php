<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
                'email' => 'admin@gmail.com',
                'password' => '12345678',
                'role' => 'admin',
                'status' => '1',
            ],
            [
                'username' => 'user',
                'email' => 'user@gmail.com',
                'password' => '12345678',
                'role' => 'admin', // karena migration hanya mengizinkan 'admin'
                'status' => '1',
            ],
        ];

        foreach ($akun as $v) {
            User::updateOrCreate(
                ['email' => $v['email']],
                [
                    'username' => $v['username'],
                    'password' => Hash::make($v['password']),
                    'role' => $v['role'],
                    'status' => $v['status'],
                    'email_verified_at' => now(),
                ]
            );
        }
    }
}