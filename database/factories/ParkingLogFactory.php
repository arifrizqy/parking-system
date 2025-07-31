<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Vehicle;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ParkingLog>
 */
class ParkingLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'vehicle_id' => Vehicle::factory(),
            'admin_user_id' => User::factory()->state([ 'role' => 'admin' ]),
            'enter_at' => now(),
            'leave_at' => fake()->optional()->dateTimeBetween('+1 hour', '+5 hours'),
        ];
    }
}
