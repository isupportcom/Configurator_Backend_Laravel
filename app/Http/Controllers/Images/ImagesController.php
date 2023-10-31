<?php

namespace App\Http\Controllers\Images;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
    public function show($filename)
    {
        $path = public_path('image/' . $filename);
        if (file_exists($path)) {
            return response()->file($path);
        } else {
            return response()->json(['error' => 'Image not found'], 404);
        }
    }
}
