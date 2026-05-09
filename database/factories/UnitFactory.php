<?php

namespace Database\Factories;

use App\Models\MasterBank;
use App\Models\MasterKawasan;
use App\Models\MasterKawasanSub;
use App\Models\MasterKawasanSubBlok;
use App\Models\MasterRab;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Unit>
 */
class UnitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $kawasan = MasterKawasan::inRandomOrder()->first();
        $cluster = MasterKawasanSub::where('master_kawasan_id', $kawasan->id)->inRandomOrder()->first();
        $blok = MasterKawasanSubBlok::where('master_kawasan_sub_id', $cluster->id)->inRandomOrder()->first();

        return [
            'master_kawasan_id' => $kawasan->id,
            'master_kawasan_sub_id' => $cluster->id,
            'master_kawasan_sub_blok_id' => $blok->id,
            'master_rab_id' => MasterRab::inRandomOrder()->first()->id,
            'master_bank_id' => MasterBank::inRandomOrder()->first()->id,
            'nama_jalan' => 'Jalan '.fake()->streetName(),
            'nomor_unit' => fake()->bothify('??-###'),
            'tipe_unit' => fake()->randomElement(['36/72', '45/90', '60/120', '72/144']),
            'harga_unit' => fake()->numberBetween(350000000, 1500000000),
        ];
    }
}
