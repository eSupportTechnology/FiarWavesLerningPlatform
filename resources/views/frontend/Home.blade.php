@extends('frontend.master')

@section('title', 'Home - Edukon')

@section('content')


@php
    function getYoutubeVideoId($url) {
    if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:embed\/|watch\?v=|v\/|shorts\/))([^\&\?\/]+)/', $url, $matches)) {
        return $matches[1];
    }
    return null;
}

@endphp



<style>
/* Enroll Section */
.enroll-section {
    position: fixed; /* Keeps the button fixed */
    top: 50%; /* Center vertically */
    right: 20px; /* Align to the right */
    transform: translateY(-50%); /* Perfect vertical alignment */
    display: flex; /* Flexbox to align */
    flex-direction: column; /* Vertical alignment */
    align-items: center; /* Center content horizontally */
    justify-content: center; /* Center content vertically */
    z-index: 1000; /* Keep on top of other content */
}

/* Enroll Button */
.enroll-btn {
    background-color:rgb(12, 102, 199); /* Button color (blue) */
    color:rgb(255, 255, 255); /* Text color */
    font-size: 14px; /* Font size */
    font-weight: bold; /* Bold text */
    padding: 6px 15px; /* Space inside the button */
    border-radius: 20px; /* Rounded corners */
    text-decoration: none; /* Remove underline */
    cursor: pointer; /* Pointer cursor on hover */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Add shadow */
    transition: all 0.3s ease; /* Smooth hover animation */
    writing-mode: vertical-rl; /* Rotate the text vertically */
    text-orientation: upright; /* Ensure letters stay upright */
}

/* Hover Effect for Button */
.enroll-btn:hover {
    background-color:rgb(21, 133, 252); /* Darker blue on hover */
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2); /* Add shadow on hover */
}
.h6 {
    position: relative;
    animation: fall 2s ease-in-out;
}

