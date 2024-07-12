<?php

namespace App\Listeners;

use App\Events\PromoteMarbot;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPromotedEmail
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
        logger('Sending email to marbot' . $event->marbot->name);
    }
}
