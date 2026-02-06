<?php

namespace Database\Factories;

use App\Models\Master_rab;
use App\Models\Master_rab_item;
use App\Models\User_client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Master_rab_item>
 */
class MasterRabItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Master_rab_item::class;

    public function definition(): array
    {
         return [
            'user_client_id'=> User_client::inRandomOrder()->first()->id,
            'master_rab_id'=> Master_rab::inRandomOrder()->first()->id,
            'nama_item'=> fake()->word(),
            'kategori_item'=> fake()->word(),
            'satuan'=> fake()->randomElement([
                'Meter',
                'Liter',
                'Piece',
                'Juta',
            ]),
            'qty_rab'=> fake()->randomFloat(3,0,100),
            'harga_satuan_rab'=> fake()->randomFloat(2,10000,100000),
        ];
    }
}