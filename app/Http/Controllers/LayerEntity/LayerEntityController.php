<?php

namespace App\Http\Controllers\LayerEntity;

use App\Http\Controllers\ApiController;
use App\Models\LayerEntity;
use Illuminate\Http\Request;

class LayerEntityController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $layerEntityQuery = LayerEntity::query();

        if($request->has('unique_layer_id')){
            $layer_id = $request->input('unique_layer_id');
            $layerEntityQuery = $layerEntityQuery->where('unique_layer_id', $layer_id);
        }


        $layerEntities = $layerEntityQuery->get(['id', 'image', 'unique_layer_id', 'cat_cons']);

        return $this->showAll($layerEntities);

    }

    
    /**
     * Display the specified resource.
     */
    public function show($id, Request $request)
    {
        // Check if the request is looking for a unique_layer_id instead of a primary key ID
        if ($request->has('unique_layer_id')) {
            $uniqueLayerId = $request->query('unique_layer_id');
            
            $layerEntities = LayerEntity::where('unique_layer_id', $uniqueLayerId)->get();
    
            if ($layerEntities->isEmpty()) {
                return response()->json(['error' => 'No Layer Entities found with the specified unique_layer_id'], 404);
            }
    
            return response()->json(['data' => $layerEntities], 200);
        }
    
        // Proceed with normal behavior if unique_layer_id is not in the query
        $layerEntity = LayerEntity::findOrFail($id);
    
        return response()->json(['data' => $layerEntity], 200);
    }

    


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cat_cons' => 'required|array',
            'cat_cons.*' => 'integer|exists:place_choices,id', 
            'unique_layer_id' => 'required|integer|exists:layers,id',
            'image' => 'required | string'

        ]);

        
       

       
           // Ensure the CardsPlace exists
 

        $layerEntity = new LayerEntity([
            'cat_cons' => $request->input('cat_cons'),
            'unique_layer_id' => $request->input('unique_layer_id'),
            'image' => $request->input('image')
        ]);


        
        $layerEntity->save();
    
        return $this->showOne($layerEntity, 201);
      
    }

  

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'cat_cons' => 'required|array',
            'cat_cons.*' => 'integer|exists:place_choices,id',
            'unique_layer_id' => 'required|integer|exists:layers,id',
            'image' => 'required|string'
        ]);
    
        // Find the LayerEntity by ID
        $layerEntity = LayerEntity::find($id);
    
        // Check if the LayerEntity was found
        if (!$layerEntity) {
            return response()->json(['error' => 'LayerEntity not found'], 404);
        }
    
        // Update the LayerEntity with request data
        $layerEntity->cat_cons = $request->input('cat_cons');
        $layerEntity->unique_layer_id = $request->input('unique_layer_id');
        $layerEntity->image = $request->input('image');
    
        // Save the changes to the database
        $layerEntity->save();
    
        // Return the updated LayerEntity
        return response()->json(['data' => $layerEntity], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $layerEntity = LayerEntity::find($id);
    
        // Check if the LayerEntity was found
        if (!$layerEntity) {
            return response()->json(['error' => 'LayerEntity not found'], 404);
        }
    
        // Attempt to delete the LayerEntity
        try {
            $layerEntity->delete();
            return response()->json(['message' => 'LayerEntity successfully deleted'], 200);
        } catch (\Exception $e) {
            // If there's an exception (e.g., foreign key constraint fails), return a 500 error
            return response()->json(['error' => 'LayerEntity could not be deleted. Please try again later.'], 500);
        }
    }
}
