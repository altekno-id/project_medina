<?php

namespace Database\Factories;

use App\Models\UserClient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User_role>
 */
class UserRoleFactory extends Factory
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
            'name_user_role' => fake()->randomElement([
                'Admin',
                'Operator',
                'User',
                'Supervisor',
            ]),

        ];
    }
}
