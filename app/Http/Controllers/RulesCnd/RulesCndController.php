<?php

namespace App\Http\Controllers\RulesCnd;

use App\Http\Controllers\ApiController;
use App\Models\CardsPlace;
use App\Models\FinalProduct;
use App\Models\PlaceChoices;
use App\Models\ProductsCard;
use App\Models\Rulescnd;
use Illuminate\Http\Request;

class RulesCndController extends ApiController
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'idr' => 'required|integer|exists:rules,id',
            're' => 'required|boolean|in:0,1',
            'sosourcer' => 'required|in:1000,2000,3000,4000',
            'idc' => 'required|integer'
        ]);

        //check if the idc is valid based on the sosourcer
        $sosource = $request->input('sosourcer');
        $idc = $request->input('idc');
        $this->checkSosourceId($sosource, $idc);
        $ruleCnd = new Rulescnd([
            'idr' => $request->input('idr'),
            're' => $request->input('re'),
            'sosourcer' => $request->input('sosourcer'),
            'idc' => $request->input('idc'),
        ]);

        $ruleCnd->save();
        return $this->showOne($ruleCnd, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ruleCnd = Rulescnd::findOrFail($id);
        return $this->showOne($ruleCnd);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            're' => 'boolean|in:0,1',
            'sosourcer' => 'in:1000,2000,3000,4000',
        ]);
        $ruleCnd = Rulescnd::findOrFail($id);

        if ($request->has('re')) {

            $ruleCnd->re = $request->input('re');
        }

        if ($request->has('sosourcer')) {
            $ruleCnd->sosourcer = $request->input('sosourcer');
        }

        if ($request->has('idc')) {
            $this->checkSosourceId($ruleCnd->sosourcer, $request->input('idc'));
            $ruleCnd->idc = $request->input('idc');
        }

        $ruleCnd->save();
        return $this->showOne($ruleCnd, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ruleCnd = Rulescnd::findOrFail($id);
        $ruleCnd->delete();
        return $this->showOne($ruleCnd, 200);
    }

    protected function checkSosourceId(int $sosource, int $id)
    {
        switch ($sosource) {
            case 1000:
                // check based on FinalProduct
                FinalProduct::findOrFail($id);
                break;
            case 2000:
                //check based on ProductsCard
                ProductsCard::findOrFail($id);
                break;
            case 3000:
                //check based on CardsPlaces
                CardsPlace::findOrFail($id);
                break;
            case 4000:
                //check based on PlaceChoices
                PlaceChoices::findOrFail($id);
                break;
        }
    }
}
