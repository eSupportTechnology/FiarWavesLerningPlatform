@extends('AdminDashboard.master')
@section('title', 'View Course Details')

@section('breadcrumb-title')
    <h3>View Course Details</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Course Management</li>
    <li class="breadcrumb-item active">Course Details</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5>Course Details</h5>
                    <a href="{{ route('courses.index') }}" class="btn btn-primary">Back to Courses</a>
                </div>
                <div class="card-body">

                    {{-- Image --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Course Image:</strong><br>
                            @if($course->image)
                                <img src="{{ asset($course->image) }}" alt="Course Image" width="200" class="img-thumbnail mt-2">
                            @else
                                <p>No Image Available</p>
                            @endif
                        </div>
                    </div>

                    {{-- Course Name --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Course Name:</strong>
                            <p>{{ $course->name }}</p>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <strong>Description:</strong>
                            <div class="border p-3 rounded bg-light text-black">
                                {!! $course->description ?? '<em>No description provided.</em>' !!}
                            </div>
                        </div>
                    </div>

                    {{-- Duration --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Duration (Days):</strong>
                            <p>{{ $course->duration }}</p>
                        </div>
                    </div>

                    {{-- Prices --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Total Price (Rs.):</strong>
                            <p>{{ number_format($course->total_price, 2) }}</p>
                        </div>
                        
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>First Payment (Rs.):</strong>
                            <p>{{ number_format($course->first_payment, 2) }}</p>
                        </div>
                    </div>

                    {{-- Video Link --}}
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>Course Video:</strong>
                                @if ($course->video_link)
                                    <p>
                                        <a href="{{ $course->video_link }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                            Watch Video
                                        </a>
                                    </p>

                                    {{-- Optional: Embed YouTube preview --}}
                                    @php
                                        preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/shorts\/)([^\&\?\/]+)/', $course->video_link, $matches);
                                        $videoId = $matches[1] ?? null;
                                    @endphp

                                    @if ($videoId)
                                        <div class="ratio ratio-16x9 mt-2">
                                            <iframe src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allowfullscreen></iframe>
                                        </div>
                                    @endif
                                @else
                                    <p class="text-muted">No video link provided.</p>
                                @endif
                            </div>
                        </div>


                    {{-- Location --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Location:</strong>
                            <p>{{ $course->location ?? 'N/A' }}</p>
                        </div>
                    </div>

                    {{-- Mode --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Mode:</strong>
                            <p class="text-capitalize">{{ $course->mode }}</p>
                        </div>
                    </div>

                    {{-- Branch --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Branch:</strong>
                            <p>{{ $course->branch->name ?? 'N/A' }}</p>
                        </div>
                    </div>


                    

                   

                </div> <!-- /card-body -->
            </div> <!-- /card -->
        </div>
    </div>
</div>
@endsection
