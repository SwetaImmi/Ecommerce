<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Laravel\Cashier\Invoice as CashierInvoice;
use Stripe\Invoice;

class MyMail extends Mailable
{
    use Queueable, SerializesModels;
public $invoice;
    /**
     * Create a new message instance.
     */
    // protected  $details;
    // public function __construct($details)
    //   {
        
    //       $this->details = $details;
    //   }

    public function __construct(CashierInvoice $invoice)
    {
        $this->invoice = $invoice;
    }

    public function build()
    {
        return $this->subject('Your Invoice')->view('result')
        ->attachData($this->invoice->pdf(), 'invoice.pdf');
    }

    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
       
    //     return new Envelope(
    //         subject: 'My Mail',
    //     );
    // }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'result',
    //         // this is message content
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            // public_path('uploads/65cee2bb619a2.jpg'),
        ];
    }
}
