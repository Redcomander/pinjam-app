<?php

namespace App\Livewire;

use App\Events\MessageSent;
use App\Models\Order;
use App\Models\ChatMessage;
use App\Notifications\NewMessageNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class ChatComponent extends Component
{
    public $order;
    public $message = '';
    public $messages = [];

    public function mount(Order $order)
    {
        $this->order = $order;
    }

    public function render()
    {
        if (!$this->order) {
            return '';
        }

        $messages = ChatMessage::where('order_id', $this->order->id)
            ->latest()
            ->get();

        return view('livewire.chat-component', [
            'messages' => $messages,
        ]);
    }

    public function sendMessage()
    {
        $newMessage = ChatMessage::create([
            'user_id' => Auth::id(),
            'order_id' => $this->order->id,
            'message' => $this->message,
        ]);

        // Send notification to relevant users
        $user = Auth::user();
        $notificationMessage = "{$user->name} sent a new message: {$this->message}";
        Notification::send($this->order->user, new NewMessageNotification($notificationMessage));

        $this->message = ''; // Clear the input field after sending

        $this->refreshMessages();
    }

    public function refreshMessages()
    {
        $this->messages = ChatMessage::where('order_id', $this->order->id)
            ->latest()
            ->get();
    }


    public function initiateChat($customerId)
    {
        $this->order = Order::where('user_id', $customerId)->first();

        if (!$this->order) {
            // Handle case where order is not found
            return;
        }
    }
}
