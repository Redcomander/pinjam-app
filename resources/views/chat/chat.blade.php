<!-- resources/views/chat/chat.blade.php -->
@extends('layouts.navbar')

@section('content')
    <style>
        body {
            background-color: #8ee68c;
        }
    </style>
    <title>Chat</title>
    <div class="container">
        <h2>Chat</h2>
        <livewire:chat-form :chatId="$chatId" />
    </div>
@endsection
