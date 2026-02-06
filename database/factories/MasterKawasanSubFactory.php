<?php

namespace Database\Factories;

use App\Models\Master_kawasan;
use App\Models\Master_kawasan_sub;
use App\Models\User_client;
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

    protected $model = Master_kawasan_sub::class;

    public function definition(): array
    {
        return [
            'user_client_id'=> User_client::inRandomOrder()->first()->id,
            'master_kawasan_id'=> Master_kawasan::inRandomOrder()->first()->id,
            'nama_master_kawasan_sub'=> 'Blok'.' '. fake()->randomLetter(),
        ];
    }
}