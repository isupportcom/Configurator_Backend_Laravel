<?php

namespace App\Http\Controllers\Icons;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class IconsController extends Controller
{
    public function index(Request $request)
    {

        $page = $request->input("page", 1);
        $limit = $request->input("limit", 10);

        $skipAmount = ($page - 1) * $limit;

        $iconsFile = storage_path("app/material-icons.json");
        $iconsNames = json_decode(File::get($iconsFile), true);
        $iconsCount = count($iconsNames);
        $icons = array_slice($iconsNames, $skipAmount, $limit);

        return response()->json([
            "icons" => $icons,
            "count" => $iconsCount
        ]);
    }
}
