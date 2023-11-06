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

        $response = [
            "icons" => [],
            "count" => 0,
        ];

        if ($request->has('search')) {
            $search = $request->input('search');

            // Filter the icons containing the search string
            $filteredIcons = array_filter($iconsNames, function ($icon) use ($search) {
                if (is_array($icon) && isset($icon['name']) && is_string($icon['name'])) {
                    return strpos($icon['name'], $search) !== false;
                }
                return false;
            });

            $response["icons"] = array_values($filteredIcons); // Re-index the array
            $response["count"] = count($response["icons"]);
        } else {
            $response["icons"] = array_slice($iconsNames, $skipAmount, $limit);
            $response["count"] = count($iconsNames);
        }

        return response()->json($response);
    }
}
