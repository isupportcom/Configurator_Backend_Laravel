<?php

namespace App\Http\Controllers\CardsPlace;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\CardsPlace;
use App\Models\ProductsCard;
use Illuminate\Http\Request;

class CardsPlaceController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([
            "id" => "required",
        ]);
        ProductsCard::findOrFail($request->input('id'));

        $page = $request->input("page", 1);
        $limit = $request->input("limit", 10);
        $productCardId = $request->input('id');

        $skipAmount = ($page - 1) * $limit;

        $cardsPlace = CardsPlace::skip($skipAmount)
            ->take($limit)
            ->where('product_card_id', $productCardId)
            ->get();

        return $this->showAll($cardsPlace);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'string|required|max:255',
            'product_card_id' => 'integer|required'
        ]);
        ProductsCard::findOrFail($request->input('product_card_id'));
        $cardPlace = CardsPlace::create([
            'name' => $request->input('name'),
            'product_card_id' => $request->input('product_card_id')
        ]);
        return $this->showOne($cardPlace, 201);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cardPlace = CardsPlace::findOrFail($id);

        if ($request->has('name')) {
            $cardPlace->name = $request->input('name');
        }
        $cardPlace->save();
        return $this->showOne($cardPlace, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cardPlace = CardsPlace::findOrFail($id);
        $cardPlace->delete();
        return $this->showOne($cardPlace, 200);
    }
}
