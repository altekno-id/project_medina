<?php

namespace Database\Factories;

use App\Models\MasterRabItem;
use App\Models\UserClient;
use App\Models\UserLogin;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Master_rab>
 */
class MasterRabFactory extends Factory
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
            'nama_master_rab'=> fake()->word(),
            'deskripsi'=> fake()->text(),
        ];
    }
    public function configure()
    {
        return $this->afterCreating(function ($rab) {

            $items = [
                'Pipa Besi',
                'Triplek 12 Inchi',
                'Mesin Air Komplit',
                'Lampu Tembak',
                'Lampu Tiang Teras',
                'Isolasi',
                'Lampu',
                'Relief',
                'Fee Marketing',
                'Upah Tukang',
            ];

            foreach ($items as $item) {
                MasterRabItem::factory()->create([
                    'user_client_id' => $rab->user_client_id,
                    'master_rab_id'  => $rab->id,
                    'nama_item'     => $item,
                    'kategori_item' => fake()->word(),
                    'satuan'        => fake()->randomElement(['Meter','Liter','Piece','Juta']),
                    'qty_rab'       => fake()->randomFloat(2, 1, 100),
                    'harga_satuan_rab'=> fake()->randomFloat(2, 10000, 100000),
                ]);
            }

        });
    }
}
