<?php

namespace Kwreach\Ads\Listeners;

use Kwreach\Ads\Events;
use Kwreach\Ads\Mail\SendDailyEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailFired implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function handle($event)
    {
        Mail::to($event->user->email)->send(new SendDailyEmail($event->user, $event->ad));
    }
}
