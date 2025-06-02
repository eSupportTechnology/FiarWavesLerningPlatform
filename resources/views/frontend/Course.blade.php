@extends('frontend.master')

@section('title', 'Courses - DAS Academy')

@section('content')


</style>

<!-- Page Header section start -->
<div class="pageheader-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="pageheader-content text-center">
                    <h2>Courses</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Course Page</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Header section end -->

<!-- Course section start -->
<div class="course-section padding-tb section-bg">
    <div class="container">
        <div class="section-wrapper">
            
            <!-- 🔰 Ad Banner (Top Horizontal) -->
            <div class="mb-4 text-center">
                @if (!empty($bannerImage)) {{-- Pass $bannerImage from controller --}}
                    <a href="{{ $bannerLink ?? '#' }}" target="_blank">
                        <img src="{{ asset($bannerImage) }}" alt="Ad Banner" class="img-fluid rounded shadow-sm"
                            style="max-height: 150px; width: 100%; object-fit: cover;">
                    </a>
                @else
                    <div class="p-4 bg-light rounded shadow-sm border text-center">
                        <h5 class="mb-1">📢 Want your banner here?</h5>
                        <p class="mb-0">Contact us to feature your brand or announcement.</p>
                        <a href="{{ route('frontend.contact') }}" class="btn btn-outline-primary mt-2 btn-sm">
                            Contact Us
                        </a>
                    </div>
                @endif
            </div>


            <div class="row g-4 justify-content-center">
                @foreach ($courses as $course)
                    <div class="col-xl-4 col-md-6 col-12">
                        <div class="course-item">
                            <div class="course-inner">
                                <div class="course-thumb">
                                    @if ($course->image)
                                        <img src="{{ asset($course->image) }}" alt="course" width="320" height="190">
                                    @else
                                        <img src="{{ asset('frontend/assets/images/default-course.jpg') }}" alt="No Image" width="320" height="190">
                                    @endif
                                </div>
                                <div class="course-content">
                                    

                                    <a href="{{ route('frontend.Course_Details', ['id' => $course->course_id]) }}">
                                        <h5 class="mt-2">{{ $course->name }}</h5>
                                    </a>

                                    <div class="course-details mt-3">
                                        <p><i class="icofont-video-alt"></i> {{ $course->duration }} Lessons</p>
                                        <p><i class="icofont-globe"></i> {{ ucfirst($course->mode) }} Class</p>
                                    </div>


                                    <div class="course-footer mt-3 text-end">
                                        <a href="{{ route('frontend.Course_Details', ['id' => $course->course_id]) }}" class="lab-btn-text mb-2 d-inline-block">
                                            Read More <i class="icofont-external-link"></i>
                                        </a>

                                        <div class="fw-bold" style="font-size: 22px; color: #e53935;">
                                            Rs.{{ number_format($course->total_price, 2) }}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination placeholder (optional) --}}
            {{-- <div class="mt-4 d-flex justify-content-center">
                {{ $courses->links() }}
            </div> --}}
        </div>
    </div>
</div>
<!-- Course section end -->

@endsection
