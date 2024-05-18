<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;

use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;
    public $mess_email;
    public $chude_email;
    public $user_email;

    /**
     * Create a new message instance.
     */
    public function __construct($user_email , $mess_email, $chude_email)
    {
        //
        $this->mess_email = $mess_email;
        $this->chude_email = $chude_email;
        $this->user_email = $user_email;

    }
    public function build()
    {
        return $this->from($this->user_email)
            ->view('user.pages.form_email')
            ->subject('Email Petshop');
    }
}