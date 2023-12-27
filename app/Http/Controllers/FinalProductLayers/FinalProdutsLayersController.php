<?php

namespace App\Http\Controllers\FinalProductLayers;

use App\Http\Controllers\ApiController;
use App\Models\FinalProductLayers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FinalProdutsLayersController extends ApiController
{


    public function show(FinalProductLayers $final_product_layer)
    {
        Log::info('FinalProductLayers show method called', ['id' => $final_product_layer->id]);
        return $this->showOne($final_product_layer);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FinalProductLayers $final_product_layer)
    {
        $request->validate([
            'layers' => "required|integer|min:1"
        ]);



        if ($request->input('layers')) {
            $final_product_layer->layers = $request->input('layers');
        }
        $final_product_layer->save();
        return $this->showOne($final_product_layer);
    }
}
