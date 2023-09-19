<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscribeFormEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;


    public function __construct($email)
    {
        $this->email = $email;
    }

    public function build()
    {
        $subject='Subscription Confirmation';
        return $this->subject($subject)->markdown('emails.subscribe')->with([
                'email' => $this->email,                        
            ]);
    }
}
