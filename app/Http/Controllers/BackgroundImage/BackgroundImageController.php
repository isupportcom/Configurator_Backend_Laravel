<?php

namespace App\Http\Controllers\BackgroundImage;

use App\Http\Controllers\ApiController;
use App\Models\BackgroundImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BackgroundImageController extends ApiController
{
    /**
     * Display the specified resource.
     */
    public function show(BackgroundImage $backgroundImage)
    {
        return $this->showOne($backgroundImage);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BackgroundImage $backgroundImage)
    {

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();

            $oldPath = public_path('iamge') . '/' . $backgroundImage->image;
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }
            $image->move(public_path('image'), $imageName);
            $backgroundImage->image = $imageName;
        }

        // if ($backgroundImage->isClean()) {
        //     return $this->errorResponse('You need To Specify Different Value To Update', 422);
        // }


        $backgroundImage->save();
        return $this->showOne($backgroundImage);
    }
}
