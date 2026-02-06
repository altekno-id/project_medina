<?php

namespace Database\Factories;

use App\Models\Master_kawasan;
use App\Models\User_client;
use App\Models\User_login;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Master_kawasan>
 */
class MasterKawasanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Master_kawasan::class;

    public function definition(): array
    {
        return [
            'user_client_id'=> User_client::inRandomOrder()->first()->id,
            'user_login_id'=> User_login::inRandomOrder()->first()->id,
            'nama_master_kawasan'=> 'perumahan'.' '.fake()->firstName(),
            'alamat_master_kawasan'=> fake()->streetAddress().'perumahan'.' '.fake()->firstName(),
            'latitude'  => fake()->latitude(),
            'longitude' => fake()->longitude(),
            'info_master_kawasan'=>json_encode([
                'keterangan'=> fake()->sentence(),
            ]),


        ];
    }
}
