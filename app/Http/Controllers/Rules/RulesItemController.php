<?php

namespace App\Http\Controllers\Rules;

use App\Http\Controllers\ApiController;
use App\Models\CardsPlace;
use App\Models\FinalProduct;
use App\Models\PlaceChoices;
use App\Models\ProductsCard;
use App\Models\Rules;

class RulesItemController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $rules = Rules::findOrFail($id);
        switch ($rules->sosource) {
            case 1000:
                // check based on FinalProduct
                $item =  FinalProduct::findOrFail($rules->idslc);
                return $this->showOne($item);
            case 2000:
                //check based on ProductsCard
                $item =  ProductsCard::findOrFail($rules->idslc);
                return $this->showOne($item);
            case 3000:
                //check based on CardsPlaces
                $item =  CardsPlace::findOrFail($rules->idslc);
                return $this->showOne($item);
            case 4000:
                //check based on PlaceChoices
                $item =  PlaceChoices::findOrFail($rules->idslc);
                return $this->showOne($item);
            default:
                return $this->errorResponse('Invalid Sosource', 409);
        }
    }
}
