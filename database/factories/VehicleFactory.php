<?php

namespace Database\Factories;

use App\Models\Guest;
use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        $ownerType = fake()->randomElement([Guest::class, Member::class]);

        if ($ownerType === Member::class) {
            $owner = $ownerType::factory()->create();

            $owner->user()->create([
                'email' => fake()->unique()->safeEmail(),
                'password' => 'password',
                'role' => fake()->randomElement(['user', 'admin']),
            ]);
        } else {
            $owner = $ownerType::factory()->create();
        }

        return [
            'owner_id' => $owner->id,
            'owner_type' => $ownerType,
            'vehicle_type' => fake()->randomElement(['motor', 'mobil']),
            'number_plat' => strtoupper(fake()->bothify('B ###? ??')),
        ];
    }
}
