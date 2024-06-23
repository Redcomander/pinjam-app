@extends('layouts.navbar2')

@section('content')
    <style>
        body {
            background-color: #8ee68c;
        }
    </style>
    <title>Profile</title>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form id="profileForm" action="{{ route('profile.update') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="profile-picture mb-4 text-center">
                                @php
                                    $avatarUrl = $user->avatar
                                        ? (strpos($user->avatar, 'http') === 0
                                            ? $user->avatar
                                            : asset('storage/' . $user->avatar))
                                        : 'default-avatar-url';
                                @endphp
                                <img id="avatarImage" src="{{ $avatarUrl }}" class="rounded-circle" alt="Profile Picture"
                                    width="150" height="150" style="cursor: pointer;">
                                <input type="file" class="form-control d-none" id="avatar" name="avatar"
                                    accept="image/*">
                            </div>
                            <div class="mb-3">
                                @if (session('status') === 'profile-updated')
                                    <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                        class="alert alert-success text-sm text-gray-600 dark:text-gray-400 d-flex align-items-center">
                                        <i class="fas fa-check-circle me-2"></i> {{ __('Saved.') }}
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name', $user->name) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', $user->email) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    value="{{ old('address', $user->address) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="{{ old('phone', $user->phone) }}" required>
                            </div>
                            <div class="mb-3 text-center">
                                <a href="{{ route('changepassword') }}" class="btn btn-primary mb-3">Change Password</a>
                            </div>
                            <div class="mb-3 text-center">
                                @if ($user->seller)
                                    <a href="{{ route('dashboard') }}" class="btn btn-success mb-3">Seller Center</a>
                                @else
                                    <a href="#" class="btn btn-warning mb-3" id="becomeSellerBtn">Become
                                        Seller/Lender</a>
                                @endif
                            </div>
                            <div class="mb-3 text-center">
                                <button class="btn btn-success" type="submit">Save</button>
                            </div>
                        </form>
                        <form id="becomeSellerForm" action="{{ route('become-seller') }}" method="POST" class="d-none">
                            @csrf
                            @method('PATCH')
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

        document.getElementById('becomeSellerBtn').addEventListener('click', function(event) {
            event.preventDefault();
            if (confirm('Are you sure you want to become a seller?')) {
                document.getElementById('becomeSellerForm').submit();
            }
        });
    </script>
@endsection
