<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendVerificationLink extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$rand)
    {
        $this->name = $name;
        $this->rand = $rand;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data['name'] = $this->name;
        $data['rand_num'] = $this->rand;
        return $this->view('front.email_verification',$data);
    }
}
