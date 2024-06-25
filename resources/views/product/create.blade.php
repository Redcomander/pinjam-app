@extends('layouts.seller-navbar')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <h3>Tambah Produk</h3>
                        </div>
                        <form id="shop" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Produk</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">Harga</label>
                                <input type="number" class="form-control" id="price" name="price">
                            </div>

                            <div class="mb-3">
                                <label for="available" class="form-label">Barang Tersedia</label>
                                <input type="number" class="form-control" id="available" name="available">
                            </div>

                            <div class="mb-3">
                                <label for="category" class="form-label">Kategori</label>
                                <select class="form-select" id="category" name="category">
                                    <option selected disabled>-- Pilih Kategory --</option>
                                    <option value="Properti">Properti</option>
                                    <option value="Pakaian">Pakaian</option>
                                    <option value="Kendaraan">Kendaraan</option>
                                    <option value="Jasa">Jasa</option>
                                    <option value="Elektronik">Elektronik</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Deskripsi Produk</label>
                                <div id="editor" style="height: 300px;"></div>
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
                            <input type="hidden" name="shop_id" value="{{ auth()->user()->shop }}">

                            <div class="mb-3 text-center">
                                <button class="btn btn-success" type="submit">Save</button>
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
