<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function build()
    {
        return $this->from('fiqrifauziilam1@gmail.com', 'Autentikasi')
                    ->subject('Reset Password Anda')
                    ->view('emails.reset-password')
                    ->with([
                        'token' => $this->token
                    ]);
    }
}

