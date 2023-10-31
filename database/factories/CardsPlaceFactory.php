<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CardsPlace;
use App\Models\ProductsCard;
use Faker\Generator as Faker;

class CardsPlaceFactory extends Factory
{
    protected $model = CardsPlace::class;

    public function definition()
    {
        return [
            'product_card_id' => function () {
                return ProductsCard::inRandomOrder()->first()->id;
            },
            'name' => $this->faker->word,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
