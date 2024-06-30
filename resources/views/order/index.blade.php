@extends('layouts.seller-navbar')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center">Shop Orders</h2>
        @if ($orders->isEmpty())
            <p class="text-center">No orders available.</p>
        @else
            <table class="table table-hover">
                <thead class="align-middle">
                    <tr class="text-center">
                        <th class="text-center">Order ID</th>
                        <th>Customer Name</th>
                        <th>Total Price</th>
                        <th>Status Pembayaran</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach ($orders as $order)
                        <tr>
                            <td class="text-center">{{ $order->id }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ 'Rp' . number_format($order->total_price, 0, ',', '.') }}</td>
                            <td class="text-center">
                                @if ($order->status == 'Success')
                                    <span class="badge badge-success">{{ ucfirst($order->status) }}</span>
                                @elseif ($order->status == 'pending')
                                    <span class="badge badge-warning">{{ ucfirst($order->status) }}</span>
                                @else
                                    <span class="badge badge-secondary">{{ ucfirst($order->status) }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($order->progress == 'Pesanan Selesai')
                                    <span class="badge badge-success">{{ $order->progress }}</span>
                                @elseif ($order->progress == 'Sedang Disewa')
                                    <span class="badge badge-info">{{ $order->progress }}</span>
                                @elseif ($order->progress == 'Menunggu Konfirmasi')
                                    <span class="badge badge-warning">{{ $order->progress }}</span>
                                @else
                                    <span class="badge badge-secondary">{{ ucfirst($order->progress) }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('order.show-owner', $order->id) }}" class="btn btn-primary">View</a>
                                <a href="{{ route('chat.withOwner', $order->id) }}" class="btn btn-success">Chat</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $orders->links('pagination::bootstrap-5') }}
        @endif
    </div>
@endsection

@push('scripts')
    <livewire:scripts />
@endpush
