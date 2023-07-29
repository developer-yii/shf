<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ChatNotificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $chat;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($chat)
    {
        $this->chat = $chat;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.chat_notification')
                    ->subject('New Chat Message')
                    ->with([
                        'chatMessage' => $this->chat->chat_message,
                        'userName' => $this->chat->receiver_name,
                        'createdAt' => $this->chat->created_date,
                    ]);
    }
}
