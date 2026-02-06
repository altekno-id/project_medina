<?php

namespace Database\Factories;

use App\Models\User_client;
use App\Models\User_login;
use App\Models\User_role;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User_login>
 */
class UserLoginFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = User_login::class;

    public function definition(): array
    {
        return [
            'user_client_id' => User_client::inRandomOrder()->first()->id,
            'user_role_id' => User_role::inRandomOrder()->first()->id,
            'username'=> fake()->userName(),
            'password'=> fake()->password(),
            'nickname' => fake()->name(),
            'photo' => fake()->imageUrl(300, 300, 'people'),
            'status_user_login'=> fake()->boolean(),
        ];
    }
}
