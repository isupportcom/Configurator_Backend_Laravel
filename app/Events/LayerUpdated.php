<?php

namespace App\Events;

use App\Models\FinalProductLayers;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LayerUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $finalProductLayer;

    /**
     * Create a new event instance.
     */
    public function __construct(FinalProductLayers $finalProductLayers)
    {
        $this->finalProductLayer = $finalProductLayers;
    }
}
