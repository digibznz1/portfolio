<?php

namespace Database\Factories;

use App\Models\OrganizationType;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'              => fake()->name(),
            'email'             => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'description'       => fake()->word(),
            'status'            => fake()->boolean(),
            'password'          => 'password',
            'remember_token'    => str()->random(10),
            'organization_type_id' => OrganizationType::query()->inRandomOrder()->value('id'),        
        ];

    }//end of run
    
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => ['email_verified_at' => null]);

    }//end of unverified

}//end of class