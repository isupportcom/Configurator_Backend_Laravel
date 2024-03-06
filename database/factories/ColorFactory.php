<?php

namespace Database\Factories;

use App\Models\Color;
use Illuminate\Database\Eloquent\Factories\Factory;

class ColorFactory extends Factory
{
    protected $model = Color::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word, // You might want to customize this based on your seeder logic
            'color' => $this->faker->hexColor,
        ];
    }

    public function namedColor(string $name): Factory
    {
        return $this->state(function (array $attributes) use ($name) {
            return ['name' => $name];
        });
    }
}
