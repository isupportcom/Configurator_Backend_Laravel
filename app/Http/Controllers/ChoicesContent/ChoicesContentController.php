<?php

namespace App\Http\Controllers\ChoicesContent;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\ChoicesContent;
use Illuminate\Http\Request;

class ChoicesContentController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:place_choices,id'
        ]);

        $page = $request->input('page', 1);
        $limit = $request->input('limit', 10);

        $skipAmount = ($page - 1) * $limit;

        $choicesContent = ChoicesContent::skip($skipAmount)
            ->take($limit)
            ->where('place_choices_id', $request->input('id'))
            ->get();

        return $this->showAll($choicesContent);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'place_choice_id' => 'required|integer|exists:place_choices,id',
            "image" => "required|mimes:jpeg,png,jpg,gif"
        ]);

        $choicesContent = new ChoicesContent([
            'cards_place_id' => $request->input('cards_place_id'),
            'name' => $request->input('name'),
        ]);

        $choicesContent->save();
        return $this->showOne($choicesContent, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $choiceContent = ChoicesContent::findOrFail($id);

        if ($request->has('name')) {
            $choiceContent->name = $request->name;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
