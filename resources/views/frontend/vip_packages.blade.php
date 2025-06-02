@extends('frontend.master')

@section('title', 'VIP Packages - DAS Academy')

@section('content')


<style>
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

</style>

<!-- Page Header section start -->
<div class="pageheader-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="pageheader-content text-center">
                    <h2>VIP Packages</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">VIP Packages</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Header section end -->

<!-- VIP Packages Section Start -->
<div class="course-section padding-tb section-bg">
    <div class="container">
        <div class="section-header text-center">
            <span class="subtitle text-danger">DSA Special</span>
            <h2 class="title" style="color:#1b2954;">Our VIP Signal Packages</h2>
        </div>

        <div class="section-wrapper">
            <div class="row g-4 justify-content-center row-cols-xl-3 row-cols-md-2 row-cols-1">
                @forelse($packages as $package)
                    <div class="col">
                        <div class="course-item">
                            <div class="course-inner">
                                <!-- Image -->
                                <div class="course-thumb">
                                    <img src="{{ asset('storage/' . $package->image) }}" alt="{{ $package->title }}" style="height: 350px; object-fit: cover;">
                                </div>

                                <!-- Content -->
                                <div class="course-content">
                                    <!-- Price + Rating -->
                                    <div class="course-category d-flex justify-content-between align-items-center">
                                            <div class="course " style="backgroud-color:#000;">
                                                
                                            </div>
                                            <!-- Price and Rating Row -->
                                            <div class="course-category d-flex justify-content-between align-items-center">
                                                <div class="course-price-box">
                                                    Rs. {{ number_format($package->price, 2) }}
                                                </div>
                                                
                                            </div>
                                        </div>

                                    <!-- Title -->
                                    <h5 class="text-truncate">{{ $package->title }}</h5>

                                    <!-- Description -->
                                    <p>{{ \Illuminate\Support\Str::limit($package->description, 100) }}</p>

                                    <!-- Footer -->
                                    <div class="course-footer">
                                        <div class="course-author">
                                            <a href="#">DSA Academy</a>
                                        </div>
                                        <div class="course-btn">
                                            <a href="{{ route('frontend.vip.package.show', $package->id) }}" class="lab-btn-text">
                                                Join Now <i class="icofont-external-link"></i>
                                            </a>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">No VIP packages available at the moment.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
<!-- VIP Packages Section End -->

@endsection
