@extends('layouts.navbar')

<title>Hasil Pencarian</title>

@section('content')
<div class="container">
    <h1 class="mb-3">Search Results for "{{ $query }}"</h1>

    @if ($products->isEmpty())
        <p>No products found matching your search criteria.</p>
    @else
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="{{ asset('storage/' . $product->image_thumbnail) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ Str::words(strip_tags($product->description), 20, '...') }}</p>
                            <p class="card-text">Price: Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                            @if($product->price_discount)
                                <p class="card-text">Discounted Price: Rp. {{ number_format($product->price_discount, 0, ',', '.') }}</p>
                            @endif
                            <div class="text-center">
                                <a href="{{ route('product.show', $product->id) }}" class="btn btn-success">View Product</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{ $products->links() }}
    @endif
</div>
@endsection
