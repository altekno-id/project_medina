<?php

namespace Database\Factories;

use App\Models\MasterKawasan;
use App\Models\UserClient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Master_kawasan_sub>
 */
class MasterKawasanSubFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'user_client_id'=> UserClient::inRandomOrder()->first()->id,
            'master_kawasan_id'=> MasterKawasan::inRandomOrder()->first()->id,
            'nama_master_kawasan_sub'=> 'Blok'.' '. fake()->randomLetter(),
        ];
    }
}