.course-price-box {
    background-color: #ee1831; /* Bright red */
    color: #fff;
    padding: 6px 15px;
    display: inline-block;
    border-radius: 5px;
    font-weight: 600;
    font-size: 16px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

.cbs-content-list {
    margin-top: 200px;
}

.meta-post i {
    color: #ee1831 !important;   /* Force red */
    opacity: 1 !important;       /* Ensure visibility */
    visibility: visible !important;
    transition: none !important; /* Cancel any transition effects */
}

.about-dsa-bg {
    background-color: #71a2da;
}


@keyframes fall{
    0%{
        transform: translatey(-100%);
        opacity: 0;
    }
    100%{
        transform: translatey(0);
        opacity: 1;
    }
}
.h2{
    animation: typing 4s steps(30, end), blink-caret 0.5s step-end infinite;
}
@keyframes typing{
    from{
        width: 0;
    }
    to{
        width: 100%;
     }
}
@keyframes blink-caret{
    from,to{
        border-color: transparent;
    }
    50%{
        border-color: black;
    }
}
/* Responsive Design */
@media (max-width: 768px) {
    .enroll-section {
        right: 10px; /* Adjust for smaller screens */
    }

    .enroll-btn {
        font-size: 14px; /* Smaller font size */
        padding: 8px 15px; /* Adjust padding */
    }
}
</style>


<style>
    .vip-btn {
        background-color: #ed3532;
        font-weight:bold;
        color: #000;
        transition: background 0.3s ease;
    }

    .vip-btn:hover {
        background-color: #c8232c;
        color: #fff;
    }
</style>

    <!-- banner section start here -->
    <section class="banner-section style-1" style="background:#eddddd">
        <div class="container">
            <div class="section-wrapper">
                <div class="row align-items-center">
                    <!-- Text Area -->
                    <div class="col-xxl-6 col-xl-7 col-lg-11">
                        <div class="banner-content">
                            <h6 class="subtitle text-uppercase fw-medium mt-5" style="color:#ee1831;">Empowering Education</h6>
                            <h2 class="title" style="color:#1b2954;">
                                <span class="d-lg-block">DSA Academy</span>
                                Learn The Skills That <span class="d-lg-block">Transform Your Life</span>
                            </h2>
                            <p class="desc">
                                Join 10,000+ students across Sri Lanka.<br>
                                Gain real-world skills through online and physical classes.<br>
                                Start your journey with DSA today!
                            </p>
                            
                        </div>
                    </div>

                    <!-- Image Area -->
                    <div class="col-xxl-6 col-xl-5 d-none d-xl-block"
                        style="background-image: url('{{ asset('frontend/assets/images/logo.png') }}');
                            background-size: contain;
                            background-repeat: no-repeat;
                            background-position: center;
                            min-height: 500px;">
                    </div>
                </div>
            </div>
        </div>

        
    </section>
    <!-- banner section ending here -->


    <!-- Achievement section start here -->
    <div class="achievement-section padding-tb">
        <div class="container">
            <!-- Stats Top -->
            <div class="section-header text-center">
                <span class="subtitle" style="color:#ed3532;">START TO SUCCESS</span>
                <h2 class="title" style="color:#1b2954;">Achieve Your Goals With DSA Academy</h2>
            </div>

            <div class="section-wrapper">
                <div class="counter-part mb-5">
                    <div class="row g-4 row-cols-lg-4 row-cols-sm-2 row-cols-1 justify-content-center">
                        <div class="col">
                            <div class="count-item text-center">
                                <h2><span class="count">{{ $stats['experience'] }}</span>+</h2>
                                <p>Years of Education Experience</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="count-item text-center">
                                <h2><span class="count">{{ $stats['students'] }}</span>+</h2>
                                <p>Students Trained</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="count-item text-center">
                                <h2><span class="count">{{ $stats['teachers'] }}</span>+</h2>
                                <p>Expert Instructors</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="count-item text-center">
                                <h2><span class="count">{{ $stats['courses'] }}</span>+</h2>
                                <p>Certified Courses</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- YouTube Section -->
                <div class="achieve-part mt-4">
                    <div class="row g-4 row-cols-1 row-cols-md-2 row-cols-lg-3">
                        @forelse($youtubeVideos as $video)
                            @php
                                $videoId = getYoutubeVideoId($video->youtube_url);
                                $thumbnailUrl = $video->thumbnail
                                    ? asset('storage/app/public/' . $video->thumbnail)
                                    : ($videoId ? 'https://img.youtube.com/vi/' . $videoId . '/hqdefault.jpg' : null);
                            @endphp

                            <div class="col">
                                <div class="p-3 bg-white shadow-sm rounded-3 d-flex align-items-center h-100" style="min-height: 200px;">
                                    <!-- Thumbnail -->
                                    @if($thumbnailUrl)
                                        <div class="me-3" style="width: 200px; height: 150px; flex-shrink: 0;">
                                            <a href="{{ $video->youtube_url }}" target="_blank">
                                                <img src="{{ $thumbnailUrl }}" alt="{{ $video->title }}" class="w-100 h-100 object-fit-cover rounded-2">
                                            </a>
                                        </div>
                                    @endif

                                    <!-- Text Content -->
                                    <div class="flex-grow-1">
                                        <h6 class="mb-2 text-dark fw-bold">{{ Str::limit($video->title, 60) }}</h6>
                                        <a href="{{ $video->youtube_url }}" target="_blank" class="btn btn-sm btn-outline-danger">
                                            Watch on YouTube <i class="icofont-play-alt-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center">
                                <p class="text-muted">No YouTube videos found.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
    
    
    
    <!-- About DSA Academy Section -->
    <div class="padding-tb section-bg about-dsa-bg" >
        <div class="container" >
            <div class="row justify-content-center align-items-center" >
                <!-- Left Column: About Content -->
                <div class="col-lg-5 col-12">
                    <div class="section-header mb-4" >
                        <span class="subtitle text-danger">About DSA Academy</span>
                        <h2 class="title" style="color:#1b2954;">Empowering Your Future With Practical Skills</h2>
                        <p class="mt-3">
                            DSA Academy is a leading education provider focused on delivering high-quality, practical training in IT, business, and professional development. 
                            We empower individuals through hands-on learning, expert instructors, and industry-recognized certifications—ensuring you're ready for the real world.
                        </p>
                        <a href="{{ route('frontend.Course') }}"  class="lab-btn mt-4"><span>Explore Our Courses</span></a>
                    </div>
                </div>

                <!-- Right Column: Highlights -->
                <div class="col-lg-7 col-12">
                    <div class="section-wrapper">
                        <div class="row g-4 justify-content-center row-cols-sm-2 row-cols-1">
                            <div class="col">
                                <div class="skill-item">
                                    <div class="skill-inner d-flex align-items-start">
                                        <div class="skill-thumb me-3 mb-2">
                                            <img src="{{ asset('frontend/assets/images/instructor.png') }}" alt="Skilled Instructors" style="width:50px;">
                                        </div>
                                        <div class="skill-content">
                                            <h5>Experienced Instructors</h5>
                                            <p>Learn from professionals with real-world experience.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="skill-item">
                                    <div class="skill-inner d-flex align-items-start">
                                        <div class="skill-thumb me-3 mb-4">
                                            <img src="{{ asset('frontend/assets/images/cetificate.png') }}" alt="Certificates" style="width:50px;">
                                        </div>
                                        <div class="skill-content">
                                            <h5>Recognized Certifications</h5>
                                            <p>Stand out with industry-recognized qualifications.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="skill-item">
                                    <div class="skill-inner d-flex align-items-start">
                                        <div class="skill-thumb me-3 mb-3">
                                            <img src="{{ asset('frontend/assets/images/world-grid.png') }}" alt="Online Classes" style="width:50px;">
                                        </div>
                                        <div class="skill-content">
                                            <h5>Flexible Learning</h5>
                                            <p>Choose online or in-person learning modes.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="skill-item">
                                    <div class="skill-inner d-flex align-items-start">
                                        <div class="skill-thumb me-2 mb-4">
                                            <img src="{{ asset('frontend/assets/images/skill/skill.gif') }}" alt="Practical Training" style="width:50px;">
                                        </div>
                                        <div class="skill-content">
                                            <h5>Practical Approach</h5>
                                            <p>Hands-on projects to apply what you learn.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About DSA Academy Section -->



    <!-- Feedback Slider Section -->
    <div class="student-feedbak-section padding-tb shape-img mb-80">
        <div class="container">
            <div class="section-header text-center mt-4">
                <span class="subtitle">What Students Say</span>
                <h2 class="title">Community Feedback</h2>
            </div>

            <div class="swiper myReviewSwiper">
                <div class="swiper-wrapper">
                    @foreach($reviews as $review)
                        <div class="swiper-slide">
                            <div class="stu-feed-item p-4 border rounded bg-white shadow-sm text-center h-100 d-flex flex-column justify-content-between">
                                
                                <!-- Top: Student Image -->
                                <div class="mb-4">
                                    <img src="{{ $review->image ? asset('storage/app/public/' . $review->image) : asset('frontend/assets/images/default-user.png') }}"
                                        alt="{{ $review->student_name }}"
                                        class="mx-auto d-block shadow rounded"
     style="width: 250px; height: 200px; object-fit: cover;">
                                </div>

                                <!-- Bottom: Name & Rating -->
                                <div>
                                    <h6 class="mb-2">{{ $review->student_name }}</h6>
                                    <div class="ratting">
                                       @for($i = 1; $i <= 5; $i++)
    <i class="icofont-ui-rating{{ $i <= $review->rating ? '' : '-blank' }}"
       style="color: {{ $i <= $review->rating ? 'gold' : '#ccc' }};"></i>
@endfor

                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Swiper Arrows -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>

    <!-- Swiper Init -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            new Swiper(".myReviewSwiper", {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                breakpoints: {
                    768: { slidesPerView: 2 },
                    1200: { slidesPerView: 3 }
                }
            });
        });
    </script>
    <!-- student feedbak section ending here -->



    <!-- blog section start here -->
    <div class="blog-section padding-tb section-bg">
        <div class="container">
            <div class="section-header text-center">
                <span class="subtitle">FROM OUR BLOG POSTS</span>
                <h2 class="title">More Articles From Resource Blog</h2>
            </div>
            <div class="section-wrapper">
                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 justify-content-center g-4">

                    @forelse($latestBlogs as $blog)
                        <div class="col">
                            <div class="post-item">
                                <div class="post-inner">
                                    
                                    <!-- Media (Image or Video) -->
                                    <div class="post-thumb" style="height: 250px; overflow: hidden;">
                                        @if($blog->media_type === 'image' && $blog->media_path)
                                            <a href="#">
                                                <img src="{{ asset('storage/app/public/' . $blog->media_path) }}" alt="{{ $blog->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                                            </a>
                                        @elseif($blog->media_type === 'video' && $blog->media_path)
                                            <video width="100%" height="250" controls style="object-fit: cover;">
                                                <source src="{{ asset('storage/app/public/' . $blog->media_path) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        @else
                                            <img src="{{ asset('frontend/assets/images/blog/default.jpg') }}" alt="default blog" style="width: 100%; height: 100%; object-fit: cover;">
                                        @endif
                                    </div>

                                    <!-- Content -->
                                    <div class="post-content">
                                        <a href="#"><h4>{{ Str::limit($blog->title, 60) }}</h4></a>

                                        <div class="meta-post">
                                            <ul class="lab-ul">
                                                <i class="icofont-ui-user p-2" ></i>DSA Academy
                                                <i class="icofont-calendar m-3"></i>{{ $blog->created_at->format('F d, Y') }}
                                            </ul>
                                        </div>

                                        <p>{{ Str::limit(strip_tags($blog->content), 120) }}</p>
                                    </div>

                                    <!-- Footer -->
                                    <div class="post-footer">
                                        <div class="pf-left">
                                            <a href="#" class="lab-btn-text">
                                                Read more <i class="icofont-external-link"></i>
                                            </a>
                                        </div>
                                        <div class="pf-right">
                                            <i class="icofont-comment"></i>
                                            <span class="comment-count">0</span> {{-- Optional: Dynamic comment count --}}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p class="text-muted">No blog posts found.</p>
                        </div>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
    <!-- blog section ending here -->


    <!-- Promotional Banner Slider Section -->
    <div class="achievement-section padding-tb section-bg">
        <div class="container">
            <div class="section-header text-center mb-4">
                <span class="subtitle" style="color:#ed3532;">Special Promotions</span>
                <h2 class="title" style="color:#1b2954;">Latest Offers & Announcements</h2>
            </div>

            <div class="swiper myAdBannerSwiper">
                <div class="swiper-wrapper">
                    @foreach($banners as $banner)
                        <div class="swiper-slide">
                            <div class="banner-item shadow-sm rounded overflow-hidden">
                                <img src="{{ asset('storage/app/public/' . $banner->image) }}"
                                    alt="Banner Image"
                                    class="w-100"
                                    style="height: 500px; object-fit: cover;">
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Navigation -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>

    <!-- Swiper Init -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            new Swiper(".myAdBannerSwiper", {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                breakpoints: {
                    768: { slidesPerView: 2 },
                    1200: { slidesPerView: 3 }
                }
            });
        });
    </script>




    <!-- course section start here -->
    <div class="course-section padding-tb section-bg">
        <div class="container">
            <div class="section-header text-center">
                <span class="subtitle" style="color:#ed3532;">Featured Courses</span>
                <h2 class="title" style="color:#1b2954;">Pick A Course To Get Started</h2>
            </div>

            <div class="section-wrapper">
                <div class="row g-4 justify-content-center row-cols-xl-3 row-cols-md-2 row-cols-1">
                    @forelse($featuredCourses as $course)
                        <div class="col">
                            <div class="course-item">
                                <div class="course-inner">
                                    <div class="course-thumb">
                                        @if ($course->image)
                                            <img src="{{ asset('public/' . $course->image) }}" alt="{{ $course->name }}" style="height: 350px; width: 100%; object-fit: cover;">
                                        @else
                                            <img src="{{ asset('frontend/assets/images/default-course.jpg') }}" alt="No Image" style="height: 350px; width: 100%; object-fit: cover;">
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
                                            <!-- Read More button -->
                                            <a href="{{ route('frontend.Course_Details', ['id' => $course->course_id]) }}" class="lab-btn-text mb-2 d-inline-block">
                                                Read More <i class="icofont-external-link"></i>
                                            </a>

                                            <div class="fw-bold" style="font-size: 22px; color: #e53935;">
                                                Rs. {{ number_format($course->total_price, 2) }}
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p>No featured courses available at the moment.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <!-- course section ending here -->



