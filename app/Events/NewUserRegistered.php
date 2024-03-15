<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class NewUserRegistered implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $username;

	public $message;
    
    public $data = ['asas'];
    public function __construct($username)
	{
		$this->username = $username;
		$this->message  = "{$username} liked your status";

        Log::info("event generate");
        // dd("dfjd");
	}

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */

    //  public function broadcastOn()
	// {
	// 	return ['status-liked'];
	// }
    public function broadcastOn()
    {
        return new Channel('notification');
    }

    public function broadcastAs()
    {
        return 'PushNotification';
    }



    // public function broadcastAs()
    // {
    //     return 'UserEvent';
    // }



    public function broadcastWith()
    {
        return ['title'=>'This notification from ItSolutionStuff.com'];
    }
}
