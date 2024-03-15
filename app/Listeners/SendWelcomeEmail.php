<?php

namespace App\Listeners;

use App\Events\NewUserRegistered;
use App\Mail\MyMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmail
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


public function handle(NewUserRegistered $event)
{
    Log::info('------------------ NOTIFICATION FAILED ');
    // $order = $event->user;
    // Mail::to($order->customer_email)->send(new MyMail($order));
}
}
