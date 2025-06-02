@extends('StudentDashboard.master')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="text-primary fw-bold mb-0">{{ $booking->course->name }} – Zoom Links</h4>
        <a href="{{ route('student.bookings') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left-circle"></i> Back to Courses
        </a>
    </div>

    @forelse($zoomLinks as $link)
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1">{{ $link->week_name }}</h6>
                        <small class="text-muted">{{ $link->description ?? 'No description provided.' }}</small>
                    </div>
                    <a href="{{ $link->zoom_link }}" target="_blank" class="btn btn-sm btn-outline-info">
                        <i class="bi bi-link-45deg"></i> Join Zoom
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-warning">
            <i class="bi bi-exclamation-circle me-2"></i> No Zoom links available for your batch yet.
        </div>
    @endforelse

</div>
@endsection
