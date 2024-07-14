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
                        <strong>Date:</strong> {{ $order->days }}
                    </li>
                    <li class="list-group-item">
                        <strong>Start Time:</strong> {{ $order->start_time }}
                    </li>
                    <li class="list-group-item">
                        <strong>End Time:</strong> {{ $order->end_time }}
                    </li>
                    <li class="list-group-item">
                        <strong>Phone:</strong> {{ $order->phone }}
                    </li>
                    <li class="list-group-item">
                        <strong>Email:</strong> {{ $order->customer_email }}
                    </li>
                    <li class="list-group-item">
                        <strong>Table:</strong> {{ $order->table->name }}
                    </li>
                    <li class="list-group-item">
                        <strong>Number of People:</strong> {{ $order->qty }}
                    </li>
                    <li class="list-group-item">
                        <strong>Total Price:</strong> Rp {{ number_format($order->total_price, 2) }}
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

    <!-- Modal -->
    <div class="modal fade" id="downloadModal" tabindex="-1" role="dialog" aria-labelledby="downloadModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="downloadModalLabel">Download Invoice</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Tolong download invoice reservasi anda, {{ $order->name }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="downloadPDF(); $('#downloadModal').modal('hide');">Download PDF</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#downloadModal').modal('show');
        });

        function downloadPDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
    
            // Header
            doc.setFontSize(22);
            doc.setTextColor(40);
            doc.text("Invoice Hans Restorans", doc.internal.pageSize.getWidth() / 2, 20, { align: "center" });
    
            // Subheader
            doc.setFontSize(16);
            doc.text(`Thank you for your payment, {{ $order->name }}!`, doc.internal.pageSize.getWidth() / 2, 35, { align: "center" });
    
            // Order Details
            doc.setFontSize(12);
            let y = 60;  // Adjusted starting point for order details
    
            const orderDetails = [
                { label: 'Order ID', value: '{{ $order->id }}' },
                { label: 'Nama Pemesan', value: '{{ $order->name }}' },
                { label: 'Date', value: '{{ $order->days }}' },
                { label: 'Start Time', value: '{{ $order->start_time }}' },
                { label: 'End Time', value: '{{ $order->end_time }}' },
                { label: 'Phone', value: '{{ $order->phone }}' },
                { label: 'Email', value: '{{ $order->customer_email }}' },
                { label: 'Table', value: '{{ $order->table->name }}' },
                { label: 'Number of People', value: '{{ $order->qty }}' },
                { label: 'Total Price', value: 'Rp {{ number_format($order->total_price, 2) }}' },
                { label: 'Status', value: '{{ $order->status }}' },
            ];
    
            orderDetails.forEach(detail => {
                doc.setFont("helvetica", "bold");
                doc.text(`${detail.label}:`, 30, y);
                doc.setFont("helvetica", "normal");
                doc.text(detail.value, 80, y);
                y += 10;
            });
    
            doc.save('Invoice-Reservasi-Hans-Restorans.pdf');
        }
    </script>
    
</body>
</html>
