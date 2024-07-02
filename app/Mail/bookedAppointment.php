<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class bookedAppointment extends Mailable
{
    use Queueable, SerializesModels;
    public $emailMessage = "";
    public $appointment = [];
    public $emailSubject = "";
    /**
     * Create a new message instance.
     */
    public function __construct($emailMessage,$appointment,$emailSubject)
    {
        $this->emailMessage = $emailMessage;
        $this->appointment = $appointment;
        $this->emailSubject = $emailSubject;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->emailSubject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.appointment',
            with:[
              'appointment'=>$this->appointment,
              'emailMessage'=>$this->emailMessage, 
            ]
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
