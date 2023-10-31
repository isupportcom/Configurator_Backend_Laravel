<?php

namespace App\Http\Controllers\PlaceChoices;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\PlaceChoices;
use Illuminate\Http\Request;

class PlaceChoicesController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:cards_place,id'
        ]);

        $page = $request->input('page', 1);
        $limit = $request->input('limit', 10);

        $skipAmount = ($page - 1) * $limit;

        $placeChoices = PlaceChoices::skip($skipAmount)
            ->take($limit)
            ->where('cards_place_id', $request->input('id'))
            ->get();

        return $this->showAll($placeChoices);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'card_place_id' => 'required|integer|exists:cards_place,id',
            'name' => 'required|string|max:255',
        ]);

        $placeChoices = new PlaceChoices([
            'cards_place_id' => $request->input('card_place_id'),
            'name' => $request->input('name'),
        ]);

        $placeChoices->save();

        return $this->showOne($placeChoices, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $palceChoice = PlaceChoices::findOrFail($id);

        if ($request->has('name')) {
            $palceChoice->name = $request->input('name');
        }

        $palceChoice->save();
        return $this->showOne($palceChoice, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $placeChoice = PlaceChoices::findOrFail($id);
        $placeChoice->delete();
        return $this->showOne($placeChoice, 200);
    }
}
