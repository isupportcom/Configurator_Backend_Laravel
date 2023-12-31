<?php

namespace App\Http\Controllers\Rules;

use App\Http\Controllers\ApiController;
use App\Models\Rules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RulesController extends ApiController
{

    public function index(Request $request)
    {
        $request->validate([
            'sosource' => 'integer|in:1000,2000,3000,4000'
        ]);
        if ($request->has('sosource')) {
            $sosource = $request->input('sosource');
            $rules = Rules::where('sosource', $sosource)->get();
            return $this->showAll($rules);
        }
        $rules = Rules::all();
        return $this->showAll($rules);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'sosource' => 'required|in:1000,2000,3000,4000',
            "idslc" => "required|integer",
        ]);
        $rules = new Rules([
            "sosource" => $request->input('sosource'),
            "idslc" => $request->input('idslc'),
        ]);

        $rules->save();
        return $this->showOne($rules, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rules = Rules::with('rcnd')->findOrFail($id);
        return $this->showOne($rules);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rules = Rules::findOrFail($id);
        $rules->delete();
        return $this->showOne($rules);
    }
}
