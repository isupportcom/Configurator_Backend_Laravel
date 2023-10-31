<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PlaceChoices;
use App\Models\CardsPlace;
use Faker\Generator as Faker;

class PlaceChoicesFactory extends Factory
{
    protected $model = PlaceChoices::class;

    public function definition()
    {
        return [
            'card_place_id' => function () {
                return CardsPlace::inRandomOrder()->first()->id;
            },
            'name' => $this->faker->word,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
