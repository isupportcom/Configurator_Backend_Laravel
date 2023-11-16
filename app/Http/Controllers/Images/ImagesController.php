<?php

namespace App\Http\Controllers\Images;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

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

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'image|required'
        ]);

        $image = $request->file('image');
        $path = public_path('image'); // Directory path where you want to store images
        $extension = 'png'; // Desired extension

        $filename = 'logo.' . $extension; // Set the filename to 'logo.png'

        // Use Intervention Image to resize and save the uploaded image as a PNG file
        Image::make($image)->encode($extension)->save($path . '/' . $filename);

        return response()->json(['message' => 'Image Uploaded']);
    }
}
