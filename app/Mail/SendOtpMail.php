<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Session;
class SendOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otpcode;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($otp)
    {
        $this->otpcode = $otp;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.otpcode')->with(['data' => $this->otpcode])
                    ->subject('Tutorvy:Verification code for Verify Your Email Address');
    }
}
