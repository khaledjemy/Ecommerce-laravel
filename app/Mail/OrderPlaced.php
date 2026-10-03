<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Order $order, public bool $forStore = false)
    {
    }

    public function build(): self
    {
        return $this->subject($this->forStore ? 'New store order #'.$this->order->id : 'Order #'.$this->order->id.' received')
            ->view('emails.order-placed');
    }
}
