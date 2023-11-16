<?php

namespace App\Http\Controllers\Rules;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Rules;
use App\Models\Rulescnd;
use Illuminate\Http\Request;

class RulesCndController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $rules = Rules::findOrFail($id);
        $cnds = $rules->rcnd[0];



        return $this->showOne($cnds);
    }
}
