<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.1/mdb.min.css" rel="stylesheet" />
    <link rel="icon" href="{{ asset('favicon..png') }}" type="image/x-icon">
    @livewireStyles
    <style>
        /* Ensure content below navbar */
        body {
            padding-top: 4.5rem;
            /* Adjust as needed based on navbar height */
        }

        /* Navbar customization */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            /* Ensure it's above other content */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* Optional: Add shadow */
        }

        /* Optional: Adjust spacing for navbar items */
        .navbar .nav-item {
            margin-left: 10px;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
        <div class="container-fluid">
            <!-- Navbar brand (Logo) -->
            <a class="navbar-brand" href="/">
                <img src="{{ asset('logo2.png') }}" height="30" alt="MDB Logo" loading="lazy" />
            </a>

            <!-- Right elements -->
            <div class="d-flex align-items-center ms-auto">
                <!-- 'ms-auto' pushes items to the right -->
                <!-- Icon -->
                <a class="text-reset me-3" href="#">
                    <i class="fas fa-shopping-cart"></i>
                </a>

                <!-- Notifications -->
                <div class="dropdown">
                    <a data-mdb-dropdown-init class="text-reset me-3 dropdown-toggle hidden-arrow" href="#"
                        id="navbarDropdownMenuLink" role="button" aria-expanded="false">
                        <i class="fas fa-bell"></i>
                        <span class="badge rounded-pill badge-notification bg-danger">1</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                        <li>
                            <a class="dropdown-item" href="#">Some news</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Another news</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </li>
                    </ul>
                </div>

                <!-- Avatar -->
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
                        <img src="{{ $avatarSrc }}" class="rounded-circle" height="25" alt="Profile Picture"
                            loading="lazy" />
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                        <li>
                            <a class="dropdown-item" href="#">My profile</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Settings</a>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Right elements -->
        </div>
    </nav>
    <!-- Navbar -->

    <main class="mt-5">
        <div class="container pt-4">
            @yield('content')
        </div>
    </main>

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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.1/mdb.umd.min.js"></script>
    @livewireScripts
</body>

</html>
