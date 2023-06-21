<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Auth\User;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderClosedMail extends Mailable
{
    use Queueable, SerializesModels;

    private string $pathToAttachment;
    private Order $order;
    private User $user;

    /**
     * Create a new message instance.
     */
    public function __construct($order, $user, $pathToAttachment)
    {
        $this->order = $order;
        $this->user = $user;
        $this->pathToAttachment = $pathToAttachment;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'ImagineShirt - Order no ' . $this->order->id . ' - Receipt',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.closedOrder',
            with: [
                'order' => $this->order,
                'user' => $this->user
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
        return [
            // Attachment::fromStorage($this->pathToAttachment),
            // Attachment::fromPath($this->pathToAttachment)
        ];
    }
}