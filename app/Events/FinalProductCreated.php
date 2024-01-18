<?php

namespace App\Events;

use App\Models\FinalProduct;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FinalProductCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $finalProduct;

    /**
     * Create a new event instance.
     */
    public function __construct(FinalProduct $finalProduct)
    {
        $this->finalProduct = $finalProduct;

    }

}
