<?php

namespace App\Http\Controllers\DefaultSelections;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Models\DefaultSelections;

class DefaultSelectionsController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $finalProductId = $request->query('finalProductId');
    
        if ($finalProductId) {
            $DefaultSelection = DefaultSelections::where('finalProductId', $finalProductId)->get();
        } else {
            $DefaultSelection = DefaultSelections::all();
        }
    
        return $this->showAll($DefaultSelection);
    }

   
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'finalProductId' => 'required|integer',
            'mainSelected' => 'required|integer|exists:place_choices,id',
            'subSelected' => 'required|array',
            'subSelected.*' => 'integer|exists:place_choices,id', 
        ]);

        $defaultSelection = new DefaultSelections([
            'mainSelected' => $request->input('mainSelected'),
            'finalProductId' => $request->input('finalProductId'),
            'subSelected' => $request->input('subSelected')
        ]);

        $defaultSelection->save();

        return $this->showOne($defaultSelection, 201);


    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $DefaultSelection = DefaultSelections::findOrFail($id);
        return response()->json($DefaultSelection);
    }

   
    public function update(Request $request, $id){


        $request->validate([
            'finalProductId' => 'required|integer',
            'mainSelected' => 'required|integer|exists:place_choices,id',
            'subSelected' => 'required|array',
            'subSelected.*' => 'integer|exists:place_choices,id', 
        ]);

        $DefaultSelection = DefaultSelections::find($id);

        $DefaultSelection->subSelected = $request->input('subSelected');
        $DefaultSelection->finalProductId = $request->input('finalProductId');
        $DefaultSelection->mainSelected = $request->input('mainSelected');
    
        $DefaultSelection->save();
    

        // Return the updated LayerEntity
        return response()->json(['data' => $DefaultSelection], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $DefaultSelection = DefaultSelections::findOrFail($id);
        $DefaultSelection->delete();
        return response()->json(null, 204);
    }
}
