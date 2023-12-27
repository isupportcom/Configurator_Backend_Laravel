<?php

namespace App\Http\Controllers\ImagesOuput;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\ImagesOutput;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;

class ImagesOuputController extends ApiController
{


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "layer_id" => "required|integer|exists:final_product_layers,id",
            "image" => "required|mimes:jpeg,png,jpg,gif"
        ]);

        if (!$request->hasFile('image')) {
            return $this->errorResponse('No Image Provided', 422);
        }

        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();

        $image->move(public_path('image'), $imageName);

        $imageOutput = new ImagesOutput([
            'layer_id' => $request->input('layer_id'),
            'image' => $imageName
        ]);

        $imageOutput->save();
        return $this->showOne($imageOutput, 201);
    }
    /**
     * Display the specified resource.
     */
    public function show(ImagesOutput $imagesOutput)
    {
        return $this->showOne($imagesOutput);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ImagesOutput $imagesOutput)
    {

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();

            $oldPath = public_path('image')  .  '/' . $imagesOutput->image;
            if (File::exists($oldPath)) {
                File::delete(($oldPath));
            }

            $image->move(public_path('image'), $imageName);
            $imagesOutput->image = $imageName;
        }

        if ($imagesOutput->isClean()) {
            return $this->errorResponse('You need to specify a different value to update', 422);
        }

        $imagesOutput->save();
        return $this->showOne($imagesOutput);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ImagesOutput $imagesOutput)
    {
        $imagesOutput->delete();
    }
}
