<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\StaticImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ParkingPointSeeder::class);
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'username' => 'admin',
            'role' => 'admin',
            'password' => Hash::make('password')
        ]);

        StaticImage::create([
            'label' => 'denah_parkir',
            'source' => 'static_images/revdenah-01.png'
        ]);

        StaticImage::create([
            'label' => 'logo',
            'source' => 'images/logo.png'
        ]);

        StaticImage::create([
            'label' => 'login_hero',
            'source' => 'images/loginHero.png'
        ]);
    }
}
