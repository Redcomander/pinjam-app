@extends('layouts.navbar')

@section('content')
    <div class="container mt-5">
        <h2>Checkout</h2>
        <button id="pay-button">Pay!</button>
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
