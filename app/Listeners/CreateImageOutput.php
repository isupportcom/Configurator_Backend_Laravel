<?php

namespace App\Listeners;

use App\Events\FinalProductCreated;
use App\Events\LayerCreated;
use App\Models\ImagesOutput;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateImageOutput
{
    use InteractsWithQueue;

    private $image_name = 'images.webp';

    /**
     * Handle the event.
     */
    public function handle(LayerCreated $event): void
    {
        $final_product_layer_id = $event->finalProductLayer->id;
        $final_product_layers = $event->finalProductLayer->layers;

        for ($i = 0; $i < $final_product_layers; $i++) {
            $imageOutput = new ImagesOutput([
                'final_product_layers_id' => $final_product_layer_id,
                'image' => $this->image_name
            ]);
            $imageOutput->save();
        }
    }
}
