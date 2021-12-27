<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ComparisonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'string1' => $this->faker->sentence(5),
            'string2' => $this->faker->sentence(5),
            'matching_chars' => $this->faker->randomNumber(5),
            'match_percentage' => $this->faker->randomFloat(2),
        ];
    }
}
