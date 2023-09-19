<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $validatedData;


    public function __construct($validatedData)
    {
        $this->validatedData = $validatedData;
    }

    public function build()
    {
        $subject='Contact Inquiry';
        return $this->subject($subject)->markdown('emails.contactdetails')->with([
                'validatedData' => $this->validatedData,                        
            ]);
    }
}
