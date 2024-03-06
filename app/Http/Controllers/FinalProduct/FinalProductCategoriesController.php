<?php

namespace App\Http\Controllers\FinalProduct;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\FinalProduct;

class FinalProductCategoriesController extends ApiController
{
    public function index(FinalProduct $final_product)
    {
        $placeChoices = $final_product
        ->card()
        ->with('places')  // Load the nested relationships
        ->get()
        ->pluck('places')        // Extract 'places' collections
        ->collapse();         // Collapse into a single collection
                  

    return $this->showAll($placeChoices);
        
    }
}

