<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ChoicesContent;
use App\Models\PlaceChoice;
use App\Models\PlaceChoices;
use Faker\Generator as Faker;

class ChoicesContentFactory extends Factory
{
    protected $model = ChoicesContent::class;

    public function definition()
    {
        return [
            'place_choice_id' => function () {
                return PlaceChoices::inRandomOrder()->first()->id;
            },
            'image' => $this->faker->imageUrl(255, 255),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