<!-- VIP Packages Section Start -->
<div class="course-section padding-tb section-bg">
    <div class="container">
        <div class="section-header text-center">
            <span class="subtitle" style="color:#ed3532;">DSA Special</span>
            <h2 class="title" style="color:#1b2954;">Our VIP Signal Packages</h2>
        </div>

        <div class="section-wrapper">
            <div class="row g-4 justify-content-center row-cols-xl-3 row-cols-md-2 row-cols-1">
                @forelse($vipPackages as $package)
                    <div class="col">
                        <div class="course-item">
                            <div class="course-inner">
                                <!-- Image -->
                                <div class="course-thumb">
                                    <img src="{{ asset('storage/' . $package->image) }}" alt="{{ $package->title }}" style="height:350px; object-fit:cover;">
                                </div>

                                <!-- Content -->
                                <div class="course-content">
                                    <!-- Price -->
                                    <div class="course-category d-flex justify-content-between align-items-center">
                                        <div class="course-price-box">
                                            Rs. {{ number_format($package->price, 2) }}
                                        </div>
                                    </div>

                                    <!-- Title (Linked to Details Page) -->
                                    <a href="{{ route('frontend.vip.package.show', $package->id) }}">
                                        <h5 class="text-truncate mt-2">{{ $package->title }}</h5>
                                    </a>

                                    <!-- Short Description -->
                                    <p>{{ \Illuminate\Support\Str::limit($package->description, 100) }}</p>

                                    <!-- Footer -->
                                    <div class="course-footer">
                                        <div class="course-author">
                                            <a href="#">DSA Academy</a>
                                        </div>
                                        <div class="course-btn">
                                            <a href="{{ route('frontend.vip.package.show', $package->id) }}" class="lab-btn-text">
                                                Read More <i class="icofont-external-link"></i>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p>No VIP packages available at the moment.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
