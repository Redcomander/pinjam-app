@extends('layouts.navbar')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center">My Orders</h2>
        @if ($orders->isEmpty())
            <p class="text-center">No orders available.</p>
        @else
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ 'Rp' . number_format($order->total_price, 0, ',', '.') }}</td>
                            <td>{{ ucfirst($order->status) }}</td>
                            <td>
                                <a href="{{ route('order.show', $order->id) }}" class="btn btn-primary">View</a>
                                <a href="{{ route('chat.withOwner', $order->id) }}" class="btn btn-secondary">Chat</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $orders->links('pagination::bootstrap-5') }}
        @endif
    </div>
@endsection
