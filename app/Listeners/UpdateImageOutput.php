<?php

namespace App\Listeners;

use App\Events\LayerUpdated;
use App\Models\ImagesOutput;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateImageOutput
{
    use InteractsWithQueue;

    private $image_name = 'images.webp';

    /**
     * Handle the event.
     */
    public function handle(LayerUpdated $event): void
    {
        //extract the final product layer from the event
        $finalProductLayer = $event->finalProductLayer;

        //get the id for search later
        $layer_id = $finalProductLayer->id;

        // number of layers based on the updated final product layer
        $layers_count = $finalProductLayer->layers;

        // get the records based on the input
        $imagesOutput = $finalProductLayer->imageOuput()->get();

        // count the records
        $imagesOutputCount = count($imagesOutput);

        //compare the new value and the old value
        if ($layers_count > $imagesOutputCount) {
            // if the new value is bigger than the previous create the values are needed
            /*
            the new layers are the new layers count minus the old  count
            e.g.
            $newCount = 10;
            $oldCount = 5;
                5       =    10     -    5
            $newLayers = $newCount - $oldCount
            */

            // Calculate the number of layers to be added
            $newLayers = $layers_count - $imagesOutputCount;

            //loop throu the remain layers to insert them in the database
            for ($i = 0; $i < $newLayers; $i++) {
                // create new instance of ImagesOutput
                $image = new ImagesOutput([
                    'final_product_layers_id' => $layer_id,
                    'image' => $this->image_name
                ]);
                // save the new instance
                $image->save();
            }
        } else {
            // if the new value is smaller than the old value then we need to delete the extra records from the table
            /*
            the remaining  layers are  the old  count minus the new layers count
            e.g.
            $newCount = 5;
            $oldCount = 10;
                5       =    10     -    5
            $newLayers = $oldCount - $newCount
            */

            // Calculate the number of layers to be removed
            $remainingLayers = $imagesOutputCount - $layers_count;

            if ($remainingLayers > 0) {
                // Delete the newest records from the database
                ImagesOutput::where('final_product_layers_id', $layer_id)
                    ->orderBy('created_at', 'desc')
                    ->limit($remainingLayers)
                    ->delete();
            }
        }
    }
}
