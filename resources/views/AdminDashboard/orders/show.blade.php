@extends('AdminDashboard.master')

@section('title', 'Booking Details')

@section('breadcrumb-title')
    <h3>Booking Details</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Orders</li>
    <li class="breadcrumb-item active">View</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Booking #{{ $booking->id }}</h5>
            <a href="{{ route('admin.orders.pending') }}" class="btn btn-sm btn-secondary">Back to List</a>
        </div>

        <div class="card-body">
            <h6 class="text-primary mb-3">Student Information</h6>
            <ul class="list-group list-group-flush mb-3">
                <li class="list-group-item"><strong>Name:</strong> {{ $booking->customer->name }}</li>
                <li class="list-group-item"><strong>Email:</strong> {{ $booking->customer->email }}</li>
                <li class="list-group-item"><strong>Contact:</strong> {{ $booking->customer->contact_number }}</li>
            </ul>

            <h6 class="text-primary mb-3">Course Information</h6>
            <ul class="list-group list-group-flush mb-3">
                <li class="list-group-item"><strong>Course:</strong> {{ $booking->course->name }}</li>
                <li class="list-group-item"><strong>Location:</strong> {{ $booking->course->location }}</li>
                <li class="list-group-item"><strong>Mode:</strong> {{ ucfirst($booking->course->mode) }}</li>
                <li class="list-group-item"><strong>Duration:</strong> {{ $booking->course->duration }} days</li>
            </ul>

            <h6 class="text-primary mb-3">Payment Details</h6>
            <ul class="list-group list-group-flush mb-3">
                <li class="list-group-item"><strong>Status:</strong> {{ $booking->status }}</li>
                <li class="list-group-item"><strong>Payment Type:</strong> {{ ucfirst($booking->payment_status) }}</li>
                <li class="list-group-item"><strong>Method:</strong> {{ $booking->payment_method }}</li>
                <li class="list-group-item"><strong>Transfer Date:</strong> {{ $booking->transfer_date ?? 'N/A' }}</li>
                <li class="list-group-item">
                    <strong>Receipt:</strong>
                    @if($booking->receipt_path)
                    <a href="{{ asset('storage/' . $booking->receipt_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">View Receipt</a>
                    @else
                        <span class="text-muted">Not Provided</span>
                    @endif
                </li>
            </ul>

            
        </div>
    </div>
</div>
@endsection
