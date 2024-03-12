<?php

namespace App\Http\Controllers\Materials;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\Materials;


class MaterialsController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       
    $validatedData = $request->validate([
        'card_place_id' => 'required|integer|exists:cards_places,id' // Ensure the field name matches your input name.
    ]);

    $material = Materials::where('card_place_id', $validatedData['card_place_id']) // Use the validated data
        ->get(['id', 'card_place_id', 'name', 'min', 'max']);

    return $this->showAll($material);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'card_place_id' => 'required|integer|exists:cards_places,id',
            "name" => "required|string",
            "min" => "required|string",
            "max" => "required|string"
        ]);

        
        $material = new Materials([
            'card_place_id' => $request->input('card_place_id'),
            'name' => $request->input('name'),
            'min' => $request->input('min'),
            'max' => $request->input('max')
        ]);

        $material->save();

        return $this->showOne($material, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $material = Materials::findOrFail($id);
        return $this->showOne($material);
    }

    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'card_place_id' => 'string',
            'name' => 'string',
            'min' => 'string',
            'max' => 'string',
        ]);
    
        $material = Materials::findOrFail($id);
    
        // No need to log here if you're confident you're receiving the right data
        $material->card_place_id = $request->input('card_place_id');
        $material->name = $request->input('name');
        $material->min = $request->input('min');
        $material->max = $request->input('max');
    
        $material->save();
    
        return $this->showOne($material);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $material = Materials::findOrFail($id);

        $material->delete();
        return $this->showOne($material,200);
    }
}
