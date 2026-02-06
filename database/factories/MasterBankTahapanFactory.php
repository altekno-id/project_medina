<?php

namespace Database\Factories;

use App\Models\Master_bank;
use App\Models\Master_bank_tahapan;
use App\Models\User_client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Master_bank_tahapan>
 */
class MasterBankTahapanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Master_bank_tahapan::class;

    public function definition(): array
    {
        return [
            'user_client_id'=> User_client::inRandomOrder()->first()->id,
            'master_bank_id'=> Master_bank::inRandomOrder()->first()->id,
            'nama_tahapan' => fake()->randomElement([
                'Draft',
                'Verifikasi',
                'Persetujuan',
                'Selesai',
            ]),
            'nilai_progress'=> fake()->randomFloat(2,0,100)
        ];
    }
}