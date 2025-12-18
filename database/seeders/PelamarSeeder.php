<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pelamar;

class PelamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pelamar::create([
            'nama' => 'Ahmad Rahman',
            'email' => 'ahmad@example.com',
            'posisi' => 'Software Developer',
            'cv' => null,
            'status' => 'pending',
        ]);

        Pelamar::create([
            'nama' => 'Siti Nurhaliza',
            'email' => 'siti@example.com',
            'posisi' => 'Project Manager',
            'cv' => null,
            'status' => 'approved',
        ]);

        Pelamar::create([
            'nama' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'posisi' => 'UI/UX Designer',
            'cv' => null,
            'status' => 'rejected',
        ]);

        Pelamar::create([
            'nama' => 'Maya Sari',
            'email' => 'maya@example.com',
            'posisi' => 'Software Developer',
            'cv' => null,
            'status' => 'pending',
        ]);

        Pelamar::create([
            'nama' => 'Rizki Pratama',
            'email' => 'rizki@example.com',
            'posisi' => 'Data Analyst',
            'cv' => null,
            'status' => 'approved',
        ]);
    }
}
