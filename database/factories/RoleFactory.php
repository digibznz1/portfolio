<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'permissions' => json_encode([
                'create-admin',
                'edit-admin',
                'delete-admin',
                'show-admin',
                'show-role',
                'edit-role',
                'delete-role',
                'show-role',
            ]),
        ];

    }//end of run

}//end of class