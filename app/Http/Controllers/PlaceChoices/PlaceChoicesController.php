<?php

namespace App\Http\Controllers\PlaceChoices;

use App\Http\Controllers\ApiController;
use App\Models\PlaceChoices;
use App\Service\DeleteRulesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PlaceChoicesController extends ApiController
{

    protected $rulesService;

    public function __construct(DeleteRulesService $rulesService)
    {
        $this->rulesService = $rulesService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:cards_places,id'
        ]);

        $page = $request->input('page', 1);
        $limit = $request->input('limit', 10);

        $skipAmount = ($page - 1) * $limit;

        $placeChoices = PlaceChoices::skip($skipAmount)
            ->take($limit)
            ->where('card_place_id', $request->input('id'))
            ->get();

        return $this->showAll($placeChoices);
    }


    public function show(string $id)
    {
        $placeChoice = PlaceChoices::findOrFail($id);
        return $this->showOne($placeChoice);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'card_place_id' => 'required|integer|exists:cards_places,id',
            "image" => "required|mimes:jpeg,png,jpg,gif,webp",
            "name" => "required|string"
        ]);

        if (!$request->hasFile('image')) {
            return $this->errorResponse('No Image Provided', 422);
        }

        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();

        $image->move(public_path('image'), $imageName);

        $placeChoice = new PlaceChoices([
            'card_place_id' => $request->input('card_place_id'),
            'image' => $imageName,
            "name" => $request->input('name')
        ]);


        $placeChoice->save();


        return $this->showOne($placeChoice, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $palceChoice = PlaceChoices::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            // moutoudis
            // Delete the previous image
            $oldImagePath = public_path('image') . '/' . $palceChoice->image;
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }
            $palceChoice->image  = $imageName;
            // Move the new image to the public directory
            $image->move(public_path('image'), $imageName);
        }

        if ($request->has('name')) {
            $palceChoice->name = $request->input('name');
        }

        $palceChoice->save();
        sleep(2);
        return $this->showOne($palceChoice, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $placeChoice = PlaceChoices::findOrFail($id);

        $imagePath = public_path('image') . '/' . $placeChoice->image;
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $this->rulesService->deleteRules($id, 4000);
        $placeChoice->delete();
        return $this->showOne($placeChoice, 200);
    }
}
