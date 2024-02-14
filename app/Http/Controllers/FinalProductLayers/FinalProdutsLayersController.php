<?php

namespace App\Http\Controllers\FinalProductLayers;

use App\Http\Controllers\ApiController;
use App\Models\FinalProductLayers;
use App\Models\Layer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class FinalProdutsLayersController extends ApiController
{

    protected function generateUniqueLayerId()
{
    return Str::uuid()->toString();
}

public function index(Request $request)
{
    // Require 'final_product_layer_id' to be present in the request
    $request->validate([
        'final_product_layer_id' => 'required|integer'
    ]);

    // Fetch layers filtered by 'final_product_layer_id'
    $finalProductLayerId = $request->input('final_product_layer_id');
    $layers = Layer::where('final_product_layer_id', $finalProductLayerId)->get();

    // Return the filtered layers as a JSON response
    return response()->json(['data' => $layers]);
}


    public function show(FinalProductLayers $final_product_layer)
    {
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
        
            $currentLayerCount = $final_product_layer->layers()->count();
            $requestedLayerCount = $request->input('layers');
        
            if ($requestedLayerCount > $currentLayerCount) {
                for ($i = $currentLayerCount; $i < $requestedLayerCount; $i++) {
                    $uniqueLayerId = $this->generateUniqueLayerId(); // Now generates a UUID for each new layer
                    $final_product_layer->layers()->create(['unique_layer_id' => $uniqueLayerId]);
                }
            }
            // Optionally, handle reducing the number of layers if $requestedLayerCount < $currentLayerCount
        
            return $this->showOne($final_product_layer->load('layers'));
        }
        

}
