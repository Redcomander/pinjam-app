@extends('layouts.navbar')

<title>Beranda</title>

@section('content')
    <style>
        /* Adjust carousel size */
        #carouselExampleIndicators .carousel-item img {
            width: 100%;
            /* Set the width of the carousel images to 100% */
            height: auto;
            /* Ensure images scale proportionally */
            object-fit: cover;
            /* Ensure images cover the carousel area */
        }

        /* Ensure carousel container respects specified size */
        #carouselExampleIndicators {
            max-width: 100%;
            /* Set max-width to 100% */
            margin: auto;
            /* Center align carousel */
        }

        /* Style for Hot Deal and Our Category section */
        .hot-deal-section {
            background-color: #f8f9fa;
            /* Background color for section */
            padding: 50px 0;
            /* Padding top and bottom */
        }

        .hot-deal-heading {
            font-size: 24px;
            /* Heading font size */
            text-align: center;
            /* Center align text */
            margin-bottom: 30px;
            /* Bottom margin */
        }

        .card-img-top.img-fit {
            object-fit: cover;
            width: 100%;
            height: 200px;
        }

        .category-section {
            padding: 50px 0;
            /* Padding top and bottom */
        }

        .category-heading {
            font-size: 24px;
            /* Heading font size */
            text-align: center;
            /* Center align text */
            margin-bottom: 30px;
            /* Bottom margin */
        }

        .price {
            font-size: 20px;
            /* Font size for price */
            font-weight: bold;
            /* Bold font weight */
            margin-top: 10px;
            /* Top margin */
        }

        .original-price {
            text-decoration: line-through;
            /* Strikethrough for original price */
            color: #999;
            /* Light gray color */
        }

        .category-card {
            position: relative;
            overflow: hidden;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .category-card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .category-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s;
        }

        .category-card:hover img {
            transform: scale(1.1);
        }

        .overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.5);
            color: #fff;
            text-align: center;
            padding: 10px;
            font-size: 1.2em;
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

        /* Footer styles */
        footer {
            background-color: gray;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        footer a {
            color: white;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>

    <div id="carouselExampleIndicators" class="carousel slide mb-5" data-mdb-ride="carousel" data-mdb-carousel-init>
        <div class="carousel-indicators">
            <button type="button" data-mdb-target="#carouselExampleIndicators" data-mdb-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-mdb-target="#carouselExampleIndicators" data-mdb-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-mdb-target="#carouselExampleIndicators" data-mdb-slide-to="2"
                aria-label="Slide 3"></button>
            <button type="button" data-mdb-target="#carouselExampleIndicators" data-mdb-slide-to="3"
                aria-label="Slide 4"></button>
            <button type="button" data-mdb-target="#carouselExampleIndicators" data-mdb-slide-to="4"
                aria-label="Slide 5"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('carousel1.png') }}" class="d-block w-100" alt="Wild Landscape" />
            </div>
            <div class="carousel-item">
                <img src="{{ asset('carousel2.png') }}" class="d-block w-100" alt="Camera" />
            </div>
            <div class="carousel-item">
                <img src="{{ asset('carousel3.png') }}" class="d-block w-100" alt="Exotic Fruits" />
            </div>
            <div class="carousel-item">
                <img src="{{ asset('carousel4.png') }}" class="d-block w-100" alt="Exotic Fruits" />
            </div>
            <div class="carousel-item">
                <img src="{{ asset('carousel5.png') }}" class="d-block w-100" alt="Exotic Fruits" />
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-mdb-target="#carouselExampleIndicators"
            data-mdb-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-mdb-target="#carouselExampleIndicators"
            data-mdb-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Hot Deal Section -->
    <section class="hot-deal-section">
        <div class="container">
            <div class="hot-deal-heading"><strong>PENAWARAN SPECIAL</strong></div>
            <!-- Replace with your hot deal content -->
            <div class="row justify-content-center" data-aos="fade-up">
                @foreach ($hotDeals as $product)
                    <div class="col-md-4">
                        <div class="card">
                            <img src="{{ asset('storage/' . $product->image_thumbnail) }}"
                                class="card-img-top img-fluid img-fit" alt="{{ $product->name }}">
                            <div class="card-body">
                                <h5 class="card-title text-center">{{ $product->name }}</h5>
                                <div class="card-text text-center">{!! $product->description !!}</div>
                                <!-- Render HTML description -->
                                <div class="price text-center">
                                    @if ($product->price_discount)
                                        IDR {{ number_format($product->price_discount, 0, ',', '.') }}/hari
                                        @if ($product->price_discount < $product->price)
                                            <span class="original-price">IDR
                                                {{ number_format($product->price, 0, ',', '.') }}/hari</span>
                                        @endif
                                    @else
                                        IDR {{ number_format($product->price, 0, ',', '.') }}/hari
                                    @endif
                                </div>
                                <div class="text-center">
                                    {{-- Displaying shop name --}}
                                    <p class="shop-name">Merchant :
                                    </p>
                                    <p>
                                        <b>{{ $product->shop->name_shop }}</b>
                                    </p>
                                    <a href="#" class="btn btn-success mt-3">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <!-- Our Category Section -->
    <section class="category-section">
        <div class="container">
            <div class="category-heading" data-aos="fade-up"><b>KATEGORI</b></div>
            <!-- Replace with your category cards -->
            <div class="row justify-content-center category-cards" data-aos="fade-up">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="category-card">
                                <img src="https://plus.unsplash.com/premium_photo-1687960117069-567a456fe5f3?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                    alt="Property">
                                <div class="overlay">Property</div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="category-card">
                                <img src="https://images.unsplash.com/photo-1489987707025-afc232f7ea0f?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                    alt="Pakaian">
                                <div class="overlay">Pakaian</div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="category-card">
                                <img src="https://images.unsplash.com/photo-1508873535684-277a3cbcc4e8?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                    alt="Kios">
                                <div class="overlay">Peralatan</div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="category-card">
                                <img src="https://images.unsplash.com/photo-1602910344008-22f323cc1817?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                    alt="Jasa">
                                <div class="overlay">Jasa</div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="category-card">
                                <img src="https://images.unsplash.com/photo-1496171367470-9ed9a91ea931?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                    alt="Apartment">
                                <div class="overlay">Elektronik</div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="category-card">
                                <img src="https://plus.unsplash.com/premium_photo-1672252617539-878656f17efe?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                    alt="Apartment">
                                <div class="overlay">Apartment</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Initialization for ES Users
        import {
            Carousel,
            initMDB
        } from "mdb-ui-kit";

        initMDB({
            Carousel
        });
    </script>
    <script>
        AOS.init();
    </script>
@endsection
