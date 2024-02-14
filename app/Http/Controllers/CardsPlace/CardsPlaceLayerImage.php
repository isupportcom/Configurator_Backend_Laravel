<?php

namespace App\Http\Controllers\CardsPlace;

use App\Http\Controllers\ApiController;
use App\Models\CardsPlace;

class CardsPlaceLayerImage extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(CardsPlace $cardPlace)
    {
        $layerImages = $cardPlace->layers()->get();
        return $this->showAll($layerImages);
    }

 
}
