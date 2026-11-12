<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@kost.com'],
            [
                'name' => 'Pemilik Kost',
                'password' => Hash::make('password123'),
                'role' => 'pemilik',
            ]
        );

        User::updateOrCreate(
            ['email' => 'staff@kost.com'],
            [
                'name' => 'Pengelola Kost',
                'password' => Hash::make('password123'),
                'role' => 'pengelola',
            ]
        );

        $this->call(PenghuniKostSeeder::class);
    }
}
