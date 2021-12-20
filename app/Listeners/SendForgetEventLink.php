<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\SendForgetLink;
use Mail;
use App\Mail\SendEmailToForgetThePassword;

class SendForgetEventLink
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

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(SendForgetLink $event)
    {
        Mail::to($event->email)->send(new sendEmailToForgetThePassword($event->name,$event->rand));
    }
}
