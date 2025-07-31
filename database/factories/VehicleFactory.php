<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Member;
use App\Models\Guest;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ownerType = fake()->randomElement([ Member::class, Guest::class ]);
        $owner = $ownerType::factory()->create();

        return [
            'owner_id' => $owner->id,
            'owner_type' => $ownerType,
            'vehicle_type' => fake()->randomElement([ 'motor', 'mobil', 'sepeda' ]),
            'number_plat' => strtoupper(fake()->bothify('B ###? ??')),
        ];
    }
}
