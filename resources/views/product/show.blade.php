@extends('layouts.navbar')

@section('content')
    <style>
        .product-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            /* Adds spacing between elements */
            align-items: center;
            /* Centers content horizontally */
        }

        .product-carousel {
            width: 100%;
            /* Full width on small screens */
            max-width: 1000px;
            /* Limit maximum width */
            margin-bottom: 20px;
            /* Spacing at the bottom */
        }

        .product-carousel .carousel {
            overflow: hidden;
            border-radius: 5px;
        }

        .carousel-inner {
            position: relative;
            width: 100%;
            transition: transform 0.5s ease;
            /* Updated transition to transform for smooth sliding */
        }

        .carousel-item {
            display: none;
            width: 100%;
        }

        .carousel-item.active {
            display: block;
        }

        .carousel-large-image {
            max-width: 100%;
            /* Ensure image resizes within container */
            height: auto;
            /* Maintain aspect ratio */
            display: block;
            /* Remove bottom margin issue */
            margin-bottom: 20px;
            /* Add space below image */
        }

        .carousel-thumbnails {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            /* Adds space between thumbnails */
            justify-content: center;
            /* Centers thumbnails horizontally */
        }

        .carousel-thumbnail {
            width: 80px;
            height: 80px;
            object-fit: cover;
            cursor: pointer;
            border: 2px solid transparent;
            transition: border-color 0.3s ease;
        }

        .carousel-thumbnail.active {
            border-color: #007bff;
        }

        .product-details {
            width: 100%;
            /* Full width on small screens */
            max-width: 500px;
            /* Limit maximum width */
        }

        .product-details h2 {
            margin-top: 0;
            font-size: 24px;
            /* Increase font size for readability */
        }

        .product-price-container {
            display: flex;
            flex-direction: column;
            /* Stack price and discount vertically */
            gap: 5px;
            /* Adds space between elements */
        }

        .product-price {
            font-size: 20px;
            /* Adjust font size for pricing */
            font-weight: bold;
            color: #e00202;
        }

        .product-discount {
            font-size: 18px;
            /* Adjust font size for discount */
            color: #757575;
            text-decoration: line-through;
        }

        .quantity-label,
        .duration-label {
            font-weight: bold;
            margin-top: 10px;
        }

        .quantity-input,
        .duration-input {
            width: 60px;
            text-align: center;
            padding: 5px;
            margin-top: 5px;
            margin-bottom: 10px;
        }

        .btn-add-to-cart {
            background-color: #22ff4a;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }

        @media (min-width: 768px) {
            .product-container {
                flex-direction: row;
                align-items: flex-start;
            }

            .product-carousel {
                width: 50%;
                margin-right: 20px;
            }

            .product-details {
                width: 50%;
                max-width: 400px;
                /* Adjust maximum width */
            }
        }
    </style>

    <div class="container">
        <div class="card mb-2">
            <div class="card-body product-container">
                <!-- Product Carousel -->
                <div class="product-carousel">
                    <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($images as $key => $image)
                                <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $image) }}" class="d-block carousel-large-image"
                                        alt="Product Image">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Carousel Thumbnails -->
                    <div class="carousel-thumbnails">
                        @foreach ($images as $key => $image)
                            <img src="{{ asset('storage/' . $image) }}" class="carousel-thumbnail img-fluid"
                                alt="Product Thumbnail" onclick="showImage({{ $key }})">
                        @endforeach
                    </div>
                </div>

                <!-- Product Details -->
                <div class="product-details">
                    <h2>{{ $product->name }}</h2>
                    <div class="product-price-container">
                        @if ($product->price_discount)
                            <span class="product-discount">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                            <span class="product-price">Rp{{ number_format($product->price_discount, 0, ',', '.') }}</span>
                        @else
                            <span class="product-price">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                        @endif
                    </div>

                    <label for="quantity" class="quantity-label">Kuantitas</label>
                    <input type="number" id="quantity" class="form-control quantity-input" min="1"
                        max="{{ $product->available }}" value="1">

                    <!-- Duration Input -->
                    <label for="duration" class="duration-label">Durasi (Hari)</label>
                    <input type="number" id="duration" class="form-control duration-input" min="1" value="1">

                    <button class="btn-add-to-cart">Add to Cart</button>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="product-description">
                    {!! $product->description !!}
                </div>
            </div>
        </div>
    </div>

    <script>
        // JavaScript for carousel functionality
        document.addEventListener("DOMContentLoaded", function() {
            let carouselInterval = setInterval(nextSlide, 5000); // Automatically slide every 5 seconds

            function nextSlide() {
                const activeItem = document.querySelector('.carousel-item.active');
                const nextItem = activeItem.nextElementSibling || document.querySelector(
                    '.carousel-item:first-child');
                activeItem.classList.remove('active');
                nextItem.classList.add('active');

                const activeThumbnail = document.querySelector('.carousel-thumbnail.active');
                const nextThumbnail = activeThumbnail.nextElementSibling || document.querySelector(
                    '.carousel-thumbnail:first-child');
                activeThumbnail.classList.remove('active');
                nextThumbnail.classList.add('active');
            }

            // Pause on hover
            const carousel = document.getElementById('productCarousel');
            carousel.addEventListener('mouseenter', function() {
                clearInterval(carouselInterval);
            });

            carousel.addEventListener('mouseleave', function() {
                carouselInterval = setInterval(nextSlide, 5000);
            });

            // Set document title dynamically
            document.title = '{{ $product->name }}'; // Replace with your Blade variable
        });

        // Function to handle manual thumbnail click
        function showImage(index) {
            const carouselItems = document.querySelectorAll('.carousel-item');
            const thumbnails = document.querySelectorAll('.carousel-thumbnail');

            carouselItems.forEach(item => item.classList.remove('active'));
            thumbnails.forEach(thumbnail => thumbnail.classList.remove('active'));

            carouselItems[index].classList.add('active');
            thumbnails[index].classList.add('active');
        }
    </script>
@endsection
