<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sipsewa Register</title>
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
            margin-top: 30px;
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

        .social-login-buttons button {
            width: 48%;
        }

        .punya-akun {
            text-align: center;
            margin-top: 5px;
            font-family: Arial, Helvetica, sans-serif;
        }

        .punya-akun a {
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

        .term {
            text-align: center;
            margin-top: 15px;
            font-family: Arial, Helvetica, sans-serif;
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
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="container-fluid login-container">
            <div class="row justify-content-center w-100">
                <div class="col-md-6 d-none d-md-flex align-items-center illustration">
                    <img src="{{ asset('login.png') }}" alt="Illustration" class="img-fluid" width="500">
                </div>
                <div class="col-md-4 col-12">
                    <div class="login-box">
                        <div class="login-header">
                            <h2>Daftar</h2>
                        </div>
                        <form class="login-form">
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Nama" name="name" id="name" placeholder="Nama Lengkap">
                            </div>
                            <div class="mb-3">
                                <input type="tel" name="phone" id="phone" class="form-control" placeholder="No. Handphone">
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control" name="email"
                                    id="email" placeholder="Email">
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" name="password"
                                    id="password" placeholder="Password" required autocomplete="new-password">
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" placeholder="Password Confirmation" required autocomplete="new-password">
                            </div>
                            <button type="submit" class="btn btn-success btn-block w-100">Berikutnya</button>
                            <hr>
                            <div class="social-login-buttons">
                                <button type="button" class="btn btn-primary"><i class="bi bi-facebook"></i></button>
                                <button type="button" class="btn btn-danger"><i class="bi bi-google"></i></button>
                            </div>
                            <div class="term">
                                Dengan mendaftar, Anda setuju dengan Syarat,
                                Ketentuan dan kebijakan dari Sipsewa & kebijakan
                                Privasi
                            </div>
                            <div class="punya-akun">
                                Punya Akun ? <a href="{{ route('login') }}">Login</a>
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
