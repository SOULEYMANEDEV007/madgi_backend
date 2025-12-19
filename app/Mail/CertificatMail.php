<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CertificatMail extends Mailable
{
    use Queueable, SerializesModels;

    public $title;
    public $name;
    public $url;
    public $receiver;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title, $name, $url, $receiver)
    {
        $this->title = $title;
        $this->name = $name;
        $this->url = $url;
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
        return $this->markdown('mail.certificat-mail')
                ->with([
                    'title' => $this->title,
                    'name' => $this->name,
                    'url' => $this->url,
                    'receiver' => $this->receiver,
                ])
                ->from('madgi@ci-plus.net', config('mail.from.name'));
    }
}
