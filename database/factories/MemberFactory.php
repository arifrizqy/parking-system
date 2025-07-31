<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = fake()->randomElement([ 'siswa', 'pegawai' ]);

        return [
            'nip' => $type === 'pegawai' ? fake()->unique()->numerify('##########') : null,
            'nisn' => $type === 'siswa' ? fake()->unique()->numerify('##########') : null,
            'name' => fake()->name(),
            'type' => $type,
        ];
    }
}
