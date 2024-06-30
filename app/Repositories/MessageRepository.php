<?php
namespace App\Repositories;

use App\Models\Message;

class MessageRepository
{
    /**
     * Get all messages between two users.
     *
     * @param int $senderId
     * @param int $receiverId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getMessagesBetween($senderId, $receiverId)
    {
        return Message::where(function ($query) use ($senderId, $receiverId) {
            $query->where('sender_id', $senderId)
                  ->where('receiver_id', $receiverId);
        })->orWhere(function ($query) use ($senderId, $receiverId) {
            $query->where('sender_id', $receiverId)
                  ->where('receiver_id', $senderId);
        })->with('sender:id,name', 'receiver:id,name')->get();
    }

    /**
     * Create a new message.
     *
     * @param array $data
     * @return Message
     */
    public function create(array $data)
    {
        return Message::create($data);
    }

    /**
     * Find a message by ID.
     *
     * @param int $id
     * @return Message
     */
    public function find($id)
    {
        return Message::with('sender:id,name', 'receiver:id,name')->find($id);
    }
}
