<?php

namespace Database\Seeders;

use App\Models\ParkingPoint;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParkingPointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parkCodes = ['A', 'B', 'C'];

        foreach ($parkCodes as $parkCode) {
            for ($i = 1; $i <= 20  ; $i++) { 
                $parkPoint = ['name' => $parkCode . $i];
                ParkingPoint::create($parkPoint);
            }
        }
    }
}
