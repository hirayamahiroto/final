<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Message;

class MessageSent
{
    use Dispatchable, SerializesModels;

    public $message;
    public $applicationId;
    public $userId; // 追加
    public $sender; // 追加

    /**
     * Create a new event instance.
     *
     * @param Message $message
     * @param int $applicationId
     * @param int $userId
     * @param string $sender
     */
    public function __construct(
        Message $message,
        int $applicationId,
        int $userId,
        string $sender
    ) {
        $this->message = $message;
        $this->applicationId = $applicationId;
        $this->userId = $userId; // 追加
        $this->sender = $sender;
    }
}
