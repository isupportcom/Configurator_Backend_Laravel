<?php

namespace App\Listeners;

use App\Events\BackgrounImageUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use League\ColorExtractor\Palette;
use League\ColorExtractor\Color;
use League\ColorExtractor\ColorExtractor;
// Import the Color model with an alias to avoid name conflict
use App\Models\Color as ColorModel;

class UpdateDominantColorListener
{
    use InteractsWithQueue;

    /**
 * Handle the event.
 */
public function handle(BackgrounImageUpdated $event): void
{
    $backgroundImage = $event->backgrounImage;
    try {
        $palette = Palette::fromFilename(public_path('image') . '/' . $backgroundImage->image);
        $extractor = new ColorExtractor($palette);
        $colors = $extractor->extract(1); // Extracts the most common color
        
        // Convert the color to hex format for easier reading
        $mostCommonColorHex = Color::fromIntToHex($colors[0]);
        
        // Log the most common color in hex format
        Log::info("Most common color: " . $mostCommonColorHex);

        // Check if a 'background_color' entry already exists
        $colorModel = ColorModel::firstOrNew(['name' => 'background_color']);
        
        // Update the color value
        $colorModel->color = $mostCommonColorHex;
        
        // Save the color into the database
        $colorModel->save();

    } catch (\Exception $e) {
        Log::error("Error extracting color: " . $e->getMessage());
    }
}

}
