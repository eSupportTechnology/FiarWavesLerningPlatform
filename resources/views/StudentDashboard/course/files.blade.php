@extends('StudentDashboard.master')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="text-primary fw-bold mb-0">{{ $booking->course->name }} – Course Files</h4>
        <a href="{{ route('student.bookings') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left-circle"></i> Back to Courses
        </a>
    </div>

    @forelse($files as $file)
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <i class="bi bi-file-earmark-text-fill text-primary fs-3 me-3"></i>
                    <div>
                        <h6 class="mb-1">{{ $file->file_name }}</h6>
                        <small class="text-muted">{{ strtoupper($file->file_type) }} file | Uploaded: {{ \Carbon\Carbon::parse($file->created_at)->format('d M, Y') }}</small>
                    </div>
                </div>
                <div>
                    <a href="{{ asset($file->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-eye"></i> View
                    </a>
                    <a href="{{ asset($file->file_path) }}" download class="btn btn-sm btn-success">
                        <i class="bi bi-download"></i> Download
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-warning">
            <i class="bi bi-exclamation-circle me-2"></i> No files available for your batch at this moment.
        </div>
    @endforelse

</div>
@endsection
