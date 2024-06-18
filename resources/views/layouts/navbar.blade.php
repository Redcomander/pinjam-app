<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.1/mdb.min.css" rel="stylesheet" />
    <style>
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
    </style>
</head>

<body>
    <header class="header">
        <div class="top-bar back-color py-1">
            <div class="container d-flex justify-content-between">
                <div class="left-links d-flex flex-wrap">
                    <a href="#" class="text-white me-3">Seller Centre</a>
                    @guest
                        <a href="{{ route('register') }}" class="text-white me-3">Daftar</a>
                        <a href="{{ route('login') }}" class="text-white me-3">Log In</a>
                    @endguest
                </div>
                <div class="right-links d-flex align-items-center">
                    <a class="text-white me-2 no-pointer">Ikuti kami di</a>
                    <a href="#" class="text-white me-2"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white me-2"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-white me-2"><i class="bi bi-twitter"></i></a>
                    @auth
                        <!-- Dropdown section -->
                        <div class="dropdown">
                            <div class="dropdown-toggle d-flex align-items-center text-white me-3" id="userDropdownMenu"
                                data-mdb-toggle="dropdown" aria-expanded="false">
                                @php
                                    $avatarUrl = Auth::user()->avatar;
                                    if (filter_var($avatarUrl, FILTER_VALIDATE_URL)) {
                                        $avatarSrc = $avatarUrl; // Full URL from socialite
                                    } else {
                                        $avatarSrc = asset('storage/' . $avatarUrl); // Path from public storage
                                    }
                                @endphp
                                <img src="{{ $avatarSrc }}" alt="Avatar" height="25" class="rounded-circle img-fit me-1" loading="lazy">
                                <span class="text-white">{{ Auth::user()->name }}</span>
                            </div>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdownMenu">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
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
                    <img src="logo.png" alt="Shopee" height="40">
                </div>
                <div class="search-bar flex-grow-1 my-2 my-md-0">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Daftar & Dapat Voucher Gratis">
                        <button class="btn btn-primary" type="button"><i class="bi bi-search"></i></button>
                    </div>
                </div>
                <div class="right-icons ms-4 my-2 my-md-0 d-flex flex-wrap">
                    <a href="#" class="text-white ms-3"><i class="bi bi-bell me-1"></i>Notifikasi</a>
                    <a href="#" class="text-white ms-3"><i class="bi bi-question-diamond me-1"></i> Bantuan</a>
                </div>
            </div>
        </div>
        <div class="nav-links back-color py-2 fs-6">
            <div class="container mt d-flex justify-content-between flex-wrap">
                <a href="#" class="text-white">HP Gratis 0 Rupiah iPhone</a>
                <a href="#" class="text-white">Rp 1 Rupiah Sepatu</a>
                <a href="#" class="text-white">Baju Kaos Pria Distro Original 100%</a>
                <a href="#" class="text-white">Set Titanium</a>
                <a href="#" class="text-white">Hodie Starboy</a>
                <a href="#" class="text-white">Kenset Bluetooth</a>
                <a href="#" class="text-white">Skintific Cushion</a>
            </div>
        </div>
    </header>

    <main class="mt-5">
        <div class="container pt-4">
            @yield('content')
        </div>
    </main>

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
