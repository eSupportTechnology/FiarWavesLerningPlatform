@extends('AdminDashboard.master')

@section('title', 'Customer Details')

@section('breadcrumb-title')
    <h3>Customer Profile</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.customers.index') }}">Customers</a></li>
    <li class="breadcrumb-item active">{{ $customer->name }}</li>
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Customer Info -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Customer Information</h5>
                <a href="{{ route('admin.customers.index') }}" class="btn btn-light btn-sm">← Back to List</a>
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Invite code</th>
                        <td>{{ $customer->invite_code ?? 'Not Assigned' }}</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{ $customer->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $customer->email }}</td>
                    </tr>
                    <tr>
                        <th>Contact Number</th>
                        <td>{{ $customer->contact_number }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge bg-{{ $customer->status ? 'success' : 'secondary' }}">
                                {{ $customer->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>KYC Status</th>
                        <td>
                            @if (is_null($customer->kyc_status))
                                <span class="badge bg-secondary">Not Applied</span>
                            @elseif ($customer->kyc_status == 'approved')
                                <span class="badge bg-success">Approved</span>
                            @elseif ($customer->kyc_status == 'rejected')
                                <span class="badge bg-danger">Rejected</span>
                            @else
                                <span class="badge bg-warning">Pending</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $customer->address ?? 'Not Provided' }}</td>
                    </tr>
                    <tr>
                        <th>Street</th>
                        <td>{{ $customer->street ?? 'Not Provided' }}</td>
                    </tr>
                    <tr>
                        <th>City</th>
                        <td>{{ $customer->city ?? 'Not Provided' }}</td>
                    </tr>
                    <tr>
                        <th>District</th>
                        <td>{{ $customer->district ?? 'Not Provided' }}</td>
                    </tr>
                    <tr>
                        <th>Postal Code</th>
                        <td>{{ $customer->postal_code ?? 'Not Provided' }}</td>
                    </tr>

                    <tr>
                        <th>Bank name</th>
                        <td>{{ $customer->bank_name ?? 'Not Provided' }}</td>
                    </tr>
                    <tr>
                        <th>Bank Branch</th>
                        <td>{{ $customer->bank_branch ?? 'Not Provided' }}</td>
                    </tr>
                    <tr>
                        <th>Account Name</th>
                        <td>{{ $customer->account_name ?? 'Not Provided' }}</td>
                    </tr>
                    <tr>
                        <th>Account Number</th>
                        <td>{{ $customer->account_number ?? 'Not Provided' }}</td>
                    </tr>

                    {{-- <tr><th>Email Verified</th>
                    <td>
                        @if ($customer->email_verified_at)
                            <span class="text-success">Verified on {{ $customer->email_verified_at->format('Y-m-d') }}</span>
                        @else
                            <span class="text-danger">Not Verified</span>
                        @endif
                    </td>
                </tr> --}}
                    <tr>
                        <th>Registered At</th>
                        <td>{{ $customer->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                </table>

                @if ($customer->kyc_doc_type && $customer->kyc_doc_number)
                    <hr>
                    <h5 class="mb-3">KYC Details</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>Document Type</th>
                            <td>{{ $customer->kyc_doc_type }}</td>
                        </tr>
                        <tr>
                            <th>Document Number</th>
                            <td>{{ $customer->kyc_doc_number }}</td>
                        </tr>
                        @if($customer->kyc_doc_front)
                        <tr>
                            <th>Document Front</th>
                            <td>
                                <a href="{{ asset('storage/' . $customer->kyc_doc_front) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $customer->kyc_doc_front) }}" alt="Front"
                                        style="max-width:120px;max-height:80px;">
                                </a>
                            </td>
                        </tr>
                        @endif
                        @if($customer->kyc_doc_back)
                        <tr>
                            <th>Document Back</th>
                            <td>
                                <a href="{{ asset('storage/' . $customer->kyc_doc_back) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $customer->kyc_doc_back) }}" alt="Back"
                                        style="max-width:120px;max-height:80px;">
                                </a>
                            </td>
                        </tr>
                        @endif
                        <tr>
                            <th>Current KYC Status</th>
                            <td>
                                @if (is_null($customer->kyc_status))
                                    <span class="badge bg-secondary">Not Applied</span>
                                @elseif ($customer->kyc_status == 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @elseif ($customer->kyc_status == 'rejected')
                                    <span class="badge bg-danger">Rejected</span>
                                @else
                                    <span class="badge bg-warning">Pending</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                    @if ($customer->kyc_status !== 'approved' && $customer->kyc_status !== 'rejected' && !is_null($customer->kyc_status))
                        <form action="{{ route('admin.customers.kyc.update', $customer) }}" method="POST"
                            class="d-flex gap-2">
                            @csrf
                            @method('PATCH')
                            <button type="submit" name="action" value="approve" class="btn btn-success btn-sm"
                                onclick="return confirm('Are you sure you want to approve this KYC?')">Approve</button>
                            <button type="submit" name="action" value="reject" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to reject this KYC?')">Reject</button>
                        </form>
                    @endif
                @else
                    <div class="alert alert-secondary mt-3 mb-0">
                        No KYC details submitted.
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

            </div>
        </div>

        <!-- Purchased Courses Section -->
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Purchased Courses</h5>
            </div>
            <div class="card-body">
                @if ($customer->bookings->count())
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Course Name</th>
                                    <th>Duration</th>
                                    <th>Mode</th>
                                    <th>Payment</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customer->bookings as $index => $booking)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $booking->course->name ?? 'N/A' }}</td>
                                        <td>{{ $booking->course->duration }} days</td>
                                        <td>{{ ucfirst($booking->course->mode) }}</td>
                                        <td>{{ ucfirst($booking->payment_status) }}</td>
                                        <td>
                                            <span
                                                class="badge bg-{{ $booking->status === 'Confirmed' ? 'success' : ($booking->status === 'Pending' ? 'warning' : 'secondary') }}">
                                                {{ $booking->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted">No course bookings found for this student.</p>
                @endif
            </div>
        </div>

    </div>
@endsection
