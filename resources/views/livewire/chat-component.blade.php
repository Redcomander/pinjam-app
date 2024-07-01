<div>
    <div id="chat-messages" class="chat-container mb-5" wire:poll.200ms="refreshMessages">
        @foreach ($messages as $message)
            <div class="chat-bubble {{ $message->user_id === Auth::id() ? 'user' : 'other' }} mb-3">
                <div><strong>{{ $message->user->name }}</strong></div>
                <div>{{ $message->message }}</div>
                <div class="text-grey text-right mt-1">{{ $message->created_at->format('H:i') }}</div>
            </div>
        @endforeach
    </div>
    <div class="input-group mt-3">
        <form wire:submit.prevent="sendMessage" class="w-100">
            <div class="input-group">
                <input wire:model="message" type="text" class="form-control" placeholder="Type your message here...">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-success">Send</button>
                </div>
            </div>
        </form>
    </div>
</div>
