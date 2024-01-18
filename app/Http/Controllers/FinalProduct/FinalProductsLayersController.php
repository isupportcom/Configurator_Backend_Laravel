<?php

namespace App\Http\Controllers\FinalProduct;

use App\Http\Controllers\ApiController;
use App\Models\FinalProduct;

class FinalProductsLayersController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(FinalProduct $finalProduct)
    {
        $finalProductsLayers = $finalProduct->layers()->get();
        return $this->showAll($finalProductsLayers);
    }
}