<!-- VIP Packages Section End -->


<!-- Floating Call Center Button -->
<div id="callCenterButton" style="
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #ed3532;
    color: white;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    font-size: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 9999;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
">
    <i class="icofont-phone"></i>
</div>

<!-- Contact Popup -->
<div id="callCenterPopup" style="
    display: none;
    position: fixed;
    bottom: 90px;
    right: 20px;
    width: 250px;
    max-height: 300px;
    overflow-y: auto;
    background: #fff;
    border: 1px solid #ccc;
    border-radius: 10px;
    padding: 15px;
    box-shadow: 0 6px 12px rgba(0,0,0,0.15);
    z-index: 9999;
">
    <h6 class="mb-2 text-danger">📞 Call Center</h6>
    <p class="text-muted mb-2" style="font-size: 13px;">Contact us for more details</p>
    <ul id="callCenterList" class="list-unstyled mb-0" style="font-size: 14px;"></ul>
</div>


@if($bannersss->count())
<div id="popupBanner" style="
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.6);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
">
    <div style="
        position: relative;
        max-width: 700px;
        width: 90%;
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    ">

        <!-- Close Button -->
        <button type="button" class="popup-close-btn" style="
            position: absolute;
            top: 10px;
            right: 10px;
            background: #ed3532;
            color: white;
            border: none;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            font-size: 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10000;
        ">&times;</button>

        <!-- Swiper for Banner Images -->
        <div class="swiper popupSwiper">
            <div class="swiper-wrapper">
                @foreach($bannersss as $banner)
                    <div class="swiper-slide">
                        <img src="{{ asset('storage/' . $banner->image) }}" alt="Banner" style="width: 100%; height: 350px; object-fit: cover;">
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>

        <!-- Form -->
        <div style="padding: 20px;">
            <h5 class="text-center text-danger mb-3">Get More Details</h5>
            <form id="bannerLeadForm">
                <div class="mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                </div>
                <div class="mb-3">
                    <input type="text" name="phone" class="form-control" placeholder="Contact Number" required>
                </div>
                <button type="submit" class="btn btn-danger w-100">Submit</button>
                <div id="formSuccessMsg" class="text-success text-center mt-2" style="display: none;">
                    ✅ Our agents will contact you soon.
                </div>
            </form>
        </div>
    </div>
