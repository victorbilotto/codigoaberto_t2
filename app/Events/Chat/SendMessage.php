<?php

namespace App\Events\Chat;

use App\Models\Message;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $userNotification;

    /**
     * Create a new event instance
     *
     * @param Message $message
     * @param int $userNotification
     */
    public function __construct(Message $message, int $userNotification)
    {
        $this->message = $message;
        $this->userNotification = $userNotification;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('user.' . $this->userNotification);
    }

    /**
     * @return string
     */
    public function broadcastAs()
    {
        return 'SendMessage';
    }

    /**
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'message' => $this->message
        ];
    }
}
