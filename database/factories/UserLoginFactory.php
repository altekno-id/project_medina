<?php

namespace Database\Factories;

use App\Models\UserClient;
use App\Models\UserRole;
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

    public function definition(): array
    {
        return [
            'user_client_id' => UserClient::inRandomOrder()->first()->id,
            'user_role_id' => UserRole::inRandomOrder()->first()->id,
            'username'=> fake()->userName(),
            'password'=> fake()->password(),
            'nickname' => fake()->name(),
            'photo' => fake()->imageUrl(300, 300, 'people'),
            'status_user_login'=> fake()->boolean(),
        ];
    }
}
