@extends('layouts.navbar')

<title>Checkout Complete</title>

@section('content')
    <style>
        .thankyou-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 70vh;
            animation: fadeIn 1s;
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
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-sucess:hover {
            transform: translateY(-2px);
        }

        .text-center {
            animation: fadeInDown 1s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
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

        .card-body p {
            margin-bottom: 0.5rem;
        }

        .order-details {
            animation: slideInUp 1s;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <h2 class="text-center">Thank you for your purchase!</h2>
    <div class="container mt-2 thankyou-container">
        <div class="card">
            <div class="card-body order-details">
                <h3>Your Order ID: {{ $order->id }}</h3>
                <p>Total Price: {{ 'Rp' . number_format($order->total_price, 0, ',', '.') }}</p>
                <p>Status: {{ $order->status }}</p>
                <!-- Add more order details as needed -->
                <button class="btn btn-success btn-lg btn-block mt-4"
                    onclick="window.location.href=
                    '{{ route('order.customer', ['orderId' => $order->id]) }}'">
                    Periksa Status Pesananmu
                </button>
            </div>
        </div>
    </div>
@endsection


