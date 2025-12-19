<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LeaveMail extends Mailable
{
    use Queueable, SerializesModels;

    public $title;
    public $user;
    public $receiver;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title, $user, $receiver)
    {
        $this->title = $title;
        $this->user = $user;
        $this->receiver = $receiver;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->title,
        );
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.leave-mail')
                ->with([
                    'user' => $this->user,
                    'receiver' => $this->receiver,
                ])
                ->from('madgi@ci-plus.net', config('mail.from.name'));
    }
}
