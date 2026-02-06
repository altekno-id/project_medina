<?php

namespace Database\Factories;

use App\Models\MasterBank;
use App\Models\UserClient;
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

    public function definition(): array
    {
        return [
            'user_client_id'=> UserClient::inRandomOrder()->first()->id,
            'master_bank_id'=> MasterBank::inRandomOrder()->first()->id,
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