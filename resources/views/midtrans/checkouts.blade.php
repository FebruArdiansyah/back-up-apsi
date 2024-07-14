<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @if(isset($snapToken))
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    @endif
    <title>Restaurant Reservation Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        .card-body {
            padding: 20px;
        }
        .card-title {
            margin-bottom: 20px;
            font-size: 1.5rem;
        }
        table {
            width: 100%;
        }
        table td {
            padding: 8px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="my-3 text-center">Restaurant Reservation Checkout</h1>
        <div class="card mx-auto" style="width: 24rem;">
            <div class="card-body">
                <h5 class="card-title">Reservation Details</h5>
                <table class="table table-borderless">
                    <tr>
                        <td><strong>Name</strong></td>
                        <td> : {{ $order->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Phone</strong></td>
                        <td> : {{ $order->phone }}</td>
                    </tr>
                    <tr>
                        <td><strong>Number of People</strong></td>
                        <td> : {{ $order->qty }}</td>
                    </tr>
                    <tr>
                        <td><strong>Table Number</strong></td>
                        <td> : {{ $order->table_number }}</td>
                    </tr>
                    <tr>
                        <td><strong>Total Price</strong></td>
                        <td> : Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Status</strong></td>
                        <td> : {{ $order->status }}</td>
                    </tr>
                </table>
                @if($order->status == 'Unpaid' && isset($snapToken))
                <button id="pay-button" class="btn btn-primary w-100 mt-3">Pay Now</button>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    @if(isset($snapToken))
    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        if (payButton) {
            payButton.addEventListener('click', function() {
                window.snap.pay('{{ $snapToken }}', {
                    onSuccess: function(result) {
                        alert("Payment successful!");
                        console.log(result);
                        window.location.href = "{{ route('order.show', ['id' => $order->id]) }}";
                    },
                    onPending: function(result) {
                        alert("Waiting for your payment!");
                        console.log(result);
                    },
                    onError: function(result) {
                        alert("Payment failed!");
                        console.log(result);
                    },
                    onClose: function() {
                        alert('You closed the popup without finishing the payment');
                    }
                })
            });
        }
    </script>
    @endif
</body>
</html>
