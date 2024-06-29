@extends('layouts.navbar')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h3>Order Details</h3>
                <p>Order ID: {{ $order->id }}</p>
                <p>Total Price: {{ 'Rp' . number_format($order->total_price, 0, ',', '.') }}</p>
                <p>Status: {{ ucfirst($order->status) }}</p>
                <p>Progress: {{ $order->progress }}</p>
                <p>Duration: {{ $order->duration }} days</p>
                <a href="{{ route('order.customer') }}" class="btn btn-primary mt-3">Back to My Orders</a>
            </div>
        </div>
    </div>
@endsection
