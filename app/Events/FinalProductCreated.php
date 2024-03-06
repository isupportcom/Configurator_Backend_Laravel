<?php

namespace App\Events;

use App\Models\FinalProduct;
use Illuminate\Broadcasting\InteractsWithSockets;

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
