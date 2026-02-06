<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User_client>
 */
class UserClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'nama_perusahaan'    => fake()->company(),
            'alamat_perusahaan'  => fake()->address(),
            'telepon_perusahaan' => fake()->phoneNumber(),
            'email_perusahaan'   => fake()->companyEmail(),
            'nama_pimpinan'      => fake()->name(),
            'info_user_client'   => json_encode([
                'npwp' => fake()->numerify('##.###.###.#-###.###'),
                'jenis_usaha' => fake()->word(),
                'tahun_berdiri' => fake()->numberBetween(1990, 2025),
            ]),
        ];
    }
}
