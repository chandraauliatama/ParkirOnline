<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'username' => 'chandra',
            'role' => 'admin',
            'password' => Hash::make('password')
        ]);
    }
}
