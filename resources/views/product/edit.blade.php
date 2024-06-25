@extends('layouts.seller-navbar')
<title>Edit Produk</title>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <h3>Edit Produk</h3>
                        </div>
                        <form id="shop" action="{{ route('product.update', $product->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Produk</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $product->name }}">
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">Harga</label>
                                <input type="number" class="form-control" id="price" name="price"
                                    value="{{ $product->price }}">
                            </div>

                            <div class="mb-3">
                                <label for="price_discount" class="form-label">Diskon (optional)</label>
                                <input type="number" class="form-control" id="price_discount" name="price_discount"
                                    value="{{ $product->price_discount }}">
                            </div>

                            <div class="mb-3">
                                <label for="available" class="form-label">Barang Tersedia</label>
                                <input type="number" class="form-control" id="available" name="available"
                                    value="{{ $product->available }}">
                            </div>

                            <div class="mb-3">
                                <label for="category" class="form-label">Kategori</label>
                                <select class="form-select" id="category" name="category">
                                    <option disabled>-- Pilih Kategory --</option>
                                    <option selected value="{{ $product->category }}">{{ $product->category }}</option>
                                    <option value="property">Properti</option>
                                    <option value="Pakaian">Pakaian</option>
                                    <option value="Kendaraan">Kendaraan</option>
                                    <option value="Jasa">Jasa</option>
                                    <option value="Elektronik">Elektronik</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Deskripsi Produk</label>
                                <div id="editor" style="height: 300px;">{!! $product->description !!}</div>
                                <input type="hidden" id="description" name="description">
                            </div>

                            <div class="mb-3">
                                <label for="image_thumbnail" class="form-label">Foto Thumbnail</label>
                                <input type="file" class="form-control" id="image_thumbnail" name="image_thumbnail">
                            </div>

                            <div class="mb-3">
                                <label for="images" class="form-label">Foto Produk</label>
                                <input type="file" class="form-control" id="images" name="images[]" multiple>
                            </div>

                            <!-- Use a hidden input to pass shop_id -->
                            <input type="hidden" name="shop_id" value="{{ $product->shop_id }}">

                            <div class="mb-3 text-center">
                                <button class="btn btn-success" type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var quill = new Quill('#editor', {
            theme: 'snow'
        });

        var form = document.getElementById('shop');
        form.onsubmit = function() {
            var description = document.querySelector('input[name=description]');
            description.value = quill.root.innerHTML;
        };
    </script>
@endsection
