<?php

namespace App\Http\Controllers\FinalProductLayers;

use App\Http\Controllers\ApiController;
use App\Models\FinalProductLayers;


class CardsPlaceLayerImages extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(FinalProductLayers $final_product_layer)
    {

        $images = $final_product_layer->layerImages()->get();
        return $this->showAll($images);
    }
}
