<?php

namespace App\Http\Controllers\ImageConfiguration;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Models\ImageConfig;

class ImageConfigurationController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Check if a 'layer_id' query parameter was provided in the request
        $layerId = $request->query('layer_id');
    
        if ($layerId) {
            $imageConfig = ImageConfig::where('layer_id', $layerId)->get();
        } else {
            $imageConfig = ImageConfig::all();
        }
    
        return $this->showAll($imageConfig);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'layer_id' => 'required|integer',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'opacity' => 'required|numeric|min:0|max:100',
            'posX' => 'required|numeric',
            'posY' => 'required|numeric',
            'posZ' => 'required|numeric',
        ]);

        $imageConfig = ImageConfig::create($validatedData);
        return response()->json($imageConfig, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $imageConfig = ImageConfig::findOrFail($id);
        return response()->json($imageConfig);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $imageConfig = ImageConfig::findOrFail($id);

        $validatedData = $request->validate([
            'layer_id' => 'integer',
            'width' => 'sometimes|required|numeric',
            'height' => 'sometimes|required|numeric',
            'opacity' => 'sometimes|required|numeric|min:0|max:100',
            'posX' => 'sometimes|required|numeric',
            'posY' => 'sometimes|required|numeric',
            'posZ' => 'sometimes|required|numeric',
        ]);

        $imageConfig->update($validatedData);
        return response()->json($imageConfig);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $imageConfig = ImageConfig::findOrFail($id);
        $imageConfig->delete();
        return response()->json(null, 204); // No content to send back
    }
}
