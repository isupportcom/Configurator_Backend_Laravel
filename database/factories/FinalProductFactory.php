<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\FinalProduct;

class FinalProductFactory extends Factory
{
    protected $model = FinalProduct::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->paragraph,
            'image' => $this->faker->imageUrl(255, 255),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
