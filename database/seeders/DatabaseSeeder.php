<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\CardsPlace;
use App\Models\FinalProduct;
use App\Models\PlaceChoices;
use App\Models\ProductsCard;
use App\Models\User;
use App\Models\Color;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // FinalProduct::factory(10)->create();
        // ProductsCard::factory(10)->create();
        // CardsPlace::factory(10)->create();
        // PlaceChoices::factory(10)->create();
        User::factory(1)->create();

        // $colorNames = [
        //     'primary',
        //     'primary_light',
        //     'primary_dark',
        //     'secondary',
        //     'secondary_light',
        //     'secondary_dark',
        // ];

        // foreach ($colorNames as $colorName) {
        //     Color::factory()->namedColor($colorName)->create([
        //         'color' => fake()->hexColor,
        //     ]);
        // }
        
    }
}
