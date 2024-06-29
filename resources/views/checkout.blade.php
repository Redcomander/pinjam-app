@extends('layouts.navbar')

<title>Payment</title>

@section('content')
    <style>
        .checkout-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 70vh;
        }

        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-success:hover {
            background-color: #218838;
            transform: translateY(-2px);
        }

        .text-center {
            animation: fadeInDown 1s;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <h2 class="text-center">Checkout</h2>
    <div class="container mt-5 checkout-container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Order Summary</h5>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Duration</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $item)
                                <tr>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ 'Rp ' . number_format($item->product->price_discount ?: $item->product->price, 2) }}</td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-center">{{ $item->duration }}</td>
                                    <td>{{ 'Rp ' . number_format(($item->product->price_discount ?: $item->product->price) * $item->quantity * $item->duration, 2) }}
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" class="text-right"><strong>Grand Total:</strong></td>
                                <td><strong>{{ 'Rp ' . number_format($order->total_price, 2) }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button class="btn btn-success btn-lg btn-block" id="pay-button">Bayar Sekarang</button>
            </div>
        </div>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            // SnapToken acquired from previous step
            snap.pay('{{ $snapToken }}', {
                // Optional callbacks
                onSuccess: function(result) {
                    // Handle success callback
                    console.log(result);
                    window.location.href = "{{ route('checkout_complete', ['orderId' => $order->id]) }}";
                },
                onPending: function(result) {
                    // Handle pending callback
                    console.log(result);
                },
                onError: function(result) {
                    // Handle error callback
                    console.log(result);
                }
            });
        };
    </script>
@endsection
