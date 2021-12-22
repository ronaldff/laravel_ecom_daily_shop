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

    private $email;
    private $name;
    private $rand;

    public function __construct()
    {
      

    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(SendForgetLink $event)
    {
        $this->email = $event->email;
        $this->name = $event->name;
        $this->rand = $event->rand;
        dispatch(function(){
            Mail::to($this->email)->send(new sendEmailToForgetThePassword($this->name,$this->rand));
        })->delay(now());
       
    }
}
