<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Auth\User;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BecomeRevisor extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $motivation;

    public function __construct(User $user, $motivation)
    {
        $this->user = $user;
        $this->motivation = $motivation;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Rendi revisore l'utente " . $this->user->name,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.become-revisor',
        );
    }


    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
