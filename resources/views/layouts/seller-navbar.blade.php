<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('favicon..png') }}" type="image/x-icon">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    @livewireStyles

    {{-- Quill --}}

    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">

    <style>
        body {
            background-color: #fbfbfb;
        }


        @media (min-width: 991.98px) {
            main {
                padding-left: 240px;
            }


        }

        @media (max-width: 500px) {
            #avatar {
                visibility: hidden;
            }

            #logout-btn {
                visibility: hidden;
            }
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            padding: 58px 0 0;
            /* Height of navbar */
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
            width: 240px;
            z-index: 600;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                width: 100%;
            }
        }

        /* .sidebar .active {
  border-radius: 5px;
  box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
} */

        .active {
            border-radius: 5px;
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
        }

        .sidebar-sticky {
            position: relative;
            top: 0;
            height: calc(100vh - 48px);
            padding-top: 0.5rem;
            overflow-x: hidden;
            overflow-y: auto;
            /* Scrollable contents if viewport is shorter than content. */
        }
    </style>

</head>

<body>
    <!--Main Navigation-->
    <header>

        <!-- Sidebar -->
        <nav id="navbarSupportedContent" class="collapse d-lg-block sidebar collapse bg-white">
            <div class="position-sticky">
                <div class="list-group list-group-flush mx-2 mt-5">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link list-group-item list-group-item-action py-2 ripple {{ Request::is('dashboard') ? 'active' : '' }}"
                        aria-current="true">
                        <i class="fas fa-tachometer-alt fa-fw me-2"></i><span>Main Dashboard</span>
                    </a>
                    <a href="{{ url('product') }}"
                        class="list-group-item list-group-item-action py-2 ripple {{ Request::is('product*') ? 'active' : '' }}">
                        <i class="fas fa-file-lines me-2"></i><span>Produk</span>
                    </a>
                    <a href="{{ route('order.index') }}" class="list-group-item list-group-item-action py-2 ripple {{ Request::is('order*') ? 'active' : '' }}"><i
                            class="fas fa-user me-2"></i><span>Pesanan</span></a>
                </div>
        </nav>
        <!-- Sidebar -->

        <!-- Navbar -->
        <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
            <!-- Container wrapper -->
            <div class="container-fluid">
                <!-- Toggle button -->
                <button data-mdb-collapse-init class="navbar-toggler" type="button"
                    data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Brand -->
                <a class="navbar-brand" href="{{ '/' }}">
                    <img src="{{ asset('logo2.png') }}" height="30" alt="MDB Logo" loading="lazy" />
                </a>

                <!-- Navbar links -->
                <div class="collapse navbar-collapse d-none" id="navbarSupportedContent">
                    <div id="nav-avatar" class="d-flex flex-row align-items-center ms-auto">
                        <!-- Avatar -->
                        <div id="avatar" class="d-flex flex-row align-items-center me-3">
                            @php
                                $avatarUrl = Auth::user()->avatar;
                                if (filter_var($avatarUrl, FILTER_VALIDATE_URL)) {
                                    $avatarSrc = $avatarUrl; // Full URL from socialite
                                } else {
                                    $avatarSrc = asset('storage/' . $avatarUrl); // Path from public storage
                                }
                            @endphp
                            <a href="{{ route('profile.edit') }}">
                                <img id="avatar-image" src="{{ $avatarSrc }}" class="rounded-circle me-3"
                                    height="30" loading="lazy" />
                            </a>
                            <div class="d-flex flex-column align-items-left">
                                <p class="m-0">{{ Auth::user()->name }}</p>
                            </div>
                        </div>


                        <!-- Logout button -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button id="logout-btn" class="btn btn-danger" type="submit">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
                </ul>
            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->
    </header>
    <!--Main Navigation-->

    <!--Main layout-->
    <main style="margin-top: 80px">
        <div class="container pt-4">
            @yield('content')
        </div>
    </main>
    <!--Main layout-->
    <script src="https://cdn.jsdelivr.net/npm/cropperjs@1.6.1/dist/cropper.min.js"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
    <script type="module">
        // Initialization for ES Users
        import {
            Dropdown,
            Modal,
            Input,
            Ripple,
            Collapse,
            initMDB
        } from "mdb-ui-kit";

        initMDB({
            Dropdown,
            Modal,
            Collapse,
            Input,
            Ripple
        });
    </script>
    @livewireScripts

</body>

</html>
