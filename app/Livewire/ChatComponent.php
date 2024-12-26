<?php

namespace App\Livewire;

use App\Events\MessageEvent;
use App\Models\Message;
use Illuminate\Support\Facades\Auth ;
use Livewire\Attributes\On;
use Livewire\Component;

class ChatComponent extends Component
{
    public $message;
    public $convo = [];

    public function mount() {
        $messages = Message::all();
        $this->convo = [];
    
        foreach ($messages as $message) {
            $this->convo[] = [
                'username' => $message->user->name,
                'message' => $message->message
            ];
        }
    }

    public function submitMessage() {
        $user = Auth::user();
        MessageEvent::dispatch($user->id, $this->message);
        $this->message = "";
    }
    
    #[On('echo:our-channel,MessageEvent')]
    public function listenerForMessage($data) {
        $this->convo[] = [
            'username' => $data['username'],
            'message' => $data['message']
        ];
    }

    public function render()
    {
        return view('livewire.chat-component');
    }
}
