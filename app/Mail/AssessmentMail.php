<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AssessmentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $formAssessments;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $formAssessments)
    {
        $this->user = $user;
        $this->formAssessments = $formAssessments;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Evaluation',
        );
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.assessment-mail')
                    ->with([
                        'factor' => $this->user,
                        'formAssessments' => $this->formAssessments,
                    ]);
    }
}
