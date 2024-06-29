<!-- resources/views/chat/index.blade.php -->
@extends('layouts.navbar')

@section('content')
    <style>
        body {
            background-color: #8ee68c;
        }
        
    </style>
    <title>Chats</title>
    <div class="container">
        <h2>Chats</h2>
        <livewire:chat-index />
    </div>
@endsection
