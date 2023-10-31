<?php

namespace App\Http\Controllers\FinalProduct;

use App\Http\Controllers\ApiController;
use App\Models\FinalProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FinalProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $page = $request->input("page", 1);
        $limit = $request->input("limit", 10);
        $skipAmount = ($page - 1) * $limit;

        $finalProducts = FinalProduct::skip($skipAmount)
            ->take($limit)
            ->get();

        $finalProductsCount = FinalProduct::count();

        return response([
            'data'=> $finalProducts,
            'count' => $finalProductsCount
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string|max:255",
            "description" => "required|string",
            "image" => "required|mimes:jpeg,png,jpg,gif"
        ]);
        if (!$request->hasFile("image")) {
            return $this->errorResponse('No Image Provided', 422);
        }

        $image = $request->file("image");
        $imageName = $image->getClientOriginalName();

        $image->move(public_path('image'), $imageName);


        $finalProduct = new FinalProduct([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => $imageName,
        ]);

        $finalProduct->save();
        return $this->showOne($finalProduct, 201);
    }
    /**
     * Update the specified resource in storage.
     */ public function update(Request $request, string $id)
    {
        $finalProduct = FinalProduct::findOrFail($id);
        if ($request->has('name')) {

            $finalProduct->name = $request->input('name');
        }

        if ($request->has('description')) {
            $finalProduct->description = $request->input('description');
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();

            // Delete the previous image
            $oldImagePath = public_path('image') . '/' . $finalProduct->image;
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }

            // Move the new image to the public directory
            $image->move(public_path('image'), $imageName);
            $finalProduct->image = $imageName;
        }

        if (!$finalProduct->isDirty()) {
            return $this->errorResponse('You need to specify a different value to update', 422);
        }


        $finalProduct->save();

        return $this->showOne($finalProduct);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $finalProduct = FinalProduct::findOrFail($id);
        $finalProduct->delete();
        return $this->showOne($finalProduct);
    }
}
