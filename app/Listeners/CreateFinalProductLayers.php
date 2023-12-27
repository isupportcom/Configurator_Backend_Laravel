<?php

namespace App\Listeners;

use App\Events\FinalProductCreated;
use App\Models\FinalProductLayers;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateFinalProductLayers implements ShouldQueue
{

    use InteractsWithQueue;

    /**
     * Handle the event.
     */
    public function handle(FinalProductCreated $event): void
    {
        $finalProductId = $event->finalProduct->id;
        $finalProductLayers = new FinalProductLayers([
            'final_product_id' => $finalProductId,
            'layers' => 1
        ]);

        $finalProductLayers->save();
    }
}
