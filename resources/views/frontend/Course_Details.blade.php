@extends('frontend.master')

@section('title', $course->name . ' - DAS Academy')

@section('content')

<!-- Page Header section -->
<div class="pageheader-section style-2">
    <div class="container">
        <div class="row justify-content-center justify-content-lg-between align-items-center flex-row-reverse">
            <div class="col-lg-7 col-12">
                <div class="pageheader-thumb">
                    @if ($course->video_link)
                    <div class="position-relative">
                        <img src="https://img.youtube.com/vi/{{ \Illuminate\Support\Str::afterLast($course->video_link, 'v=') }}/hqdefault.jpg"
                            alt="Video thumbnail"
                            class="w-100 rounded shadow-sm">
                            @php
                                $videoId = \Illuminate\Support\Str::afterLast($course->video_link, 'v=');
                            @endphp
                            <a href="https://www.youtube.com/embed/{{ $videoId }}" class="video-button" data-rel="lightcase">
                                <i class="icofont-ui-play"></i>
                            </a>

                    </div>
                @else
                    <img src="{{ asset($course->image) }}" alt="{{ $course->name }}" class="w-100 rounded shadow-sm">
                @endif

                </div>
            </div>
            <div class="col-lg-5 col-12">
                <div class="pageheader-content">
                    <div class="course-category mb-2">
                        <span class="badge bg-primary fs-6">Rs. {{ number_format($course->total_price, 2) }}</span>
                        <span class="badge bg-warning text-dark fs-6">First Payment: Rs. {{ number_format($course->first_payment, 2) }}</span>
                    </div>

                    <h2 class="phs-title mb-3">{{ $course->name }}</h2>

                    <ul class="list-unstyled mb-4 text-dark" style="font-size: 17px; line-height: 1.8;">
                        <li><i class="icofont-video-alt me-2 text-primary"></i> <strong>{{ $course->duration }}</strong> Days of Lessons</li>
                        <li><i class="icofont-globe me-2 text-primary"></i> <strong>{{ ucfirst($course->mode) }}</strong> Mode</li>
                        <li><i class="icofont-location-pin me-2 text-primary"></i> Location: <strong>{{ $course->location ?? 'N/A' }}</strong></li>
                        @if($course->branch)
                            <li><i class="icofont-building-alt me-2 text-primary"></i> Branch: <strong>{{ $course->branch->name }}</strong></li>
                        @endif
                    </ul>

                    <div class="alert alert-info py-3 px-4" style="font-size: 16px; line-height: 1.7;">
                        <i class="icofont-check-alt text-success me-2"></i> Lifetime access to all class recordings<br>
                        <i class="icofont-check-alt text-success me-2"></i> 2 Days in-person physical trading program
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Header end -->


<!-- Course Details section -->
<div class="course-single-section padding-tb section-bg">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Main Content -->
            <div class="col-lg-8">
                <div class="main-part">
                    <div class="course-item">
                        <div class="course-inner">
                            <div class="course-content">
                                <h3 class="mb-3">Course Overview</h3>
                                <div class="border rounded p-3 bg-white shadow-sm">
                                    {!! $course->description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sidebar-part">
                    <div class="course-side-detail p-4 border bg-white shadow-sm rounded">
                        <h4 class="mb-3 text-center text-success">Enroll Now</h4>

                        <div class="text-center mb-3">
                            <h3 class="text-danger">Rs. {{ number_format($course->total_price, 2) }}</h3>
                            <small class="text-muted">First Payment: Rs. {{ number_format($course->first_payment, 2) }}</small>
                        </div>

                        <p class="text-center"><i class="icofont-clock-time"></i> Limited Time Offer</p>

                        <div class="d-grid">
                            <a href="{{ route('course.booking.form', $course->course_id) }}" class="btn btn-primary btn-lg">Enroll Now</a>
                        </div>
                    </div>

                    <!-- Optional Add-Ons -->
                    <div class="mt-4 p-3 bg-light rounded shadow-sm">
                        <h6 class="mb-2">This Course Includes:</h6>
                        <ul class="list-unstyled small" style="font-size: 17px; line-height: 1.8;">
                            <li><i class="icofont-check-alt"></i> PDF materials</li>
                            <li><i class="icofont-check-alt"></i> Zoom class access</li>
                            <li><i class="icofont-check-alt"></i> Weekly recordings</li>
                            <li><i class="icofont-check-alt"></i> Certificate of completion</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Sidebar End -->
        </div>
    </div>
</div>
<!-- Course section end -->

@endsection
