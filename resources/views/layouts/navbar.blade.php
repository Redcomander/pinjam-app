<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Your Title Here</title>
    <link rel="icon" href="{{ asset('favicon..png') }}" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.1/mdb.min.css" rel="stylesheet" />
    {{-- AOS --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        /* Your custom styles here */
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

        .btn-primary {
            background-color: #ff5f6d;
            border: none;
        }

        .btn-primary:hover {
            background-color: #ff2f45;
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
            background-color: #f1f1f1;
            padding: 20px 0;
        }

        .footer .footer-links a {
            color: #000;
            text-decoration: none;
        }

        .footer .footer-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <header class="header">
        <!-- Top bar section -->
        <div class="top-bar back-color py-1">
            <div class="container d-flex justify-content-between">
                <div class="left-links d-flex flex-wrap">
                    @auth
                        @if (Auth::user()->seller)
                            <a href="{{ route('dashboard') }}" class="text-white me-3">Seller Centre</a>
                        @endif
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
                        <!-- User dropdown section -->
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
        <!-- Main bar section -->
        <div class="main-bar back-color py-3">
            <div class="container d-flex align-items-center flex-wrap">
                <div class="logo me-4">
                    <img src="{{ asset('logo.png') }}" alt="" height="40">
                </div>
                <div class="search-bar flex-grow-1 my-2 my-md-0">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari Produk disini">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
                <div class="right-icons ms-sm-0 my-2 my-md-0 d-flex flex-wrap">
                    <a href="#" class="text-white ms-3"><i class="fas fa-bell me-1"></i>Notifikasi</a>
                    <!-- Cart dropdown section -->
                    <div class="dropdown ms-3">
                        <a data-mdb-dropdown-init class="dropdown-toggle d-flex align-items-center hidden-arrow"
                        href="#" id="CardDropdown" role="button" aria-expanded="false">
                            <i class="fas fa-cart-shopping me-1"></i> Keranjang
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end text-black"
                        aria-labelledby="CardDropdown">
                            @php
                                $cartItems = session()->get('cart');
                            @endphp
                            @if ($cartItems)
                                @foreach ($cartItems as $cartItem)
                                    <li><a class="dropdown-item" href="#">{{ $cartItem['name'] }} -
                                            {{ $cartItem['quantity'] }}</a></li>
                                @endforeach
                            @else
                                <li><a class="dropdown-item" href="#">Keranjang Kosong</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navigation links section -->
        <div class="nav-links back-color py-2 fs-6">
            <div class="container mt d-flex justify-content-between flex-wrap">
                <!-- Add your navigation links here if needed -->
            </div>
        </div>
    </header>

    <main class="mt-5">
        <div class="container pt-4">
            @yield('content')
        </div>
    </main>

    <footer class="footer mt-5">
        <div class="container text-center">
            <div class="footer-links d-flex justify-content-center mb-3">
                <a href="#" class="me-3">Tentang Kami</a>
                <a href="#" class="me-3">Kontak</a>
                <a href="#" class="me-3">Kebijakan Privasi</a>
                <a href="#">Syarat & Ketentuan</a>
            </div>
            <div class="text-muted">&copy; 2024 SipSewa. All rights reserved.</div>
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
</body>

</html>
