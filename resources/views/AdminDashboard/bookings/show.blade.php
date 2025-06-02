@extends('AdminDashboard.master')

@section('title', 'Booking Details')

@section('breadcrumb-title')
    <h3>Booking Details</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Bookings</li>
    <li class="breadcrumb-item active">View</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row g-4">
        <!-- Left Column: Customer Details -->
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Customer Information</h5>
                </div>
                <div class="card-body">
                    <p><strong>Name:</strong> {{ $booking->customer->name }}</p>
                    <p><strong>Email:</strong> {{ $booking->customer->email }}</p>
                    <p><strong>Contact Number:</strong> {{ $booking->customer->contact_number }}</p>
                    <p><strong>Address:</strong> {{ $booking->customer->address ?? 'N/A' }}</p>
                    <p><strong>Status:</strong> 
                        <span class="badge bg-success">{{ $booking->customer->status }}</span>
                    </p>
                    <p><strong>Registered On:</strong> {{ $booking->customer->created_at->format('d M Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Right Column: Booking + Course Info -->
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Booking & Course Info</h5>
                </div>
                <div class="card-body">
                    <p><strong>Course:</strong> {{ $booking->course->name ?? 'N/A' }}</p>
                    <p><strong>Duration:</strong> {{ $booking->course->duration }} Days</p>
                    <p><strong>Total Price:</strong> Rs. {{ number_format($booking->course->total_price, 2) }}</p>
                    <p><strong>First Payment:</strong> Rs. {{ number_format($booking->course->first_payment, 2) }}</p>

                    <hr>
                    <p><strong>Payment Method:</strong> {{ $booking->payment_method }}</p>
                    <p><strong>Payment Status:</strong> 
                        @if($booking->payment_status === 'half')
                            <span class="text-warning">First Payment</span>
                        @else
                            <span class="text-success">Full Payment</span>
                        @endif
                    </p>
                    <p><strong>Booking Status:</strong> 
                        <span class="badge bg-{{ $booking->status === 'Pending' ? 'warning' : 'success' }}">
                            {{ $booking->status }}
                        </span>
                    </p>
                    
                    @if($booking->payment_method === 'Bank Transfer')
                        <hr>
                        <h6>Bank Transfer Details</h6>
                        <p><strong>Bank:</strong> {{ $booking->bank_name ?? '-' }}</p>
                        <p><strong>Branch:</strong> {{ $booking->bank_branch ?? '-' }}</p>
                        <p><strong>Transfer Date:</strong> {{ $booking->transfer_date ?? '-' }}</p>
                        @if($booking->receipt_path)
                            <p><strong>Receipt:</strong><br>
                                <a href="{{ asset('storage/' . $booking->receipt_path) }}" target="_blank" class="btn btn-sm btn-info mt-1">
                                    View Receipt
                                </a>
                            </p>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Optional Admin Notes -->
    @if($booking->admin_notes)
    <div class="card mt-4 shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0">Admin Notes</h5>
        </div>
        <div class="card-body">
            <p>{{ $booking->admin_notes }}</p>
        </div>
    </div>
    @endif
</div>
@endsection
