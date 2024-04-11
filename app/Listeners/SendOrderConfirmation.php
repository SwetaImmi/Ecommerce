<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use App\Mail\MyMail;
use App\Mail\OrderConfirmaionMail;
use App\Mail\single_confirmMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
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
    $orderDetailsArray = $event->orderDetailsArray;
    Mail::to(Auth::user()->email)->send(new single_confirmMail($orderDetailsArray));
}
}
