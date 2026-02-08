<?php

namespace Database\Factories;

use App\Models\MasterBankTahapan;
use App\Models\UserClient;
use App\Models\UserLogin;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Master_bank>
 */
class MasterBankFactory extends Factory
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
            'nama_master_bank'=> fake()->company().' '. 'bank',
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function ($bank) {

            foreach (range(1, 4) as $i) {
                MasterBankTahapan::factory()->create([
                    'master_bank_id' => $bank->id,
                    'user_client_id' => $bank->user_client_id,
                    'nama_tahapan'   => "Tahap {$i}",
                    'nilai_progress'=> 25,
                ]);
            }

        });
    }
}
