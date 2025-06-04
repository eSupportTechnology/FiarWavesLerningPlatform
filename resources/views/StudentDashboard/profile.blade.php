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
            <label for="id_type" class="form-label fw-semibold">Identify Document Type</label>
                <select class="form-control" name="id_type" id="id_type">
                    <option value="" >Select</option>
                    <option value="NIC" {{ old('id_type', $customer->id_type) == 'NIC' ? 'selected' : '' }}>National Identity Card (NIC)</option>
                    <option value="Passport" {{ old('id_type', $customer->id_type) == 'Passport' ? 'selected' : '' }}>Passport</option>
                    <option value="Driving License" {{ old('id_type', $customer->id_type) == 'DL' ? 'selected' : '' }}>Driving License</option>
                </select>
            @error('id_type') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3" id="id_number_container" style="display: none;">
            <label for="id_number" class="form-label fw-semibold">Document Number</label>
            <input type="text" class="form-control" id="id_number" name="id_number" value="{{ old('id_number', $customer->id_number) }}" required>
            @error('id_number') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
                <label for="fname" class="form-label fw-semibold">First Name</label>
                <input type="text" class="form-control" id="fname" name="fname" value="{{ old('fname', $customer->fname) }}" required>
                @error('fname') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6">
                <label for="lname" class="form-label fw-semibold">Last Name</label>
                <input type="text" class="form-control" id="lname" name="lname" value="{{ old('lname', $customer->lname) }}" required>
                @error('lname') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            </div>
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

        <h6 class="text-primary mb-3">Address</h6>

        <div class="mb-3">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <label for="address" class="form-label fw-semibold">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $customer->address) }}" required>
                    @error('address') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <label for="street" class="form-label fw-semibold">Street</label>
                    <input type="text" class="form-control" id="street" name="street" value="{{ old('street', $customer->street) }}" required>
                    @error('street') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

            </div>
        </div>
        <div class="mb-3">
            <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-4">
                <label for="city" class="form-label fw-semibold">City</label>
                <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $customer->city) }}" required>
                @error('city') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4">
                <label for="district" class="form-label fw-semibold">District</label>
                <input type="text" class="form-control" id="district" name="district" value="{{ old('district', $customer->district) }}" required>
                @error('district') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4">
                <label for="postal_code" class="form-label fw-semibold">Postal Code</label>
                <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ old('postal_code', $customer->postal_code) }}" required>
                @error('postal_code') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            </div>
        </div>

        <h6 class="text-primary mb-3">Bank Details</h6>

        <div class="mb-3">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <label for="bank_name" class="form-label fw-semibold">Bank Name</label>
                    <input type="text" class="form-control" id="bank_name" name="bank_name" value="{{ old('bank_name', $customer->bank_name) }}" required>
                    @error('bank_name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <label for="bank_branch" class="form-label fw-semibold">Bank Branch</label>
                    <input type="text" class="form-control" id="bank_branch" name="bank_branch" value="{{ old('bank_branch', $customer->bank_branch) }}" required>
                    @error('bank_branch') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

            </div>
        </div>
        <div class="mb-3">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <label for="account_name" class="form-label fw-semibold">Account Name</label>
                    <input type="text" class="form-control" id="account_name" name="account_name" value="{{ old('account_name', $customer->account_name) }}" required>
                    @error('account_name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <label for="account_number" class="form-label fw-semibold">Account Number</label>
                    <input type="text" class="form-control" id="account_number" name="account_number" value="{{ old('account_number', $customer->account_number) }}" required>
                    @error('account_number') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

            </div>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const idTypeSelect = document.getElementById('id_type');
        const idNumberContainer = document.getElementById('id_number_container');

        function toggleIdNumber() {
            const selected = idTypeSelect.value;
            if (selected) {
                idNumberContainer.style.display = 'block';
            } else {
                idNumberContainer.style.display = 'none';
            }
        }

        // Run on page load in case there's an old value
        toggleIdNumber();

        // Run when selection changes
        idTypeSelect.addEventListener('change', toggleIdNumber);
    });
</script>
@endsection
