@extends('StudentDashboard.master')

@section('content')
<div class="container py-4">

    <h4 class="mb-4 text-primary fw-bold">My Purchased Courses</h4>

    <div class="row g-4">
        @forelse($bookings as $booking)
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0 h-100">
                    @if($booking->course->image)
                        <img src="{{ asset($booking->course->image) }}" class="card-img-top" style="height: 180px; object-fit: cover;" alt="{{ $booking->course->name }}">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 180px;">
                            <span class="text-muted">No Image</span>
                        </div>
                    @endif

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $booking->course->name }}</h5>
                        
                        <div class="mt-auto d-flex flex-wrap gap-2">
                            <a href="{{ route('student.course.details', $booking->id) }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-info-circle"></i> View More
                            </a>

                            @if($booking->course->files->count())
                                <a href="{{ route('student.course.files', $booking->id) }}" class="btn btn-outline-success btn-sm">
                                    <i class="bi bi-file-earmark-text"></i> Files
                                </a>
                            @endif

                            @if($booking->course->recordings->count())
                                <a href="{{ route('student.course.recordings', $booking->id) }}" class="btn btn-outline-warning btn-sm">
                                    <i class="bi bi-camera-video"></i> Recordings
                                </a>
                            @endif

                            @if($booking->course->zoomLinks->count())
                                <a href="{{ route('student.course.zoom', $booking->id) }}" class="btn btn-outline-info btn-sm">
                                    <i class="bi bi-link-45deg"></i> Zoom Links
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">You haven’t purchased any courses yet.</p>
        @endforelse
    </div>

</div>
@endsection
