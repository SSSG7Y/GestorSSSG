<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LabelFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombre' => fake()->word(),
            'color' => fake()->hexColor(),
        ];
    }
}