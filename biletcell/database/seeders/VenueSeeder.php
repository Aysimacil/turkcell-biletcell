<?php

namespace Database\Seeders;
use App\Models\Venue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    Venue::create([
        'title' => '01 PGM (Performans Gösteri Merkezi)',
        'city' => 'Adana',
        'address' => 'Yeni Baraj, Hacı Ömer Sabancı Cd. No:7, Seyhan',
        'capacity' => 500
    ]);

    Venue::create([
        'title' => 'Çukurova Üniversitesi Kongre Merkezi',
        'city' => 'Adana',
        'address' => 'Çukurova Üniversitesi Kampüsü, Sarıçam',
        'capacity' => 1500
    ]);
}
}
