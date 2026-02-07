<?php

namespace Database\Factories;

use App\Models\MasterKawasan;
use App\Models\MasterKawasanSub;
use App\Models\UserClient;
use App\Models\UserLogin;
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

    public function definition(): array
    {
        return [
            'user_client_id'=> UserClient::inRandomOrder()->first()->id,
            'user_login_id'=> UserLogin::inRandomOrder()->first()->id,
            'nama_master_kawasan'=> 'perumahan'.' '.fake()->firstName(),
            'alamat_master_kawasan'=> fake()->streetAddress().'perumahan'.' '.fake()->firstName(),
            'latitude'  => fake()->latitude(),
            'longitude' => fake()->longitude(),
            'info_master_kawasan'=>json_encode([
                'keterangan'=> fake()->sentence(),
            ]),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function ($kawasan) {

            foreach (range(1, 10) as $i) {
                MasterKawasanSub::factory()->create([
                    'user_client_id'=> $kawasan->user_client_id,
                    'master_kawasan_id'=> $kawasan->id,
                    'nama_master_kawasan_sub'=> "Blok {$i}",
                ]);
            }

        });
    }
}
