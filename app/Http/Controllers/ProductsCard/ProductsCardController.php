<?php

namespace App\Http\Controllers\ProductsCard;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\FinalProduct;
use App\Models\ProductsCard;
use Illuminate\Http\Request;

class ProductsCardController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $request->validate([
            'id' => ['required', 'integer'],
        ]);

        $page = $request->input("page", 1);
        $limit = $request->input("limit", 10);
        $finalProductID = $request->input('id');

        $skipAmount = ($page - 1) * $limit;

        $productsCard = ProductsCard::skip($skipAmount)
            ->take($limit)
            ->where('final_product_id', $finalProductID)
            ->get();
        return $this->showAll($productsCard);
        //
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => "required|string|max:255",
            "icon" => "required|string|max:255",
            "final_product_id" => "required|integer",
        ]);


        // check if final product exists
        FinalProduct::findOrFail($request->input('final_product_id'));


        $productsCard = new ProductsCard([
            "name" => $request->input('name'),
            "icon" => $request->input('icon'),
            "final_product_id" => $request->input('final_product_id'),
        ]);

        $productsCard->save();
        return $this->showOne($productsCard, 201);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $productCard = ProductsCard::findOrFail($id);

        if ($request->has('name')) {
            $productCard->name = $request->input('name');
        }

        if ($request->has('icon')) {
            $productCard->icon = $request->input('icon');
        }

        if ($productCard->isClean()) {
            return $this->errorResponse('You need to specify a different value to update', 422);
        }

        $productCard->save();
        return $this->showOne($productCard, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $productCard = ProductsCard::findOrFail($id);
        $productCard->delete();
        return $this->showOne($productCard, 200);
    }
}
