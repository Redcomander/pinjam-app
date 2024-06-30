@extends('layouts.navbar')

<title>Order Detail</title>

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-body text-center">
                <h3 class="card-title">Order Details</h3>
                <hr>
                <p class="card-text"><strong>Order ID:</strong> {{ $order->id }}</p>
                <p class="card-text"><strong>Total Price:</strong>
                    {{ 'Rp' . number_format($order->total_price, 0, ',', '.') }}</p>
                <p class="card-text"><strong>Status:</strong>
                    @if ($order->status == 'success')
                        <span class="badge badge-success">Success</span>
                    @elseif($order->status == 'pending')
                        <span class="badge badge-warning">Pending</span>
                    @else
                        <span class="badge badge-secondary">{{ ucfirst($order->status) }}</span>
                    @endif
                </p>
                <p class="card-text"><strong>Progress:</strong> {{ $order->progress }}</p>
                <p class="card-text"><strong>Duration:</strong> {{ $order->duration }} days</p>
                <a href="{{ route('order.customer') }}" class="btn btn-primary mt-3">Back to My Orders</a>
            </div>
        </div>
    </div>
@endsection
