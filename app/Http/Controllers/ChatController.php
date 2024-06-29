<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $messages = Chatmessage::with('user')->get();
        return view('chat.index', compact('messages'));
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'message' => 'required|string',
        ]);

        $chatMessage = ChatMessage::create([
            'user_id' => Auth::id(),
            'order_id' => $request->order_id,
            'message' => $request->message,
        ]);

        // Broadcast event using Laravel Echo or Pusher
        broadcast(new MessageSent($chatMessage));

        return response()->json(['status' => 'Message sent!']);
    }

    public function loadMessages(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
        ]);

        $messages = ChatMessage::where('order_id', $request->order_id)
            ->with('user')
            ->get();

        return response()->json(['messages' => $messages]);
    }

    public function chatWithOwner(Order $order)
    {
        // Assuming $order is retrieved correctly, and you want to pass its ID to the view
        $orderId = $order->id;
        return view('chat.with-owner', compact('order'));
    }
}
