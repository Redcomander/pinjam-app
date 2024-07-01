<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('favicon..png') }}" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.1/mdb.min.css" rel="stylesheet" />
    {{-- AOS --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    @livewireStyles
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content {
            flex: 1;
        }

        .back-color {
            background: linear-gradient(to right, #09eb5c, #38d780);
        }

        .header .top-bar a,
        .header .main-bar a,
        .header .nav-links a {
            color: white;
            text-decoration: none;
        }

        .header .top-bar a:hover,
        .header .main-bar a:hover,
        .header .nav-links a:hover {
            text-decoration: underline;
        }

        .img-fit {
            object-fit: cover;
            width: 25px;
            height: 25px;
        }

        .no-pointer {
            cursor: text;
            pointer-events: none;
        }

        /* Mobile View */
        @media (max-width: 768px) {
            .header .container {
                padding: 0 15px;
            }

            .header .right-links {
                margin-right: 10%;
                flex-wrap: wrap;
                gap: 10px;
            }

            .header .right-icons {
                margin-top: 10px;
            }

            .header .main-bar .logo {
                justify-content: center;
                margin-left: 30%;
            }

            .header .main-bar .search-bar {
                flex-grow: 1;
                margin-left: 0;
                margin-right: 0;
            }

            .header .main-bar .right-icons {
                margin-left: 20%;
                margin-right: 0;
            }

            .header .nav-links {
                flex-wrap: wrap;
                justify-content: center;
            }
        }

        .footer {
            background-color: #333333;
            padding: 40px 0;
            color: #ffffff;
        }

        .footer a {
            color: #ffffff;
            text-decoration: none;
        }

        .footer a:hover {
            color: #f8f9fa;
        }

        .footer .social-icons a {
            color: #ffffff;
            margin-right: 15px;
        }

        .footer .social-icons a:hover {
            color: #f8f9fa;
        }

        .dropdown-menu-cart {
            width: 530px;
            /* Adjust width as needed */
            padding: 0;
            /* Remove default padding */
        }

        .dropdown-item {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .dropdown-item img {
            width: 50px;
            height: auto;
            margin-right: 10px;
        }

        .dropdown-item div {
            display: flex;
            flex-direction: column;
        }

        .input-group-sm .btn {
            padding: 5px 10px;
        }

        .input-group-sm .form-control {
            text-align: center;
            width: 50px;
        }

        .dropdown-footer {
            padding: 10px;
            border-top: 1px solid #ddd;
        }

        .w-100 {
            width: 50%;
        }

        .cart-dropdown-item {
            display: flex;
            align-items: center;
            padding: 10px 15px;
        }

        .cart-item-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            /* Ensures the image covers the entire area */
            margin-right: 10px;
        }

        .cart-item-details {
            flex-grow: 1;
            /* Takes up remaining space */
        }

        .cart-item-actions {
            display: flex;
            align-items: center;
            gap: 5px;
            /* Adjust as needed */
        }

        .quantity-input {
            text-align: center;
            max-width: 40px;
        }
    </style>
</head>

<body>
    <header class="header">
        <div class="top-bar back-color py-1">
            <div class="container d-flex justify-content-between">
                <div class="left-links d-flex flex-wrap">
                    @auth
                        @if (Auth::user()->seller)
                            <a href="{{ route('dashboard') }}" class="text-white me-3">Seller Centre</a>
                        @endif
                        <a href="{{ route('order.customer') }}" class="text-white me-3">Pesanan Saya</a>
                    @endauth
                    @guest
                        <a href="{{ route('register') }}" class="text-white me-3">Daftar</a>
                        <a href="{{ route('login') }}" class="text-white me-3">Log In</a>
                    @endguest
                </div>
                <div class="right-links d-lg-flex align-items-center">
                    <a class="text-white me-2 no-pointer d-none d-sm-flex">Ikuti kami di</a>
                    <a href="#" class="text-white me-2 d-none d-sm-flex"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-white me-2 d-none d-sm-flex"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white me-2 d-none d-sm-flex"><i class="fab fa-twitter"></i></a>
                    @auth
                        <!-- User Dropdown -->
                        <div class="dropdown">
                            <a data-mdb-dropdown-init class="dropdown-toggle d-flex align-items-center hidden-arrow"
                                href="#" id="navbarDropdownMenuAvatar" role="button" aria-expanded="false">
                                @php
                                    $avatarUrl = Auth::user()->avatar;
                                    if (filter_var($avatarUrl, FILTER_VALIDATE_URL)) {
                                        $avatarSrc = $avatarUrl; // Full URL from socialite
                                    } else {
                                        $avatarSrc = asset('storage/' . $avatarUrl); // Path from public storage
                                    }
                                @endphp
                                <img src="{{ $avatarSrc }}" class="rounded-circle img-fit me-1" height="25"
                                    alt="Profile Picture" loading="lazy" />
                                <span class="text-white">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end text-black"
                                aria-labelledby="navbarDropdownMenuAvatar">
                                <li>
                                    <a class="dropdown-item text-black" href="{{ route('profile.edit') }}">My profile</a>
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
        <div class="main-bar back-color py-3">
            <div class="container d-flex align-items-center flex-wrap">
                <div class="logo me-4">
                    <a href="/">
                        <img src="{{ asset('logo.png') }}" alt="" height="40">
                    </a>
                </div>
                <div class="search-bar flex-grow-1 my-2 my-md-0">
                    <form action="{{ route('products.search') }}" method="GET" class="d-flex">
                        <div class="input-group">
                            <input type="search" name="query" class="form-control" placeholder="Cari Produk disini">
                            <button class="btn btn-danger" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
                <div class="right-icons ms-sm-0 my-2 my-md-0 d-flex flex-wrap">
                    <!-- Notifications Dropdown -->
                    <div class="dropdown">
                        <a data-mdb-dropdown-init class="text-white ms-3" id="notificationsDropdown" role="button"
                            data-mdb-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-bell me-1"></i>Notifikasi
                            @if ($notifications->count() > 0)
                                <span class="badge bg-danger"
                                    id="notification-count">{{ $notifications->count() }}</span>
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationsDropdown">
                            @forelse($notifications as $notification)
                                <li class="dropdown-item notification-item" data-id="{{ $notification->id }}">
                                    {{ $notification->data['message'] }}
                                    <small
                                        class="text-muted d-block">{{ $notification->created_at->diffForHumans() }}</small>
                                </li>
                            @empty
                                <li class="dropdown-item text-center">No notifications</li>
                            @endforelse
                            <li class="dropdown-item text-center">
                                <button class="btn btn-link text-black mark-all-as-read">Mark all as read</button>
                            </li>
                        </ul>
                    </div>
                    <div class="dropdown ms-3">
                        <a data-mdb-dropdown-init href="#" class="text-white" id="cartDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-cart-shopping me-1"></i> Keranjang
                        </a>
                        <ul class="dropdown-menu dropdown-menu-cart dropdown-menu-end" aria-labelledby="cartDropdown">
                            @auth
                                @if ($cartItems->isNotEmpty())
                                    @foreach ($cartItems as $cartItem)
                                        <li class="cart-dropdown-item">
                                            <img src="{{ asset('storage/' . $cartItem->product->image_thumbnail) }}"
                                                alt="{{ $cartItem->product->name }}" class="cart-item-image">
                                            <div class="cart-item-details">
                                                <div>{{ $cartItem->product->name }}</div>
                                                <small class="text-muted">Quantity: {{ $cartItem->quantity }}</small>
                                            </div>
                                            <div class="cart-item-actions">
                                                @php
                                                    $price = $cartItem->product->price;
                                                    $discountedPrice = $cartItem->product->price_discount;
                                                    $quantity = $cartItem->quantity;
                                                    $duration = $cartItem->duration; // Assuming duration is available on $cartItem

                                                    // Calculate total price based on quantity and duration
                                                    $totalPrice =
                                                        ($discountedPrice ? $discountedPrice : $price) *
                                                        $quantity *
                                                        $duration;
                                                @endphp

                                                <span class="text-success">
                                                    Total Price ({{ $quantity }} items x {{ $duration }} days):
                                                    {{ 'Rp ' . number_format($totalPrice, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </li>
                                    @endforeach
                                    <li>
                                        <a href="{{ route('cart') }}" class="dropdown-item text-black text-center">View
                                            Cart</a>
                                    </li>
                                @else
                                    <li><a class="dropdown-item text-black text-center">Keranjang Kosong</a></li>
                                @endif
                            @endauth
                            @guest
                                <li><a class="dropdown-item text-black text-center">Keranjang Kosong</a></li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav-links back-color py-2 fs-6">
            <div class="container mt d-flex justify-content-between flex-wrap">
                <!-- Your nav links here -->
            </div>
        </div>
    </header>

    <main class="content mt-5">
        <div class="container pt-4">
            @yield('content')
        </div>
    </main>

    <footer class="footer text-center text-lg-start text-muted mt-5">
        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
            <div class="me-5 d-none d-lg-block text-white">
                <span>Get connected with us on social networks:</span>
            </div>
            <div class="social-icons text-white">
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-google"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-github"></i>
                </a>
            </div>
        </section>
        <section class="">
            <div class="container text-center text-md-start mt-5 text-white">
                <div class="row mt-3">
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                            <i class="fa-solid fa-thumbs-up me-3"></i>SIPSEWA
                        </h6>
                        <p>
                            SipSewa adalah marketplace untuk menyewa produk seperti kendaraan, pakaian, dan barang
                            elektronik, memudahkan pengguna untuk menemukan dan menyewa barang sesuai kebutuhan mereka
                            tanpa harus membeli.
                        </p>
                    </div>
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                            Kategori
                        </h6>
                        <p>
                            <a href="{{ route('product.category', ['category' => 'Kendaraan']) }}"
                                class="text-reset">Kendaraan</a>
                        </p>
                        <p>
                            <a href="{{ route('product.category', ['category' => 'Pakaian']) }}"
                                class="text-reset">Pakaian</a>
                        </p>
                        <p>
                            <a href="{{ route('product.category', ['category' => 'Property']) }}"
                                class="text-reset">Property</a>
                        </p>
                        <p>
                            <a href="{{ route('product.category', ['category' => 'Jasa']) }}"
                                class="text-reset">Jasa</a>
                        </p>
                        <p>
                            <a href="{{ route('product.category', ['category' => 'Elektronik']) }}"
                                class="text-reset">Elektronik</a>
                        </p>
                        <p>
                            <a href="{{ route('product.category', ['category' => 'Lainnya']) }}"
                                class="text-reset">Lainnya</a>
                        </p>
                    </div>
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">

                    </div>
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                            Contact
                        </h6>
                        <p><i class="fas fa-home me-3"></i> Palembang, Indonesia</p>
                        <p><i class="fas fa-envelope me-3"></i> info@sipsewa.co.id</p>
                        <p><i class="fas fa-phone me-3"></i> +62 123 456 789</p>
                        <p><i class="fas fa-print me-3"></i> +62 123 456 790</p>
                    </div>
                </div>
            </div>
        </section>
        <div class="text-center p-4 text-white" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2023 Copyright:
            <a class="text-reset fw-bold" href="">SIPSEWA.MY.ID</a>
        </div>
    </footer>

    <!-- MDB script and initialization -->
    <script>
        import {
            Dropdown,
            Collapse,
            initMDB
        } from "mdb-ui-kit";

        initMDB({
            Dropdown,
            Collapse
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.1/mdb.umd.min.js"></script>
    @livewireScripts

    <!-- JavaScript for handling notification clicks -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const notificationCountElement = document.getElementById('notification-count');

            document.querySelectorAll('.notification-item').forEach(function(notificationItem) {
                notificationItem.addEventListener('click', function() {
                    let notificationId = this.getAttribute('data-id');

                    fetch(`/notifications/mark-as-read/${notificationId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json'
                        }
                    }).then(response => response.json()).then(data => {
                        if (data.success) {
                            // Optionally remove or update the notification item
                            this.classList.add(
                                'read'); // Example: Add a class to indicate it's read
                            if (notificationCountElement) {
                                notificationCountElement.textContent = data.unreadCount;
                                if (data.unreadCount === 0) {
                                    notificationCountElement.remove();
                                }
                            }
                        }
                    }).catch(error => console.error('Error:', error));
                });
            });

            document.querySelector('.mark-all-as-read').addEventListener('click', function() {
                fetch(`/notifications/mark-all-as-read`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                }).then(response => response.json()).then(data => {
                    if (data.success) {
                        // Optionally update all notification items
                        document.querySelectorAll('.notification-item').forEach(function(
                            notificationItem) {
                            notificationItem.classList.add(
                                'read'); // Example: Add a class to indicate it's read
                        });
                        if (notificationCountElement) {
                            notificationCountElement.remove();
                        }
                    }
                }).catch(error => console.error('Error:', error));
            });
        });
    </script>
</body>

</html>
