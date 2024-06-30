@extends('layouts.seller-navbar')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-body text-center">
                <h3>Order Details</h3>
                <p>Order ID: {{ $order->id }}</p>
                <p>Total Price: {{ 'Rp' . number_format($order->total_price, 0, ',', '.') }}</p>
                <p>Status: {{ ucfirst($order->status) }}</p>
                <p>Progress: {{ $order->progress }}</p>
                <p>Duration: {{ $order->duration }} days</p>
                @if ($order->progress == 'Sedang Disewa')
                    <form action="{{ route('order.complete', ['id' => $order->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">Selesaikan Pesanan</button>
                    </form>
                @elseif ($order->progress == 'Menunggu Konfirmasi')
                    <form action="{{ route('order.confirm', ['id' => $order->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Konfirmasi Pesanan</button>
                    </form>
                @elseif ($order->progress == 'Pesanan Selesai')
                    <a href="{{ route('order.index') }}" class="btn btn-success">Kembali Ke Pesanan Saya</a>
                @endif
            </div>
        </div>
    </div>
@endsection
