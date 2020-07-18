<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResponseForm extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Array $data
     */
    protected $data;


    /**
     * @var Object $object
     */
    protected $object;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $data, object $object)
    {
        $this->data = $data;
        $this->object = $object;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->object->from_email, $this->object->from_name)
                    ->subject($this->object->subject)
                    ->markdown('mail.'.strtolower($this->object->Mails->name), ['data' => $this->data])
                    // ->attachFromStorage($this->object->attachment)
                    ->with([
                        'body' => $this->object->body,
                        'sender' => $this->object->from_name,
                        'mail_s' => $this->object->from_email,
                    ]);
    }
}
