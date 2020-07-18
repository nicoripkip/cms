<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResponseContact extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('henk@36814.hbcdeveloper.nl', 'Team ecobirds')
                    ->subject('Email bevestiging')
                    ->markdown('mails.contact')
                    ->with([
                        'name' => 'henk@36814.hbcdeveloper.nl',
                        'link' => 'https://mail.google.com/mail/u/0/#inbox'
                    ]);
    }
}
