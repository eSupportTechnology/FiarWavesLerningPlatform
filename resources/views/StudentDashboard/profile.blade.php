@extends('StudentDashboard.master')

@section('content')
<div class="container py-4">
    <h4 class="text-primary fw-bold mb-4">My Profile</h4>

    {{-- Profile update success --}}
    @if(session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    {{-- Profile form --}}
    <form action="{{ route('customer.profile.update') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label fw-semibold">Full Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $customer->name) }}" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $customer->email) }}" required>
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label fw-semibold">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $customer->contact_number) }}">
            @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i> Save Changes
        </button>
    </form>

    {{-- Separator --}}
    <hr class="my-5">

    {{-- Password update success/error --}}
    @if(session('password_success'))
        <div class="alert alert-success"><i class="bi bi-check-circle me-2"></i> {{ session('password_success') }}</div>
    @endif

    @if(session('password_error'))
        <div class="alert alert-danger"><i class="bi bi-exclamation-circle me-2"></i> {{ session('password_error') }}</div>
    @endif

    {{-- Password update form --}}
    <h5 class="text-primary mb-3">Change Password</h5>

    <form action="{{ route('customer.password.update') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="current_password" class="form-label fw-semibold">Current Password</label>
            <input type="password" class="form-control" name="current_password" id="current_password" required>
            @error('current_password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="new_password" class="form-label fw-semibold">New Password</label>
            <input type="password" class="form-control" name="new_password" id="new_password" required>
            @error('new_password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="new_password_confirmation" class="form-label fw-semibold">Confirm New Password</label>
            <input type="password" class="form-control" name="new_password_confirmation" id="new_password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-warning">
            <i class="bi bi-shield-lock"></i> Update Password
        </button>
    </form>

</div>
@endsection
