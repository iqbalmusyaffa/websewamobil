<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat Akun Admin Utama
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Membuat Akun Customer (Pelanggan) untuk percobaan
        User::create([
            'name' => 'Pelanggan Test',
            'email' => 'customer@customer.com',
            'password' => bcrypt('password'),
            'role' => 'customer',
        ]);

        $this->call([
            BranchSeeder::class,
            JobSeeder::class,
            BlogPostSeeder::class,
        ]);
    }
}
