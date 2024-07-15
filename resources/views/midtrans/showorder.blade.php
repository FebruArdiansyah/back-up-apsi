<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h2>Invoice Hans Restorans</h2>
            </div>
            <div class="card-body" id="orderDetails">
                <div class="text-center mb-4">
                    <h4 class="card-title">Thank you for your payment, <strong>{{ $order->name }}</strong>!</h4>
                    <p class="card-text">Your order details are as follows:</p>
                </div>
                <ul class="list-group mb-4">
                    <li class="list-group-item">
                        <strong>Order ID:</strong> {{ $order->id }}
                    </li>
                    <li class="list-group-item">
                        <strong>Nama Pemesan:</strong> {{ $order->name }}
                    </li>
                    <li class="list-group-item">
                        <strong>Phone:</strong> {{ $order->no_telepon }}
                    </li>
                    <li class="list-group-item">
                        <strong>Email:</strong> {{ $order->email }}
                    </li>
                    <li class="list-group-item">
                        <strong>Alamat:</strong> {{ $order->alamat }}
                    </li>
                    <li class="list-group-item">
                        <strong>Pengiriman:</strong> {{ $order->pengiriman }}
                    </li>
                    <li class="list-group-item">
                        <strong>Products:</strong><br>
                        @foreach ($order->products as $product)
                            - {{ $product->name }} (Quantity: {{ $product->pivot->quantity }})<br>
                        @endforeach
                    </li>
                    <li class="list-group-item">
                        <strong>Total Price:</strong> Rp {{ number_format($order->total, 2) }}
                    </li>
                    <li class="list-group-item">
                        <strong>Status:</strong> {{ $order->status }}
                    </li>
                </ul>
                <div class="text-center">
                    <a href="{{ url('/') }}" class="btn btn-primary">Back to Home</a>
                    <button onclick="downloadPDF()" class="btn btn-success">Download PDF</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function downloadPDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            // Capture the order details element
            const orderDetails = document.getElementById('orderDetails');

            // Format and add the content to the PDF
            doc.fromHTML(orderDetails, 10, 10, {
                'width': 180
            });

            // Save the generated PDF
            doc.save('invoice.pdf');
        }
    </script>
</body>
</html>
