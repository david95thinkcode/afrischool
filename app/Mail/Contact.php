<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Contact extends Mailable
{
    use Queueable, SerializesModels;
    public $var;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($req)
    {
        $this->var = $req;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $name = $this->var['email'];
        $address = $this->var['email'];
        $subject = 'Message du formulaire de contact' ;
        return $this->view('mail.mail')
            ->from($address, $name)
            ->subject($subject);
    }
}