</div>
@endif









@endsection


@push('script')
<script>
document.addEventListener("DOMContentLoaded", function () {
    const button = document.getElementById('callCenterButton');
    const popup = document.getElementById('callCenterPopup');
    const list = document.getElementById('callCenterList');

    if (!button || !popup || !list) return;

    button.addEventListener('click', function () {
        popup.style.display = popup.style.display === 'block' ? 'none' : 'block';

        if (popup.style.display === 'block' && list.children.length === 0) {
            fetch('{{ route('callcenter.contacts') }}')
                .then(res => res.json())
                .then(data => {
                    list.innerHTML = ''; // Clear previous
                    if (data.length === 0) {
                        list.innerHTML = "<li>No contacts available.</li>";
                    } else {
                        data.forEach(contact => {
                            const li = document.createElement('li');
                            li.classList.add('mb-2');
                            li.innerHTML = `<strong>${contact.name}</strong><br><a href="tel:${contact.phone_number}">${contact.phone_number}</a>`;
                            list.appendChild(li);
                        });
                    }
                })
                .catch(err => {
                    console.error(err);
                    list.innerHTML = "<li>Failed to load contacts.</li>";
                });
        }
    });

    document.addEventListener("click", function (e) {
        if (!popup.contains(e.target) && !button.contains(e.target)) {
            popup.style.display = "none";
        }
    });
});
</script>
@endpush


@push('script')
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Swiper init
    new Swiper('.popupSwiper', {
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        }
    });

    // Close button functionality
    const closeBtn = document.querySelector('.popup-close-btn');
    const popup = document.getElementById('popupBanner');
    if (closeBtn && popup) {
        closeBtn.addEventListener('click', () => {
            popup.style.display = 'none';
        });
    }

    // AJAX form submission
    const form = document.getElementById('bannerLeadForm');
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const data = new FormData(form);

        fetch('{{ route("popup.contact.submit") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: data
        })
        .then(res => res.json())
        .then(response => {
            if (response.success) {
                form.reset();
                document.getElementById('formSuccessMsg').style.display = 'block';
            } else {
                alert('Something went wrong. Try again.');
            }
        })
        .catch(err => {
            console.error(err);
            alert('Error submitting the form.');
        });
    });
});
</script>
@endpush

