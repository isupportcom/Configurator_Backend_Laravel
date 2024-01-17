<?php

namespace App\Http\Controllers\ProductsCard;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\FinalProduct;
use App\Models\ProductsCard;
use App\Service\DeleteRulesService;
use Illuminate\Http\Request;

class ProductsCardController extends ApiController
{
    protected $rulesService;

    public function __construct(DeleteRulesService $rulesService)
    {
        $this->rulesService = $rulesService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(FinalProduct $final_product)
    {

        $productsCard = $final_product->card()->get();

        return $this->showAll($productsCard);



        // $page = $request->input("page", 1);
        // $limit = $request->input("limit", 10);
        // $finalProductID = $request->input('id');

        // $skipAmount = ($page - 1) * $limit;

        // $productsCard = ProductsCard::skip($skipAmount)
        //     ->take($limit)
        //     ->where('final_product_id', $finalProductID)
        //     ->orderBy('tab_order', 'asc')
        //     ->get();
        // return $this->showAll($productsCard);
        //
    }

    public function show(string $id)
    {
        $productCard = ProductsCard::findOrFail($id);
        return $this->showOne($productCard);
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

        $productsCard->tab_order = ProductsCard::where('final_product_id', $request->input('final_product_id'))->count() + 1;

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

        if ($request->has('icon') && $request->input('icon') !== null) {
            $productCard->icon = $request->input('icon');
        }

        if ($request->has('tab_order')) {

            // first check if the tab order is valid
            $finalProductID = $productCard->final_product_id;
            $tabOrder = $request->input('tab_order');
            $maxTabOrder = ProductsCard::where('final_product_id', $finalProductID)->count();

            if ($tabOrder > $maxTabOrder || $tabOrder < 1) {
                return $this->errorResponse('Invalid tab order', 422);
            }

            // if the tab order is valid, then check if the tab order is already taken
            $productCardWithSameTabOrder = ProductsCard::where('final_product_id', $finalProductID)
                ->where('tab_order', $tabOrder)
                ->first();
            // if there is  a product card with the same tab order ,then swap the tab order
            if ($productCardWithSameTabOrder) {
                //swap the tab order
                $productCardWithSameTabOrder->tab_order = $productCard->tab_order;
                // save the product card with the same tab order
                $productCardWithSameTabOrder->save();
                // update the tab order of the product card
                $productCard->tab_order = $tabOrder;
            } else {
                $productCard->tab_order = $tabOrder;
            }
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

        if ($productCard->final_product_id === null) {
            // Handle the case where finalProduct is null
            // For example, return an error response
            return response()->json(['error' => 'No associated finalProduct found for this ProductsCard'], 404);
        }

        // Retrieve the associated final product
        $finalProduct = FinalProduct::find($productCard->final_product_id);

        if ($finalProduct) {
            // Now, you can access the 'card()' relationship method to update related 'ProductsCard' records
            $finalProduct->card()->where('tab_order', '>', $productCard->tab_order)->decrement('tab_order');
        }
        $this->rulesService->deleteRules($id, 2000);
        $productCard->delete();
        return $this->showOne($productCard, 200);
    }
}
