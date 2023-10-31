<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProductsCard;
use App\Models\FinalProduct;
use Faker\Generator as Faker;

class ProductsCardFactory extends Factory
{
    protected $model = ProductsCard::class;

    public function definition()
    {
        return [
            'final_product_id' => function () {
                return FinalProduct::inRandomOrder()->first()->id;
            },
            'name' => $this->faker->word,
            'icon' => $this->faker->imageUrl(255, 255),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
