<?php

namespace App\Listeners;

use App\Events\PromoteMarbot;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateMarbotStandard
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
    public function handle(PromoteMarbot $event): void
    {
        $event->marbot->standard_id += 1;
        $event->marbot->save();
    }
}
