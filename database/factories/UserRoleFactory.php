<?php

namespace Database\Factories;

use App\Models\User_client;
use App\Models\User_role;
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

    protected $model = User_role::class;

    public function definition(): array
    {
        return [
            'user_client_id'=> User_client::inRandomOrder()->first()->id,
            'name_user_role' => fake()->randomElement([
                'Admin',
                'Operator',
                'User',
                'Supervisor',
            ]),

        ];
    }
}