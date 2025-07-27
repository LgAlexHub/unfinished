<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake('fr_FR')->firstName(),
            'last_name' => fake('fr_FR')->lastName(),
            'is_minor' => fake()->boolean(),
            'joined_at' => fake()->dateTimeBetween(startDate: '- 1 year')
        ];
    }
}
