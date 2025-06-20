@extends('StudentDashboard.master')

@section('content')
    <div class="container py-4">
        <div class="card mb-4">
            <div class="card-header bg-light">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <h4 class="text-primary fw-bold mb-0">My Profile</h4>

                    <!-- Status Bulbs -->
                    <div class="d-flex align-items-center gap-3">
                        <!-- Account Status Bulb -->
                        <span tabindex="0" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="{{ $customer->status == 1 ? 'Account is active and in good standing.' : 'Account is inactive. Please contact support.' }}">
                            <span
                                style="display:inline-block;width:18px;height:18px;border-radius:50%;background:{{ $customer->status == 1 ? '#28a745' : '#dc3545' }};border:2px solid #ccc;vertical-align:middle;"></span>
                            <small class="ms-1" style="color: black">Account</small>
                        </span>

                        <!-- KYC Status Bulb -->
                        <span tabindex="0" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="{{ $customer->kyc_status === 'approved' ? 'KYC is approved. Your identity is verified.' : 'KYC is not approved. Please submit or update your KYC details.' }}">
                            <span
                                style="display:inline-block;width:18px;height:18px;border-radius:50%;background:{{ $customer->kyc_status === 'approved' ? '#28a745' : '#dc3545' }};border:2px solid #ccc;vertical-align:middle;"></span>
                            <small class="ms-1" style="color: black">KYC</small>
                        </span>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                        tooltipTriggerList.forEach(function(tooltipTriggerEl) {
                            new bootstrap.Tooltip(tooltipTriggerEl)
                        })
                    });
                </script>
            </div>

            <div class="card-body">

                {{-- Profile update success --}}
                @if (session('success'))
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                    </div>
                @endif

                <div class="mb-4">
                    <div class="row align-items-center">
                        <div class="col-md-6 mb-2">
                            <label class="form-label fw-semibold mb-1">Email</label>
                            <div class="d-flex align-items-center gap-2">
                                <span>{{ $customer->email }}</span>
                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#editEmailModal">
                                    <i class="bi bi-pencil"></i> Edit
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label fw-semibold mb-1">Phone</label>
                            <div class="d-flex align-items-center gap-2">
                                <span>{{ $customer->contact_number }}</span>
                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#editPhoneModal">
                                    <i class="bi bi-pencil"></i> Edit
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Email Edit Modal -->
                <div class="modal fade" id="editEmailModal" tabindex="-1" aria-labelledby="editEmailModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('customer.email.update') }}" method="POST">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editEmailModalLabel">Edit Email</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="new_email" class="form-label">New Email</label>
                                        <input type="email" class="form-control" id="new_email" name="new_email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email_verification_code" class="form-label">Verification Code</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="email_verification_code"
                                                name="email_verification_code" placeholder="Enter code" required>
                                            <button type="button" class="btn btn-outline-secondary"
                                                id="sendEmailCodeBtn">Send Code</button>
                                        </div>
                                        <small class="text-muted">A code will be sent to your new email address.</small>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Verify & Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Phone Edit Modal -->
                <div class="modal fade" id="editPhoneModal" tabindex="-1" aria-labelledby="editPhoneModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('customer.phone.update') }}" method="POST">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editPhoneModalLabel">Edit Phone Number</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="new_phone" class="form-label">New Phone Number</label>
                                        <input type="text" class="form-control" id="new_phone" name="new_phone"
                                            required placeholder="070XXXXXXXX">
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone_verification_code" class="form-label">Verification Code</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="phone_verification_code"
                                                name="phone_verification_code" placeholder="Enter code" required>
                                            <button type="button" class="btn btn-outline-secondary"
                                                id="sendPhoneCodeBtn">Send Code</button>
                                        </div>
                                        <small class="text-muted">A code will be sent to your new phone number.</small>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Verify & Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const sendBtn = document.getElementById('sendEmailCodeBtn');

                        if (sendBtn) {
                            sendBtn.addEventListener('click', function() {
                                const newEmail = document.getElementById('new_email').value;
                                if (!newEmail) {
                                    alert('Please enter a new email address first.');
                                    return;
                                }

                                fetch("{{ route('customer.email.sendCode') }}", {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                        body: JSON.stringify({
                                            email: newEmail
                                        })
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            alert('Verification code sent to your new email.');
                                        } else {
                                            alert(data.message || 'Failed to send verification code.');
                                        }
                                    })
                                    .catch(error => {
                                        alert('An error occurred: ' + error.message);
                                    });
                            });
                        }
                    });
                </script>


                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById('sendPhoneCodeBtn').addEventListener('click', function() {
                            const newPhone = document.getElementById('new_phone').value;
                            if (!newPhone) {
                                alert('Please enter your new phone number.');
                                return;
                            }

                            fetch("{{ route('customer.phone.sendCode') }}", {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify({
                                        phone: newPhone
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        alert('Verification code sent to your new phone number.');
                                    } else {
                                        alert(data.message || 'Failed to send code.');
                                    }
                                })
                                .catch(error => {
                                    alert('Error: ' + error.message);
                                });
                        });
                    });
                </script>


                {{-- Profile form --}}
                <form action="{{ route('customer.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="card mb-4">
                        <div class="card-body">

                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <label for="fname" class="form-label fw-semibold">First Name</label>
                                        <input type="text" class="form-control" id="fname" name="fname"
                                            value="{{ old('fname', $customer->fname) }}" required>
                                        @error('fname')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <label for="lname" class="form-label fw-semibold">Last Name</label>
                                        <input type="text" class="form-control" id="lname" name="lname"
                                            value="{{ old('lname', $customer->lname) }}" required>
                                        @error('lname')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <h6 class="text-primary mb-3">Address</h6>

                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <label for="address" class="form-label fw-semibold">Address</label>
                                        <input type="text" class="form-control" id="address" name="address"
                                            value="{{ old('address', $customer->address) }}" required>
                                        @error('address')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <label for="street" class="form-label fw-semibold">Street</label>
                                        <input type="text" class="form-control" id="street" name="street"
                                            value="{{ old('street', $customer->street) }}" required>
                                        @error('street')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-4">
                                        <label for="city" class="form-label fw-semibold">City</label>
                                        <input type="text" class="form-control" id="city" name="city"
                                            value="{{ old('city', $customer->city) }}" required>
                                        @error('city')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-4">
                                        <label for="district" class="form-label fw-semibold">District</label>
                                        <input type="text" class="form-control" id="district" name="district"
                                            value="{{ old('district', $customer->district) }}" required>
                                        @error('district')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-4">
                                        <label for="postal_code" class="form-label fw-semibold">Postal Code</label>
                                        <input type="text" class="form-control" id="postal_code" name="postal_code"
                                            value="{{ old('postal_code', $customer->postal_code) }}" required>
                                        @error('postal_code')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <h6 class="text-primary mb-3">Bank Details</h6>

                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <label for="bank_name" class="form-label fw-semibold">Bank Name</label>
                                        <input type="text" class="form-control" id="bank_name" name="bank_name"
                                            value="{{ old('bank_name', $customer->bank_name) }}" required>
                                        @error('bank_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <label for="bank_branch" class="form-label fw-semibold">Bank Branch</label>
                                        <input type="text" class="form-control" id="bank_branch" name="bank_branch"
                                            value="{{ old('bank_branch', $customer->bank_branch) }}" required>
                                        @error('bank_branch')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <label for="account_name" class="form-label fw-semibold">Account Name</label>
                                        <input type="text" class="form-control" id="account_name" name="account_name"
                                            value="{{ old('account_name', $customer->account_name) }}" required>
                                        @error('account_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <label for="account_number" class="form-label fw-semibold">Account Number</label>
                                        <input type="text" class="form-control" id="account_number"
                                            name="account_number"
                                            value="{{ old('account_number', $customer->account_number) }}" required>
                                        @error('account_number')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                            </div>

                            <h6 class="text-primary mb-3">Bank Book Images</h6>
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <label for="bank_front_image" class="form-label fw-semibold">Bank Book Front
                                            Image</label>
                                        <input type="file" class="form-control" id="bank_front_image"
                                            name="bank_front_image" accept="image/*">
                                        @if ($customer->bank_front_image)
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . $customer->bank_front_image) }}"
                                                    alt="Bank Book Front" class="img-thumbnail" style="max-width:150px;">
                                            </div>
                                        @endif
                                        @error('bank_front_image')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <label for="bank_back_image" class="form-label fw-semibold">Bank Book Back
                                            Image</label>
                                        <input type="file" class="form-control" id="bank_back_image"
                                            name="bank_back_image" accept="image/*">
                                        @if ($customer->bank_back_image)
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . $customer->bank_back_image) }}"
                                                    alt="Bank Book Back" class="img-thumbnail" style="max-width:150px;">
                                            </div>
                                        @endif
                                        @error('bank_back_image')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            @if ($customer->bank_status)
                                <div class="mb-3">
                                    @if ($customer->bank_status === 'approved')
                                        <span class="badge bg-success"><i class="bi bi-patch-check-fill"></i> Bank
                                            Verified</span>
                                    @elseif ($customer->bank_status === 'pending')
                                        <span class="badge bg-warning text-dark"><i class="bi bi-hourglass-split"></i>
                                            Bank Verification Pending</span>
                                    @elseif ($customer->bank_status === 'rejected')
                                        <span class="badge bg-danger"><i class="bi bi-x-circle-fill"></i> Bank
                                            Verification Rejected</span>
                                    @endif
                                </div>
                            @endif

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Save Changes
                            </button>
                        </div>
                    </div>
                </form>

                <hr class="my-5">
                \
                {{-- KYC Section --}}
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0 text-primary">KYC Verification</h5>
                    </div>
                    <div class="card-body">
                        @if ($customer->kyc_status === 'approved')
                            <div class="alert alert-success d-flex align-items-center">
                                <i class="bi bi-patch-check-fill me-2"></i>
                                Your KYC is Approved. You cannot update your KYC details.
                            </div>
                            <ul class="list-group mb-3">
                                <li class="list-group-item"><strong>Document Type:</strong> {{ $customer->kyc_doc_type }}
                                </li>
                                <li class="list-group-item"><strong>Document Number:</strong>
                                    {{ $customer->kyc_doc_number }}</li>
                                <li class="list-group-item">
                                    <strong>Front Image:</strong><br>
                                    <img src="{{ asset('storage/' . $customer->kyc_doc_front) }}" alt="Front Image"
                                        class="img-thumbnail" style="width: 150px; height: 150px; object-fit: fill;">

                                </li>
                                <li class="list-group-item">
                                    <strong>Back Image:</strong><br>
                                    <img src="{{ asset('storage/' . $customer->kyc_doc_back) }}" alt="Back Image"
                                        class="img-thumbnail" style="width: 150px; height: 150px; object-fit: fill;">
                                </li>
                            </ul>
                        @else
                            @if ($customer->kyc_status === 'rejected')
                                <div class="alert alert-danger d-flex align-items-center">
                                    <i class="bi bi-x-circle-fill me-2"></i>
                                    Your KYC was Rejected. Please resubmit your details.
                                </div>
                            @elseif($customer->kyc_status === 'pending')
                                <div class="alert alert-warning d-flex align-items-center">
                                    <i class="bi bi-hourglass-split me-2"></i>
                                    Your KYC is Pending review.
                                </div>
                            @elseif(!$customer->kyc_status)
                                <div class="alert alert-info d-flex align-items-center">
                                    <i class="bi bi-info-circle-fill me-2"></i>
                                    You have not submitted your KYC details yet. Please fill out the form below.
                                </div>
                            @endif

                            <form action="{{ route('customer.kyc.submit') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="kyc_doc_type" class="form-label fw-semibold">Document Type</label>
                                    <select class="form-control" name="kyc_doc_type" id="kyc_doc_type" required
                                        {{ $customer->kyc_status === 'pending' ? 'disabled' : '' }}>
                                        <option value="">Select</option>
                                        <option value="NIC"
                                            {{ old('kyc_doc_type', $customer->kyc_doc_type) == 'NIC' ? 'selected' : '' }}>
                                            National
                                            Identity Card (NIC)</option>
                                        <option value="Passport"
                                            {{ old('kyc_doc_type', $customer->kyc_doc_type) == 'Passport' ? 'selected' : '' }}>
                                            Passport</option>
                                        <option value="DL"
                                            {{ old('kyc_doc_type', $customer->kyc_doc_type) == 'DL' ? 'selected' : '' }}>
                                            Driving
                                            License</option>
                                    </select>
                                    @error('kyc_doc_type')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="kyc_doc_number" class="form-label fw-semibold">Document Number</label>
                                    <input type="text" class="form-control" id="kyc_doc_number" name="kyc_doc_number"
                                        value="{{ old('kyc_doc_number', $customer->kyc_doc_number) }}" required
                                        {{ $customer->kyc_status === 'pending' ? 'disabled' : '' }}>
                                    @error('kyc_doc_number')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="kyc_doc_front" class="form-label fw-semibold">Document Front Image</label>
                                    <input type="file" class="form-control" id="kyc_doc_front" name="kyc_doc_front"
                                        accept="image/*" {{ $customer->kyc_status === 'pending' ? 'disabled' : '' }}
                                        {{ $customer->kyc_doc_front ? '' : 'required' }}>
                                    @if ($customer->kyc_doc_front)
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/' . $customer->kyc_doc_front) }}"
                                                alt="Front Image" class="img-thumbnail" style="max-width:150px;">
                                        </div>
                                    @endif
                                    @error('kyc_doc_front')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="kyc_doc_back" class="form-label fw-semibold">Document Back Image</label>
                                    <input type="file" class="form-control" id="kyc_doc_back" name="kyc_doc_back"
                                        accept="image/*" {{ $customer->kyc_status === 'pending' ? 'disabled' : '' }}
                                        {{ $customer->kyc_doc_back ? '' : 'required' }}>
                                    @if ($customer->kyc_doc_back)
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/' . $customer->kyc_doc_back) }}" alt="Back Image"
                                                class="img-thumbnail" style="max-width:150px;">
                                        </div>
                                    @endif
                                    @error('kyc_doc_back')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                @if ($customer->kyc_status !== 'pending')
                                    <button type="submit" class="btn btn-success">
                                        <i class="bi bi-upload"></i>
                                        {{ $customer->kyc_status === 'rejected' ? 'Resubmit KYC' : 'Submit KYC' }}
                                    </button>
                                @endif
                            </form>
                        @endif
                    </div>
                </div>

                {{-- Separator --}}
                <hr class="my-5">

                {{-- Password update success/error --}}
                @if (session('password_success'))
                    <div class="alert alert-success"><i class="bi bi-check-circle me-2"></i>
                        {{ session('password_success') }}
                    </div>
                @endif

                @if (session('password_error'))
                    <div class="alert alert-danger"><i class="bi bi-exclamation-circle me-2"></i>
                        {{ session('password_error') }}
                    </div>
                @endif

                {{-- Password update form --}}
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0 text-primary">Change Password</h5>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('customer.password.update') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="current_password" class="form-label fw-semibold">Current Password</label>
                                <input type="password" class="form-control" name="current_password"
                                    id="current_password" required>
                                @error('current_password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="new_password" class="form-label fw-semibold">New Password</label>
                                <input type="password" class="form-control" name="new_password" id="new_password"
                                    required>
                                @error('new_password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="new_password_confirmation" class="form-label fw-semibold">Confirm New
                                    Password</label>
                                <input type="password" class="form-control" name="new_password_confirmation"
                                    id="new_password_confirmation" required>
                            </div>

                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-shield-lock"></i> Update Password
                            </button>
                        </form>

                    </div>
                </div>

            </div>

        </div>

    </div>

    {{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const idTypeSelect = document.getElementById('kyc_doc_type');
        const idNumberContainer = document.getElementById('kyc_doc_number_container');

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
</script> --}}
@endsection
