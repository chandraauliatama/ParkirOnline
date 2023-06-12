<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ParkingReport;
use App\Models\StaticImage;
use Carbon\Carbon;
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

        $staticImages = [
            [
                'label' => 'denah_parkir',
                'source' => 'static_images/revdenah-01.png'
            ],
            [
                'label' => 'logo',
                'source' => 'static_images/logo.png'
            ],
            [
                'label' => 'login_hero',
                'source' => 'static_images/loginHero.png'
            ]
        ];

        foreach ($staticImages as $staticImage) {
            StaticImage::create($staticImage);
        }


        for ($i= 0; $i  < 100; $i++) { 
            $startDate = Carbon::now()->subMonths(5);
            $endDate = Carbon::now();
            $randomDate = $this->randomDate($startDate, $endDate);
            ParkingReport::create(
                [
                    'plat_number' => "A" . random_int(100, 999) . "TS",
                    'parking_point_name' => ['A', 'B', 'C'][array_rand(['A', 'B', 'C'])] . random_int(1, 20),
                    'created_at' => $randomDate,
                    'updated_at' => $randomDate,
                ]
            );
        }
    }

    public function randomDate($start, $end)
    {
        $start = Carbon::parse($start)->timestamp;
        $end = Carbon::parse($end)->timestamp;
        $randomTimestamp = mt_rand($start, $end);
        return Carbon::createFromTimestamp($randomTimestamp)->format('Y-m-d H:i:s');
    }
}
