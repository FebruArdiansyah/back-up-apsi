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
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Poppins:wght@200;600;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="frontend/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="frontend/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <div class="container-fluid sticky-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light p-0">
                <a href="index.html" class="navbar-brand">
                    <h2 class="text-white">SB</h2>
                </a>
                <button type="button" class="navbar-toggler ms-auto me-0" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto">
                        <a href="#hero" class="nav-item nav-link active">Home</a>
                        <a href="#about" class="nav-item nav-link">About</a>
                        <a href="#product" class="nav-item nav-link">Products</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu bg-light mt-2">
                                <a href="#cart" class="dropdown-item">shop</a>
                                <a href="#how" class="dropdown-item">How To Use</a>
                            </div>
                        </div>
                        <!-- <a href="#order-item" class="nav-item nav-link">Order</a> -->
                    </div>
                    <a href="#cart" class="btn btn-dark py-2 px-4 d-none d-lg-inline-block custom-btn">Order Now</a>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Hero Start -->
     <section id="hero">
    <div class="container-fluid bg-primary hero-header mb-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 text-center text-lg-start">
                    <h3 class="fw-light text-white animated slideInRight">Natural & Organic</h3>
                    <h1 class="display-4 text-white animated slideInRight">Hair <span class="fw-light text-dark">Shampoo</span> Herbal For Healthy Hair</h1>
                    <!-- <p class="text-white mb-4 animated slideInRight">Lorem ipsum dolor sit amet, consectetur adipiscing
                        elit. Etiam feugiat rutrum lectus, sed auctor ex malesuada id. Orci varius natoque penatibus et
                        magnis dis parturient montes.</p> -->
                    <!-- <a href="" class="btn btn-dark py-2 px-4 me-3 animated slideInRight">Shop Now</a> -->
                    <a href="#order-item" class="btn btn-outline-dark py-2 px-4 animated slideInRight">Order Now</a>
                </div>
                <div class="col-lg-6">
                    <img class="img-fluid animated pulse infinite" src="img/bgg.png" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
    <!-- Hero End -->


    <!-- Feature Start -->
    <section id="about">
        <div class="abt">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <img class="img-fluid animated pulse infinite" src="img/bgg.png" alt="Shampoo Image 1">
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <h1 class="text-primary mb-4">Healthy Hair <span class="fw-light text-dark">Is A Symbol Of Our Beauty</span></h1>
                        <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis aliquet, erat non malesuada consequat, nibh erat tempus risus, vitae porttitor purus nisl vitae purus. Praesent tristique odio ut rutrum pellentesque. Fusce eget molestie est, at rutrum est.</p>
                        <p class="mb-4">Aliqu diam amet diam et eos labore. Clita erat ipsum et lorem et sit, sed stet no labore lorem sit. Sanctus clita duo justo et tempor.</p>
                        <!-- <a class="btn btn-primary py-2 px-4" href="">Shop Now</a> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="nrd">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4 wow fadeIn" data-wow-delay="0.1s">
                        <div class="feature-item position-relative bg-primary text-center p-3">
                            <div class="border py-5 px-3">
                                <i class="fa fa-leaf fa-3x text-dark mb-4"></i>
                                <h5 class="text-white mb-0">100% Natural</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 wow fadeIn" data-wow-delay="0.3s">
                        <div class="feature-item position-relative bg-primary text-center p-3">
                            <div class="border py-5 px-3">
                                <i class="fa fa-tint-slash fa-3x text-dark mb-4"></i>
                                <h5 class="text-white mb-0">Anti Hair Fall</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 wow fadeIn" data-wow-delay="0.5s">
                        <div class="feature-item position-relative bg-primary text-center p-3">
                            <div class="border py-5 px-3">
                                <i class="fa fa-times fa-3x text-dark mb-4"></i>
                                <h5 class="text-white mb-0">Hypoallergenic</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="best">
            <div class="container">
                <div class="mx-auto text-center wow fadeIn" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="text-primary mb-3"><span class="fw-light text-dark">Best Benefits Of Our</span> Natural Hair Shampoo</h1>
                    <!-- <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis aliquet, erat non malesuada consequat, nibh erat tempus risus.</p> -->
                </div>
                <div class="row g-4 align-items-center">
                    <div class="col-lg-4 wow fadeIn" data-wow-delay="0.3s">
                        <div class="row g-5">
                            <div class="col-12 d-flex">
                                <div class="btn-square rounded-circle border flex-shrink-0" style="width: 80px; height: 80px;">
                                    <i class="fa fa-check fa-2x text-primary"></i>
                                </div>
                                <div class="ps-3">
                                    <h5>Natural & Organic</h5>
                                    <hr class="w-25 bg-primary my-2">
                                    <span>Lorem ipsum dolor sit amet adipiscing elit aliquet.</span>
                                </div>
                            </div>
                            <div class="col-12 d-flex">
                                <div class="btn-square rounded-circle border flex-shrink-0" style="width: 80px; height: 80px;">
                                    <i class="fa fa-check fa-2x text-primary"></i>
                                </div>
                                <div class="ps-3">
                                    <h5>Anti Hair Fall</h5>
                                    <hr class="w-25 bg-primary my-2">
                                    <span>Lorem ipsum dolor sit amet adipiscing elit aliquet.</span>
                                </div>
                            </div>
                            <div class="col-12 d-flex">
                                <div class="btn-square rounded-circle border flex-shrink-0" style="width: 80px; height: 80px;">
                                    <i class="fa fa-check fa-2x text-primary"></i>
                                </div>
                                <div class="ps-3">
                                    <h5>Anti-dandruff</h5>
                                    <hr class="w-25 bg-primary my-2">
                                    <span>Lorem ipsum dolor sit amet adipiscing elit aliquet.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 wow fadeIn" data-wow-delay="0.1s">
                        <img class="img-fluid animated pulse infinite" src="img/bgg.png" alt="Shampoo Image 2">
                    </div>
                    <div class="col-lg-4 wow fadeIn" data-wow-delay="0.5s">
                        <div class="row g-5">
                            <div class="col-12 d-flex">
                                <div class="btn-square rounded-circle border flex-shrink-0" style="width: 80px; height: 80px;">
                                    <i class="fa fa-check fa-2x text-primary"></i>
                                </div>
                                <div class="ps-3">
                                    <h5>No Internal Side Effect</h5>
                                    <hr class="w-25 bg-primary my-2">
                                    <span>Lorem ipsum dolor sit amet adipiscing elit aliquet.</span>
                                </div>
                            </div>
                            <div class="col-12 d-flex">
                                <div class="btn-square rounded-circle border flex-shrink-0" style="width: 80px; height: 80px;">
                                    <i class="fa fa-check fa-2x text-primary"></i>
                                </div>
                                <div class="ps-3">
                                    <h5>No Skin Irritation</h5>
                                    <hr class="w-25 bg-primary my-2">
                                    <span>Lorem ipsum dolor sit amet adipiscing elit aliquet.</span>
                                </div>
                            </div>
                            <div class="col-12 d-flex">
                                <div class="btn-square rounded-circle border flex-shrink-0" style="width: 80px; height: 80px;">
                                    <i class="fa fa-check fa-2x text-primary"></i>
                                </div>
                                <div class="ps-3">
                                    <h5>No Artificial Smell</h5>
                                    <hr class="w-25 bg-primary my-2">
                                    <span>Lorem ipsum dolor sit amet adipiscing elit aliquet.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Feature End -->

    <div class="container-fluid py-5">
        <div class="container">
            <div class="mx-auto text-center wow fadeIn" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="text-h1"><span class="fw-light text-dark">CheckOut</span> Hair Products</h1>
            </div>
            <div class="row g-4">
                @foreach ($products as $product)
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.1s">
                    <div class="product-item text-center border h-100 p-4">
                        <img class="img-fluid mb-4" src="img/sham1.png" alt="">
                        <a href="" class="h6 d-inline-block mb-2">{{ $product->name }}</a>
                        <h5 class="text-primary mb-3">Rp {{ $product->price }}/lusin</h5>
                        {{-- <a href="cart.html" class="btn btn-outline-primary px-3 add-to-cart" data-id="1" data-name="Herbal Esences Pequi & Aguacate" data-price="700000" data-image="img/sham1.png" data-currency="Rp">Add To Cart</a> --}}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- How To Use Start -->
     <section id="how">
    <div class="container-fluid how-to-use bg-primary my-5 py-5">
        <div class="container text-white py-5">
            <div class="mx-auto text-center wow fadeIn" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="text-white mb-3"><span class="fw-light text-dark">How To Use Our</span> Natural & Organic
                    <span class="fw-light text-dark">Hair Shampoo</span></h1>
                <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis aliquet, erat non malesuada consequat, nibh erat tempus risus.</p>
            </div>
            <div class="row g-5">
                <div class="col-lg-4 text-center wow fadeIn" data-wow-delay="0.1s">
                    <div class="btn-square rounded-circle border mx-auto mb-4" style="width: 120px; height: 120px;">
                        <i class="fa fa-home fa-3x text-dark"></i>
                    </div>
                    <h5 class="text-white">Wash Hair With Water</h5>
                    <hr class="w-25 bg-light my-2 mx-auto">
                    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis aliquet, erat non malesuada consequat.</span>
                </div>
                <div class="col-lg-4 text-center wow fadeIn" data-wow-delay="0.3s">
                    <div class="btn-square rounded-circle border mx-auto mb-4" style="width: 120px; height: 120px;">
                        <i class="fa fa-home fa-3x text-dark"></i>
                    </div>
                    <h5 class="text-white">Apply Shampoo On Hair</h5>
                    <hr class="w-25 bg-light my-2 mx-auto">
                    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis aliquet, erat non malesuada consequat.</span>
                </div>
                <div class="col-lg-4 text-center wow fadeIn" data-wow-delay="0.5s">
                    <div class="btn-square rounded-circle border mx-auto mb-4" style="width: 120px; height: 120px;">
                        <i class="fa fa-home fa-3x text-dark"></i>
                    </div>
                    <h5 class="text-white">Wait 5 Mins And Wash</h5>
                    <hr class="w-25 bg-light my-2 mx-auto">
                    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis aliquet, erat non malesuada consequat.</span>
                </div>
            </div>
        </div>
    </div>
