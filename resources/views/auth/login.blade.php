<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sipsewa Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #8ee68c;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 70vh;
        }

        .login-box {
            background-color: white;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .login-header h2 {
            margin: 0;
            font-size: 24px;
            color: #000000;
        }

        .login-header a {
            color: #8ee68c;
            text-decoration: none;
        }

        .login-form input {
            margin-bottom: 15px;
        }

        .login-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .login-options a {
            font-family: sans-serif;
            text-decoration: none;
        }

        .social-login-buttons {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .social-login-buttons a {
            width: 48%;
        }

        .new-user {
            text-align: center;
            margin-top: 15px;
        }

        .new-user a {
            color: #4caf50;
            text-decoration: none;
        }

        .illustration {
            text-align: center;
        }

        .illustration img {
            max-width: 100%;
            height: auto;
        }

        .logo {
            font-size: 2.5rem;
            margin-left: 3rem;
            color: #8ee68c;
        }

        #sipesewa-font {
            font-family: fantasy;
            color: #8ee68c;
        }

        @media (max-width: 992px) {
            .logo {
                margin-left: 0;
            }

        }
    </style>
</head>

<body>
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom bg-white">
        <a href="/"
            class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <div class="logo">
                <i class="bi bi-hand-thumbs-up"></i>
            </div>
            <span id="sipesewa-font" class="fs-2 ms-2">SipSewa</span>
        </a>
        <ul class="nav nav-pills d-none d-md-flex">
            <li class="nav-item"><a href="#" class="nav-link text-success">Butuh Bantuan ?</a></li>
        </ul>
    </header>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="container-fluid login-container">
            <div class="row justify-content-center w-100">
                <div class="col-md-6 d-none d-md-flex align-items-center illustration">
                    <img src="{{ asset('login.png') }}" alt="Illustration" class="img-fluid" width="500">
                </div>
                <div class="col-md-4 col-12">
                    <div class="login-box">
                        <div class="login-header">
                            <h2>Login</h2>
                        </div>
                        <form class="login-form">
                            <div class="mb-3">
                                <input type="text" id="email" name="email" class="form-control"
                                    placeholder="No. Handphone/Username/Email">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" type="password" name="password"
                                    id="password" placeholder="Password">
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                            <button type="submit" class="btn btn-success btn-block w-100">LOG IN</button>
                            <div class="login-options mt-3">
                                <a href="{{ route('password.request') }}" class="text-success">Lupa Password</a>
                                <a href="#" class="text-success">Log in dengan no.handphone</a>
                            </div>
                            <hr>
                            <div class="social-login-buttons">
                                <a href="{{ route('login.redirect', 'facebook') }}" class="btn btn-primary"><i class="bi bi-facebook"></i></a>
                                <a href="{{ route('login.redirect', 'google') }}" class="btn btn-danger"><i class="bi bi-google"></i></a>
                            </div>
                            <div class="new-user">
                                Baru di Sipsewa ? <a href="{{ route('register') }}">Daftar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
