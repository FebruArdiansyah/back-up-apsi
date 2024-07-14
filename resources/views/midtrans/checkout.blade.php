<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Hairnic - Single Product Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Poppins:wght@200;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="frontend/style.css" rel="stylesheet">

    <!-- Midtrans Snap JS -->
    <script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <section id="order-item">
        <div class="hj">
            <div class="order">
                <h2>Order Form</h2>
                <ul id="checkout-cart-items">
                    @php $total = 0; @endphp
                    @foreach($cart as $id => $details)
                        <li>{{ $details['name'] }} ({{ $details['quantity'] }} x {{ $details['price'] }})</li>
                        @php $total += $details['quantity'] * $details['price']; @endphp
                    @endforeach
                </ul>
                <h3>Total: Rp. <span id="checkout-total">{{ $total }}</span></h3>
                <form id="checkout-form" action="{{ route('checkout.process') }}" method="POST">
                    @csrf
                    <input type="hidden" name="total" value="{{ $total }}">
                    <input type="hidden" id="cart-input" name="cart">
                    <!-- Form fields -->
                    <div class="form-row">
                        <div class="form-left">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class="form-right">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-left">
                            <label for="phone">No Telepon</label>
                            <input type="text" id="phone" name="no_telepon" required>
                        </div>
                        <div class="form-right">
                            <label for="pengiriman">Pengiriman</label>
                            <select class="form-control select2" id="pengiriman" name="pengiriman" required>
                                <option value="">Select Pengiriman</option>
                                <option value="JNE">JNE</option>
                                <option value="SICEPAT">SICEPAT</option>
                                <option value="JNT">JNT</option>
                                <option value="DJONY_FAST">DJONY FAST</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-left">
                            <label for="alamat">Alamat</label>
                            <textarea id="alamat" name="alamat" rows="1" required></textarea>
                        </div>
                    </div>
                    <button type="button" class="btn-submit" id="submit-button">Submit Order</button>
                </form>
                

                <!-- JavaScript for AJAX submission -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
            </script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        let checkoutCartItems = document.getElementById('checkout-cart-items');
        let checkoutTotal = document.getElementById('checkout-total');
        let total = 0;

        cart.forEach(item => {
            let li = document.createElement('li');
            li.innerHTML = `${item.name} (${item.quantity} x Rp ${item.price.toLocaleString('id-ID')})`;
            checkoutCartItems.appendChild(li);
            total += item.price * item.quantity;

            let hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'cart_items[]';
            hiddenInput.value = JSON.stringify(item);
            document.getElementById('checkout-form').appendChild(hiddenInput);
        });

        checkoutTotal.innerText = total.toLocaleString('id-ID');

        document.getElementById('submit-button').addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah form refresh

            // Validasi tambahan jika diperlukan
            let form = document.getElementById('checkout-form');
            if (form.checkValidity()) {
                console.log('Form is valid'); // Debugging

                // Serialize form data
                let formData = $(form).serialize();

                $.ajax({
                    url: "{{ route('checkout.process') }}",
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        console.log('Form submitted successfully'); // Debugging
                        // Handle success, maybe redirect to order page
                    },
                    error: function(response) {
                        console.log('Form submission failed'); // Debugging
                        // Handle error
                    }
                });
            } else {
                console.log('Form is not valid'); // Debugging
                alert('Please fill out all required fields.');
            }
        });
    });
</script>

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
                });
            });
        }
    </script>
@endif

            </div>
        </div>
    </section>
</body>

</html>
