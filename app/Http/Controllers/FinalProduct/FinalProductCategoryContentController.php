<?php

namespace App\Http\Controllers\FinalProduct;

use App\Http\Controllers\ApiController;
use App\Models\FinalProduct;
use Illuminate\Http\Request;

class FinalProductCategoryContentController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(FinalProduct $final_product)
    {
        $placeChoices = $final_product
        ->card()
        ->with('places.choices')  // Load the nested relationships
        ->get()
        ->pluck('places')        // Extract 'places' collections
        ->collapse()             // Collapse into a single collection
        ->pluck('choices')       // Extract 'choices' collections
        ->collapse();            // Collapse into a single collection of PlaceChoices

    return $this->showAll($placeChoices);
        
    }
}
