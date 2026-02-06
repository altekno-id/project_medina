<?php

namespace Database\Factories;

use App\Models\Master_bank;
use App\Models\User_client;
use App\Models\User_login;
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

    protected $model = Master_bank::class;

    public function definition(): array
    {
        return [
            'user_client_id'=> User_client::inRandomOrder()->first()->id,
            'user_login_id'=> User_login::inRandomOrder()->first()->id,
            'nama_master_bank'=> fake()->company().' '. 'bank',
        ];
    }
}