</section>
    <!-- How To Use End -->
<!-- Cart Page Start -->
<section id="cart">
    <div class="container-fluid py-5">
        <div class="container">
            <div class="mx-auto text-center wow fadeIn" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="text-primary mb-3"><span class="fw-light text-dark">CheckOut</span> Hair Products</h1>
            </div>
            <div class="row g-4">
                @php
                    $products = $products ?? [];
                @endphp
                @if (is_array($products) || is_object($products))
                    @foreach ($products as $product)
                        <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.1s">
                            <div class="product-item text-center border h-100 p-4">
                                @if ($product->image)
                                    <img src="{{ $product->image->getUrl('preview') }}">
                                @endif
                                <br>
                                <a href="#" class="h6 d-inline-block mb-2">{{ $product->name }}</a>
                                <h5 class="text-primary mb-3">Rp {{ $product->price }}/lusin</h5>
                                <a href="#" class="btn btn-outline-primary px-3 add-to-cart"
                                   data-id="{{ $product->id }}"
                                   data-name="{{ $product->name }}"
                                   data-price="{{ $product->price }}"
                                   data-image="{{ $product->image ? $product->image->getUrl('preview') : '' }}"
                                   data-currency="Rp">Add To Cart</a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 text-center">
                        <p class="text-muted">No products available</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody id="cart-items">
                        @php $total = 0 @endphp
                        @foreach (session('cart', []) as $id => $details)
                            @php $total += $details['price'] * $details['quantity'] @endphp
                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        @if (isset($details['image']))
                                            <img src="{{ $details['image'] }}" style="width: 50px; height: 50px;">
                                        @endif
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4">{{ $details['name'] }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">Rp {{ $details['price'] }}</p>
                                </td>
                                <td>
                                    <div class="input-group quantity mt-4" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-minus rounded-circle bg-light border decrease-cart" data-id="{{ $id }}">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm text-center border-0" value="{{ $details['quantity'] }}" readonly>
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-plus rounded-circle bg-light border increase-cart" data-id="{{ $id }}">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">Rp {{ $details['price'] * $details['quantity'] }}</p>
                                </td>
                                <td>
                                    <button class="btn btn-md rounded-circle bg-light border mt-4 remove-from-cart" data-id="{{ $id }}">
                                        <i class="fa fa-times text-danger"></i>
                                    </button>
                                </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row g-4 justify-content-end">
                <div class="col-8"></div>
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                    <div class="bg-light rounded">
                        <div class="p-4">
                            <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="mb-0 me-4">Subtotal:</h5>
                                <p class="mb-0" id="cart-subtotal">Rp {{ $total }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                        <h5 class="mb-0 ps-4 me-4">Total</h5>
                        <p class="mb-0 pe-4" id="cart-total">Rp {{ $total }}</p>
                    </div>
                    <form id="checkout-form" action="{{ route('checkout.index') }}" method="GET">
                        <button type="submit" class="btn-cart">Checkout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</section>




 
<!-- Cart Page End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-white footer">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.1s">
                    <a href="index.html" class="d-inline-block mb-3">
                        <h1 class="text-primary">Shampo Herbal</h1>
                    </a>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.3s">
                    <h5 class="mb-4">Get In Touch</h5>
                    <p><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                    <p><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                    <p><i class="fa fa-envelope me-3"></i>info@example.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-square btn-outline-primary me-1" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-outline-primary me-1" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-outline-primary me-1" href=""><i class="fab fa-instagram"></i></a>
                        <a class="btn btn-square btn-outline-primary me-1" href=""><i
                                class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container wow fadeIn" data-wow-delay="0.1s">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">Your Site Name</a>, All Right Reserved.

                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Designed By  Distributed by <a href="">Febru Ardiansyah Satmoko</a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

   <script>
document.addEventListener("DOMContentLoaded", function () {
    const addToCartButtons = document.querySelectorAll(".add-to-cart");
    const cartItemsContainer = document.getElementById("cart-items");
    const cartSubtotalElement = document.getElementById("cart-subtotal");
    const cartTotalElement = document.getElementById("cart-total");

    // Add event listener to each "Add To Cart" button
    addToCartButtons.forEach(button => {
        button.addEventListener("click", function (event) {
            event.preventDefault();
            const product = {
                id: this.dataset.id,
                name: this.dataset.name,
                price: parseFloat(this.dataset.price),
                image: this.dataset.image,
                currency: this.dataset.currency,
                quantity: 1
            };
            addProductToCart(product);
        });
    });

    // Function to add a product to the cart
    function addProductToCart(product) {
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        const existingProductIndex = cart.findIndex(item => item.id === product.id);

        if (existingProductIndex >= 0) {
            cart[existingProductIndex].quantity += 1;
        } else {
            cart.push(product);
        }

        localStorage.setItem("cart", JSON.stringify(cart));
        renderCartItems();
    }

    // Function to render cart items in the HTML
    function renderCartItems() {
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        let cartItemsHTML = '';
        let subtotal = 0;

        cart.forEach(item => {
            const total = item.price * item.quantity;
            subtotal += total;
            cartItemsHTML += `
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="${item.image}" style="width: 50px; height: 50px;">
                        </div>
                    </td>
                    <td><p class="mb-0 mt-4">${item.name}</p></td>
                    <td><p class="mb-0 mt-4">Rp ${item.price}</p></td>
                    <td>
                        <div class="input-group quantity mt-4" style="width: 100px;">
                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-minus rounded-circle bg-light border decrease-cart" onclick="updateQuantity('${item.id}', -1)">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control form-control-sm text-center border-0" value="${item.quantity}" readonly>
                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-plus rounded-circle bg-light border increase-cart" onclick="updateQuantity('${item.id}', 1)">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </td>
                    <td><p class="mb-0 mt-4">Rp ${total}</p></td>
                    <td>
                        <button class="btn btn-md rounded-circle bg-light border mt-4 remove-from-cart" onclick="removeFromCart('${item.id}')">
                            <i class="fa fa-times text-danger"></i>
                        </button>
                    </td>
                </tr>
            `;
        });

        cartItemsContainer.innerHTML = cartItemsHTML;
        cartSubtotalElement.innerText = `Rp ${subtotal.toFixed(2)}`;
        cartTotalElement.innerText = `Rp ${subtotal.toFixed(2)}`;
    }

    // Function to update quantity of a product in the cart
    window.updateQuantity = function (productId, change) {
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        const productIndex = cart.findIndex(item => item.id === productId);

        if (productIndex >= 0) {
            cart[productIndex].quantity += change;
            if (cart[productIndex].quantity <= 0) {
                cart.splice(productIndex, 1);
            }
        }

        localStorage.setItem("cart", JSON.stringify(cart));
        renderCartItems();
    };

    // Function to remove a product from the cart
    window.removeFromCart = function (productId) {
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        cart = cart.filter(item => item.id !== productId);
        localStorage.setItem("cart", JSON.stringify(cart));
        renderCartItems();
    };

    // Initial render of cart items on page load
    renderCartItems();
});

    function displayCartItems() {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let cartList = document.getElementById('cart-list');
    let cartTotalPrice = document.getElementById('cart-total-price');
    
    if (!cartList || !cartTotalPrice) {
        console.error('Cart list or total price element not found.');
        return;
    }

    cartList.innerHTML = ''; // Clear previous content
    let total = 0;

    if (cart.length === 0) {
        cartList.innerHTML = '<p>No items in cart</p>';
        cartTotalPrice.innerHTML = '';
    } else {
        cart.forEach(item => {
            let itemLi = document.createElement('li');
            itemLi.classList.add('cart-item');
            itemLi.innerHTML = `Product: ${item.name} | Price: Rp ${item.price.toLocaleString('id-ID')} | Quantity: ${item.quantity}`;
            cartList.appendChild(itemLi);
            
            total += item.price * item.quantity;
        });

        cartTotalPrice.innerHTML = `Total: Rp ${total.toLocaleString('id-ID')}`;
    }
}

   </script>

    <!-- Template Javascript -->
    <script src="jss/main.js"></script>
</body>

</html>