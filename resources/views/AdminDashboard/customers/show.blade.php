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
                <tr><th>Student ID</th><td>{{ $customer->stu_id ?? 'Not Assigned' }}</td></tr>
                <tr><th>Name</th><td>{{ $customer->name }}</td></tr>
                <tr><th>Email</th><td>{{ $customer->email }}</td></tr>
                <tr><th>Contact Number</th><td>{{ $customer->contact_number }}</td></tr>
                <tr><th>Status</th>
                    <td>
                        <span class="badge bg-{{ $customer->status ? 'success' : 'secondary' }}">
                            {{ $customer->status ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                </tr>
                <tr><th>Email Verified</th>
                    <td>
                        @if ($customer->email_verified_at)
                            <span class="text-success">Verified on {{ $customer->email_verified_at->format('Y-m-d') }}</span>
                        @else
                            <span class="text-danger">Not Verified</span>
                        @endif
                    </td>
                </tr>
                <tr><th>Registered At</th><td>{{ $customer->created_at->format('Y-m-d H:i') }}</td></tr>
            </table>
        </div>
    </div>

    <!-- Purchased Courses Section -->
    <div class="card">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Purchased Courses</h5>
        </div>
        <div class="card-body">
            @if($customer->bookings->count())
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
                            @foreach($customer->bookings as $index => $booking)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $booking->course->name ?? 'N/A' }}</td>
                                    <td>{{ $booking->course->duration }} days</td>
                                    <td>{{ ucfirst($booking->course->mode) }}</td>
                                    <td>{{ ucfirst($booking->payment_status) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $booking->status === 'Confirmed' ? 'success' : ($booking->status === 'Pending' ? 'warning' : 'secondary') }}">
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
