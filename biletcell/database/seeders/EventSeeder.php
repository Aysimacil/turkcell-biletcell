<?php

namespace Database\Seeders;
use App\Models\Event;
use App\Models\Venue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $user = User::create([
        'name' => 'Aysima Organizasyon',
        'email' => 'aysima@biletcell.com',
        'gsm' => '5554443322',
        'password' => bcrypt('password123'),
    ]);
    $venue1 = Venue::first(); // 01 PGM'i alır

    Event::create([
        'title' => 'Sertab Erener Konseri',
        'description' => 'Unutulmaz bir geceye hazır olun.',
        'category' => 'Konser',
        'event_date' => '2026-05-20 21:00:00',
        'status' => 'on_sale',
        'price' => 750,
        'image_path' => 'events/sertab.jpg',
        'venue_id' => $venue1->id,
        'user_id' => $user->id
    ]);

    Event::create([
        'title' => 'Bir Delinin Hatıra Defteri',
        'description' => 'Genco Erkal performansı ile tiyatro şöleni.',
        'category' => 'Tiyatro',
        'event_date' => '2026-06-10 20:00:00',
        'status' => 'upcoming',
        'price' => 400,
        'image_path' => 'events/tiyatro.jpg',
        'venue_id' => $venue1->id,
        'user_id' => $user->id
    ]);
}
}
