@extends('layouts.navbar')

<title>Cart</title>

@section('content')
    <div class="container mt-5 mb-5">
        <h2>Your Cart</h2>
        @if ($cartItems->isEmpty())
            <p>Your cart is empty.</p>
        @else
            <div class="table-responsive">
                <table class="table align-middle table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Duration (Days)</th>
                            <th>Total Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $grandTotal = 0;
                        @endphp
                        @foreach ($cartItems as $cartItem)
                            @php
                                $price = $cartItem->product->price;
                                $discountedPrice = $cartItem->product->price_discount;
                                $quantity = $cartItem->quantity;
                                $duration = $cartItem->duration;

                                // Calculate total price based on quantity and duration
                                $totalPrice = ($discountedPrice ? $discountedPrice : $price) * $quantity * $duration;
                                $grandTotal += $totalPrice;
                            @endphp
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $cartItem->product->image_thumbnail) }}"
                                        alt="{{ $cartItem->product->name }}" class="img-thumbnail" style="width: 100px;">
                                    {{ $cartItem->product->name }}
                                </td>
                                <td class="text-center">
                                    {{ 'Rp ' . number_format($discountedPrice ? $discountedPrice : $price, 0, ',', '.') }}
                                </td>
                                <td class="text-center">{{ $quantity }}</td>
                                <td class="text-center">{{ $duration }}</td>
                                <td class="text-center">{{ 'Rp ' . number_format($totalPrice, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <form action="{{ route('cart.remove', $cartItem->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm text-center">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" class="text-end"><strong>Grand Total</strong></td>
                            <td class="text-center"><strong>{{ 'Rp ' . number_format($grandTotal, 0, ',', '.') }}</strong>
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="text-end mt-3">
                <a href="{{ route('checkout') }}" class="btn btn-success">Checkout</a>
                <form action="{{ route('cart.clear') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">Clear Cart</button>
                </form>
            </div>
        @endif
    </div>
@endsection
