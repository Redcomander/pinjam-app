@extends('layouts.navbar')

<title></title>

@section('content')
    <style>
        .chat-container {
            display: flex;
            flex-direction: column-reverse;
            /* Display the newest messages at the bottom */
            height: 300px;
            overflow-y: scroll;
            padding: 10px;
        }

        .chat-bubble {
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 5px;
            max-width: 70%;
            display: inline-block;
        }

        .chat-bubble.user {
            background-color: #03941e;
            color: white;
            align-self: flex-end;
            text-align: right;
        }

        .chat-bubble.other {
            background-color: #e5e5ea;
            color: black;
            align-self: flex-start;
            text-align: left;
        }

        .input-group {
            margin-top: 10px;
        }

    </style>

    <div class="container mt-5">
        <h2 class="text-center">Chat with Shop Owner for Order ID: {{ $order->id }}</h2>
        @if ($order)
            <div class="card">
                <div class="card-body">
                    @livewire('chat-component', ['order' => $order])
                </div>
            </div>
        @else
            <p>Order not found.</p>
        @endif
    </div>
    <script>
        document.title = "Chat - Order ID: {{ $order->id }}";
        document.addEventListener('livewire:load', function() {
            Livewire.hook('message.processed', (message, component) => {
                var chatMessages = document.getElementById('chat-messages');
                chatMessages.scrollTop = chatMessages.scrollHeight;
            });
        });
    </script>
@endsection

@push('scripts')
    <livewire:scripts />
@endpush
