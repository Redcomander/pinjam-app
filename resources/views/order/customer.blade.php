@extends('layouts.navbar')
<title>Pesanan Saya</title>
@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Pesanan Saya</h2>
        @if ($orders->isEmpty())
            <p class="text-center">Belum Ada Pesanan.</p>
        @else
            <div class="table-responsive">
                <table class="table table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">Total Price</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ 'Rp' . number_format($order->total_price, 0, ',', '.') }}</td>
                                <td>
                                    @if ($order->status == 'success')
                                        <span class="badge badge-success">Success</span>
                                    @elseif($order->status == 'pending')
                                        <span class="badge badge-warning">Pending</span>
                                    @else
                                        <span class="badge badge-secondary">{{ ucfirst($order->status) }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('order.show', $order->id) }}" class="btn btn-primary btn-sm">View</a>
                                    <a href="{{ route('chat.withOwner', $order->id) }}"
                                        class="btn btn-secondary btn-sm">Chat</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $orders->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
@endsection
