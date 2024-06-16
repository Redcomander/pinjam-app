@extends('layouts.navbar2')
@section('content')
    <title>Change Password</title>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Change Password</h5>
                        {{-- Display errors if any --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {{-- Display success message if password updated --}}
                        @if (session('status') === 'password-updated')
                            <div class="alert alert-success">
                                Password updated successfully.
                            </div>
                        @endif
                        {{-- Display error message if password update failed --}}
                        @if (session('status') === 'password-not-updated')
                            <div class="alert alert-danger">
                                Failed to update password. Please check your current password and try again.
                            </div>
                        @endif
                        <form action="{{ route('password.update') }}" method="POST" id="changePasswordForm">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Current Password</label>
                                <input type="password" class="form-control" id="update_password_current_password"
                                    name="current_password" required autocomplete="current-password">
                                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                            </div>
                            <div class="mb-3">
                                <label for="new_password" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="update_password_password" name="password"
                                    required autocomplete="new-password">
                                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                            </div>
                            <div class="mb-3">
                                <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" id="update_password_password_confirmation"
                                    name="password_confirmation" required autocomplete="new-password">
                                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                            </div>
                            <div class="mb-3 text-center">
                                <button type="submit" class="btn btn-success" id="changePasswordBtn" disabled>Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Enable/disable the button based on form validity
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('changePasswordForm');
            const submitBtn = document.getElementById('changePasswordBtn');

            form.addEventListener('input', function () {
                submitBtn.disabled = !form.checkValidity();
            });
        });
    </script>
@endsection
