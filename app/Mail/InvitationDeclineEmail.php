<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class InvitationDeclineEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $invitationDeclineUserEmail;
    /**
     * Create a new message instance.
     */
    public function __construct($invitationDeclineUserEmail)
    {
        $this->invitationDeclineUserEmail = $invitationDeclineUserEmail;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->invitationDeclineUserEmail),
            subject: 'Invitation Decline Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.invitation-decline-page',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
