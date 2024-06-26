@extends('layouts.navbar')

@section('content')
    <div class="container mt-5">
        <h2>Review Cart Items</h2>
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
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $grandTotal = 0;
                        @endphp
                        @foreach ($cartItems as $cartItem)
                            @php
                                $price = $cartItem->product->price;
                                $discountedPrice = $cartItem->product->price_discount ?? $price;
                                $quantity = $cartItem->quantity;
                                $duration = $cartItem->duration;

                                // Calculate total price based on quantity and duration
                                $totalPrice = $discountedPrice * $quantity * $duration;
                                $grandTotal += $totalPrice;
                            @endphp
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $cartItem->product->image_thumbnail) }}"
                                        alt="{{ $cartItem->product->name }}" class="img-thumbnail" style="width: 100px;">
                                    {{ $cartItem->product->name }}
                                </td>
                                <td class="text-center">
                                    {{ 'Rp ' . number_format($discountedPrice, 0, ',', '.') }}
                                </td>
                                <td class="text-center">{{ $quantity }}</td>
                                <td class="text-center">{{ $duration }}</td>
                                <td class="text-center">{{ 'Rp ' . number_format($totalPrice, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" class="text-end"><strong>Grand Total</strong></td>
                            <td class="text-center"><strong>{{ 'Rp ' . number_format($grandTotal, 0, ',', '.') }}</strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="text-end mt-3">
                <form action="{{ route('cart.choosePaymentMethod') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Choose Payment Method</button>
                </form>
            </div>
        @endif
    </div>
@endsection
