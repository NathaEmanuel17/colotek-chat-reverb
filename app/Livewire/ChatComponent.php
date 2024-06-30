<?php
namespace App\Livewire;

use App\Events\MessageSendEvent;
use App\Services\MessageService;
use App\Services\UserService;
use Livewire\Attributes\On;
use Livewire\Component;

class ChatComponent extends Component
{
    public $user;
    public $users;
    public $sender_id;
    public $receiver_id;
    public $message = '';
    public $messages = [];

    protected $messageService;
    protected $userService;

    public function boot(MessageService $messageService, UserService $userService)
    {
        $this->messageService = $messageService;
        $this->userService = $userService;
    }

    public function render()
    {
        return view('livewire.chat-component');
    }

    public function mount($user_id)
    {
        $this->sender_id = auth()->user()->id;
        $this->receiver_id = $user_id;

        $messages = $this->messageService->getMessagesBetween($this->sender_id, $this->receiver_id);
        
        foreach ($messages as $message) {
            $this->chatMessage($message);
        }

        $this->user = $this->userService->getUserById($user_id);
    }

    public function sendMessage()
    {
        $data = [
            'sender_id' => $this->sender_id,
            'receiver_id' => $this->receiver_id,
            'message' => $this->message,
        ];
        $message = $this->messageService->createMessage($data);
        $this->chatMessage($message);
        broadcast(new MessageSendEvent($message))->toOthers();

        $this->message = '';
    }

    #[On('echo-private:chat-channel.{sender_id},MessageSendEvent')]
    public function listenForMessage($event)
    {
        $chatMessage = $this->messageService->findMessageById($event['message']['id']);
        $this->chatMessage($chatMessage);
    }

    public function chatMessage($message)
    {
        $this->messages[] = [
            'id' => $message->id,
            'message' => $message->message,
            'sender' => $message->sender->name,
            'receiver' => $message->receiver->name,
        ];
    }
}

