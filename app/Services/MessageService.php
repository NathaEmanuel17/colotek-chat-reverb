<?php
namespace App\Services;

use App\Models\Message;
use App\Repositories\MessageRepository;

class MessageService
{
    protected $messageRepository;

    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    /**
     * Get all messages between two users.
     *
     * @param int $senderId
     * @param int $receiverId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getMessagesBetween($senderId, $receiverId)
    {
        return $this->messageRepository->getMessagesBetween($senderId, $receiverId);
    }

    /**
     * Create a new message.
     *
     * @param array $data
     * @return Message
     */
    public function createMessage(array $data)
    {
        return $this->messageRepository->create($data);
    }

    /**
     * Find a message by ID.
     *
     * @param int $id
     * @return Message
     */
    public function findMessageById($id)
    {
        return $this->messageRepository->find($id);
    }
}
