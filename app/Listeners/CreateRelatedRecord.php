<?php

namespace App\Listeners;

use App\Events\FinalProductCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateRelatedRecord
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(FinalProductCreated $event): void
    {
        //
    }
}
