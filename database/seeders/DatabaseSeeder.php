<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\CardsPlace;
use App\Models\ChoicesContent;
use App\Models\FinalProduct;
use App\Models\PlaceChoices;
use App\Models\ProductsCard;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        FinalProduct::factory(10)->create();
        ProductsCard::factory(10)->create();
        CardsPlace::factory(10)->create();
        PlaceChoices::factory(10)->create();
        ChoicesContent::factory(10)->create();
    }
}
