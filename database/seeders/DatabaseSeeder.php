<?php

namespace Database\Seeders;

use App\Models\ParkingLog;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat 5 member & user admin
        // User::factory()->count(5)->create(['role' => 'admin']);

        // Buat 15 member user biasa
        // User::factory()->count(15)->create(['role' => 'user']);

        // Buat 10 kendaraan acak milik member
        Vehicle::factory()->count(500)->create();

        // Buat 20 log parkir
        ParkingLog::factory()->count(250)->create();
    }
}
