<?php

namespace App\Http\Controllers\LayerImages;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\LayerImages;
use App\Models\CardsPlace;
use Illuminate\Http\Request;

class LayerImagesController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
  public function index(Request $request)
{
    $layerImagesQuery = LayerImages::query(); // Start with a query builder

    if ($request->has('unique_layer_id')) {
        $layer_id = $request->input('unique_layer_id');
        $layerImagesQuery = $layerImagesQuery->where('unique_layer_id', $layer_id);
    }

    $layerImages = $layerImagesQuery->get(['id', 'image', 'layer_id', 'unique_layer_id']);

   
  
    return $this->showAll($layerImages);
}



public function show($id)
{
    // Attempt to find the layer image by ID
    $layerImage = LayerImages::find($id);

    // If not found, return an error response
    if (!$layerImage) {
        return $this->errorResponse('LayerImage not found', 404);
    }

    // If found, return the layer image
    return $this->showOne($layerImage);
}


 
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'image|required',
            'layer_id' => 'required|integer|exists:final_product_layers,id',
            'unique_layer_id' => 'required|integer|exists:layers,id'
        ]);

        
        if (!$request->hasFile('image')) {
            return $this->errorResponse('No Image Provided', 422);
        }

        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();

        $image->move(public_path('image'), $imageName);

           // Ensure the CardsPlace exists
 

        $layerImage = new LayerImages([
            'layer_id' => $request->input('layer_id'),
            'unique_layer_id' => $request->input('unique_layer_id'),
            'image' => $imageName
     
        ]);


        
        $layerImage->save();
    
        return $this->showOne($layerImage, 201);
      
    }

  

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Attempt to find the layer image by ID
        $layerImage = LayerImages::find($id);
    
        // If not found, return an error response
        if (!$layerImage) {
            return $this->errorResponse('LayerImage not found', 404);
        }
    
        // Delete the layer image
        $layerImage->delete();
        return $this->showOne($layerImage);
    }
}
