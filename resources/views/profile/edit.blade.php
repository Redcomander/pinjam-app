<!-- resources/views/profile/profilecustomer.blade.php -->

@extends('layouts.navbar2')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form id="profileForm" action="{{ route('profile.update') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="profile-picture mb-4 text-center">
                                <img id="avatarImage" src="{{ $user->avatar }}" class="rounded-circle" alt="Profile Picture"
                                    width="150" height="150" style="cursor: pointer;">
                                <input type="file" class="form-control d-none" id="avatar" name="avatar"
                                    accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $user->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ $user->email }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    value="#" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="{{ $user->phone }}" required>
                            </div>
                            <div class="mb-3 text-center">
                                <a href="{{ route('changepassword') }}" class="btn btn-primary mb-3">Change Password</a>
                            </div>
                            <div class="mb-3 text-center">
                                <a href="#" class="btn btn-warning mb-3">Become Seller/Lender</a>
                            </div>
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
        document.getElementById('avatarImage').addEventListener('click', function() {
            document.getElementById('avatar').click();
        });

        document.getElementById('avatar').addEventListener('change', function(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                document.getElementById('avatarImage').src = src;
            }
        });
    </script>
@endsection
