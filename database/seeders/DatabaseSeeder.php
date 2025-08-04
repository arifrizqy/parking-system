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
        // Buat 50 kendaraan acak dengan owner, jika owner adalah member otomatis dibuatkan akun user
        Vehicle::factory()->count(50)->create();

        // Buat 100 log parkir
        ParkingLog::factory()->count(100)->create();
    }
}
