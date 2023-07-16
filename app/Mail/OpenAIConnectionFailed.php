<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class OpenAIConnectionFailed extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $message,$errorTime;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $message,string $errorTime)
    {
        $this->message = $message;
        $this->errorTime = $errorTime;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'CONNECTION TO OPEN AI FAILED',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'emails.openai-connection-failed',
            with: [
                'message' => $this->message,
                'errorTime' => $this->errorTime,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
