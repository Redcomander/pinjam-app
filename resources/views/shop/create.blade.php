@extends('layouts.navbar2')

@section('content')
    <title>Shop Information</title>

    <style>
        body {
            background-color: #8ee68c;
        }
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <h1>Informasi Toko</h1>
                        </div>
                        <form id="shop" action="{{ url('shop') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name_shop" class="form-label">Nama Toko</label>
                                <input type="text" class="form-control" id="name_shop" name="name_shop">
                            </div>

                            <livewire:api-daerah />

                            <div class="mb-3">
                                <label for="address" class="form-label">Alamat Lengkap</label>
                                <textarea name="address" class="form-control mb-3"  rows="5" placeholder="Masukan Alamat Lengkap"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Nomor Handphone</label>
                                <input type="tel" class="form-control" id="phone" name="phone">
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Deskripsi Toko</label>
                                <textarea name="description" class="form-control mb-3"  rows="5" placeholder="Masukan Deskripsi di sini"></textarea>
                            </div>

                            <div class="mb-3 text-center">
                                <button class="btn btn-success" type="submit">Save</button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
