<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Checkout</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
</head>
<body>
    <section id="order-item">
        <div class="container">
            <h2>Order Form</h2>
            <ul id="checkout-cart-items"></ul>
            <h3>Total: Rp. <span id="checkout-total"></span></h3>
            <form id="checkout-form">
                @csrf
                <div>
                    <label for="fullname">Full Name:</label>
                    <input type="text" id="fullname" name="name" required>
                </div>
                <div>
                    <label for="phone">Phone:</label>
                    <input type="text" id="phone" name="no_telepon" required>
                </div>
                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div>
                    <label for="pengiriman">Pengiriman</label>
                    <select class="form-control" id="pengiriman" name="pengiriman" required>
                        <option value="">Select Pengiriman</option>
                        <option value="JNE">JNE</option>
                        <option value="SICEPAT">SICEPAT</option>
                        <option value="JNT">JNT</option>
                    </select>
                </div>
                <div>
                    <label for="alamat">Alamat</label>
                    <textarea id="alamat" name="alamat" rows="1" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Proceed to Payment</button>
            </form>

            <div id="payment-success" style="display: none;">
                <h2>Payment Success</h2>
                <p>Thank you for your payment.</p>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cart = {!! json_encode(session('cart', [])) !!};
            let total = 0;

            for (const [key, product] of Object.entries(cart)) {
                const item = document.createElement('li');
                item.textContent = `${product.name} - Quantity: ${product.quantity} - Price: ${product.price}`;
                document.getElementById('checkout-cart-items').appendChild(item);
                total += product.quantity * product.price;
            }

            document.getElementById('checkout-total').textContent = total;

            const checkoutForm = document.getElementById('checkout-form');
            checkoutForm.addEventListener('submit', function (event) {
                event.preventDefault();

                const formData = new FormData(checkoutForm);

                fetch('/checkout/process', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.snapToken) {
                        snap.pay(data.snapToken, {
                            onSuccess: function (result) {
                                document.getElementById('payment-success').style.display = 'block';
                                checkoutForm.style.display = 'none';
                                sessionStorage.removeItem('cart');
                                window.location.href = `/order/${data.order_id}`;
                            },
                            onPending: function (result) {
                                alert('Payment Pending');
                            },
                            onError: function (result) {
                                alert('Payment Failed');
                            }
                        });
                    } else {
                        alert('Payment Failed: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        });
    </script>
</body>
</html>
