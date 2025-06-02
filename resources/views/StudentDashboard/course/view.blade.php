@extends('StudentDashboard.master')

@section('content')
<div class="container py-4">

    <!-- Back Button -->
    <div class="mb-3">
        <a href="{{ route('student.bookings') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left-circle"></i> Back to My Courses
        </a>
    </div>

    <!-- Course Card -->
    <div class="card shadow border-0">
        <div class="row g-0">
            <div class="col-md-5">
                @if($booking->course->image)
                    <img src="{{ asset($booking->course->image) }}" class="img-fluid rounded-start w-100 h-100 object-fit-cover" alt="{{ $booking->course->name }}">
                @else
                    <div class="bg-light d-flex align-items-center justify-content-center h-100" style="height: 100%;">
                        <span class="text-muted">No Image</span>
                    </div>
                @endif
            </div>
            <div class="col-md-7">
                <div class="card-body">
                    <h3 class="card-title">{{ $booking->course->name }}</h3>
                    <p class="card-text"><strong>Duration:</strong> {{ $booking->course->duration }} days</p>
                    <p class="card-text"><strong>Mode:</strong> {{ ucfirst($booking->course->mode) }}</p>
                    <p class="card-text"><strong>Location:</strong> {{ $booking->course->location }}</p>
                    <p class="card-text"><strong>Total Price:</strong> Rs. {{ number_format($booking->course->total_price, 2) }}</p>
                    <p class="card-text"><strong>Paid:</strong> {{ ucfirst($booking->payment_status) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
