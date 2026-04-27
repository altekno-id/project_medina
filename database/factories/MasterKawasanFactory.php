<?php

namespace Database\Factories;

use App\Models\MasterKawasanSub;
use App\Models\MasterKawasanSubBlok;
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
        $clientId = UserClient::inRandomOrder()->first()->id;
        $userId = UserLogin::inRandomOrder()->first()->id;

        return [
            'nama_master_kawasan' => 'Perumahan ' . fake()->firstName(),
            'alamat_master_kawasan' => fake()->streetAddress() . 'perumahan ' . fake()->firstName(),
            'latitude'  => fake()->latitude(),
            'longitude' => fake()->longitude(),
            'info_master_kawasan' => json_encode([
                'keterangan' => fake()->sentence(),
            ]),
            'user_client_id' => $clientId,
            'created_by' => $userId,
            'updated_by' => $userId,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function ($kawasan) {

            foreach (range(1, 2) as $i) {
                $cluster = MasterKawasanSub::factory()->create([
                    'master_kawasan_id' => $kawasan->id,
                    'nama_master_kawasan_sub' => "Cluster {$i}",
                    'user_client_id' => $kawasan->user_client_id,
                    'created_by' => $kawasan->created_by,
                    'updated_by' => $kawasan->updated_by,
                ]);

                foreach (range(1, 5) as $j) {
                    MasterKawasanSubBlok::factory()->create([
                        'master_kawasan_sub_id' => $cluster->id,
                        'nama_master_kawasan_sub_blok' => "Blok {$j}",
                        'user_client_id' => $kawasan->user_client_id,
                        'created_by' => $kawasan->created_by,
                        'updated_by' => $kawasan->updated_by,
                    ]);
                }
            }
        });
    }
}
