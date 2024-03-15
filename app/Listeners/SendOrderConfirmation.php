<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use App\Mail\MyMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendOrderConfirmation
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderPlaced $event)
{
    $order = $event->order;
    Mail::to($order->order_email)->send(new MyMail($order));
}
}
