@extends('layouts.seller-navbar')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4 text-center">List of Products</h2>
        {{-- Alert for empty product list --}}
        @if ($products->isEmpty())
            <div class="alert alert-warning" role="alert">
                Kamu tidak memiliki Produk
            </div>
        @else
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="row g-0">
                                <div class="col-md-5 d-flex align-items-center justify-content-center">
                                    <div class="square-container">
                                        <img src="{{ asset('storage/' . $product->image_thumbnail) }}"
                                            class="img-thumbnail rounded img-fluid" alt="{{ $product->name }}">
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $product->name }}</h5>
                                        <p class="card-text">Harga/hari: {{ $product->price }} IDR</p>
                                        @if ($product->price_discount)
                                            <p class="card-text text-danger">Discount: {{ $product->price_discount }} IDR
                                            </p>
                                        @endif
                                        <p class="card-text">Unit Tersedia: {{ $product->available }}</p>
                                    </div>
                                    <div class="card-footer">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div class="btn-group gap-3">
                                                <a href="{{ url('product/' . $product->id . '/edit') }}"
                                                    class="rounded btn btn-sm btn-outline-success btn-edit">
                                                    <i class="bi bi-pencil"></i> Edit
                                                </a>
                                                <form action="{{ url('product/' . $product->id) }}" method="POST"
                                                    class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger btn-delete">
                                                        <i class="bi bi-trash"></i> Remove
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Alert for product successfully removed --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="text-center mt-4 mb-5">
            <a href="{{ url('product/create') }}" class="btn btn-primary">Add Product</a>
        </div>

        <div class="d-flex justify-content-center">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <style>
        .square-container {
            position: relative;
            width: 200px;
            /* Adjust as needed */
            height: 200px;
            /* Adjust as needed */
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .square-container img {
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            object-fit: cover;
        }

        .btn-delete {
            transition: color 0.5s;
        }

        .btn-delete:hover {
            background: #DC4C64;
            color: white;
            border-color: #DC4C64;
        }

        .btn-edit {
            transition: color 0.5s;
        }

        .btn-edit:hover {
            background: green;
            color: white;
            border-color: green;
        }
    </style>

    <script>
        // Script to handle delete confirmation with native alert
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('.delete-form');

            deleteForms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    const confirmation = confirm('Are you sure you want to delete this product?');
                    if (confirmation) {
                        this.submit();
                    }
                });
            });
        });
    </script>
@endsection
