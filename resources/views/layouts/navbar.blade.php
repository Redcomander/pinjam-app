<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
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
            /* Set the width to the desired size */
            height: 25px;
            /* Set the height to the desired size */
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
                    <a href="#" class="text-white me-2">Ikuti kami di</a>
                    <a href="#" class="text-white me-2"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white me-2"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-white me-2"><i class="bi bi-twitter"></i></a>
                    @auth
                        <div class="d-flex align-items-center me-3">
                            <img src="{{ Auth::user()->avatar }}" alt="Avatar" height="25"
                                class="rounded-circle img-fit" loading="lazy">
                            <span class="text-white ms-2">{{ Auth::user()->name }}</span>
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
                <a href="#" class="text-white ">HP Gratis 0 Rupiah iPhone</a>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
