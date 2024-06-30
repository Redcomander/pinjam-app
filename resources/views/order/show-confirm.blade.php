@extends('layouts.seller-navbar')

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
                <p id="countdown">
                    @if ($order->progress == 'Sedang Disewa' && $order->countdown_end_date)
                        <script>
                            var countdownEndDate = "{{ $order->countdown_end_date }}";
                            startCountdown(countdownEndDate);
                        </script>
                    @elseif ($order->progress == 'Pesanan Selesai')
                        Pesanan sudah selesai.
                    @endif
                </p>
                @if ($order->progress == 'Menunggu Confirmasi')
                    <button id="confirmOrderBtn" class="btn btn-primary mt-3">Konfirmasi Pesanan untuk Memulai Hitung Mundur
                        Pesanan</button>
                @elseif ($order->progress == 'Sedang Disewa')
                    <button id="completeOrderBtn" class="btn btn-success mt-3">Selesaikan Pesanan</button>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var confirmOrderBtn = document.getElementById('confirmOrderBtn');
            var completeOrderBtn = document.getElementById('completeOrderBtn');

            if (confirmOrderBtn) {
                confirmOrderBtn.addEventListener('click', function() {
                    // Disable the button to prevent multiple clicks
                    confirmOrderBtn.disabled = true;

                    // AJAX request to confirm order
                    fetch("{{ route('order.confirm', $order->id) }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            // Handle response
                            console.log(data);
                            if (data.message) {
                                alert(data.message);
                                // Start countdown
                                startCountdown(data.countdownEndDate);
                                // Store countdownEndDate in local storage or on the server
                                localStorage.setItem('countdownEndDate', data.countdownEndDate);
                                // Hide confirmOrderBtn and show completeOrderBtn
                                confirmOrderBtn.style.display = 'none';
                                completeOrderBtn.style.display = 'inline-block';
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                });
            }

            function startCountdown(endDate) {
                var countDownDate = new Date(endDate).getTime();

                var x = setInterval(function() {
                    var now = new Date().getTime();
                    var distance = countDownDate - now;

                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    // Display the result in the element with id="countdown"
                    var countdownElement = document.getElementById("countdown");
                    if (countdownElement) {
                        countdownElement.style.display = 'block'; // Show the countdown element
                        countdownElement.innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds +
                            "s ";

                        // If the countdown is finished, update message
                        if (distance < 0) {
                            clearInterval(x);
                            countdownElement.innerHTML = "EXPIRED";
                            // Hide countdown element
                            countdownElement.style.display = 'none';
                            // Show completeOrderBtn
                            completeOrderBtn.style.display = 'inline-block';
                        }
                    } else {
                        console.error('Countdown element not found.');
                    }
                }, 1000);
            }
        });
    </script>
@endsection
