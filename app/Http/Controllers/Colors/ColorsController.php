<?php

namespace App\Http\Controllers\Colors;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorsController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colors = Color::all();
        return $this->showAll($colors);
    }





    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Color $color)
    {
        $request->validate([
            'name' => 'string|in:primary,primary_light,primary_dark,secondary,secondary_light,secondary_dark',
            'color' => 'string'
        ]);
        if ($request->has('name')) {
            $color->name = $request->input('name');
        }

        if ($request->has('color')) {
            $color->color = $request->input('color');
        }

        if ($color->isClean()) {
            return $this->errorResponse('You Need To Specify a different value to update', 422);
        }

        $color->save();
        return $this->showOne($color);
    }
}
