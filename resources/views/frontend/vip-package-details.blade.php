@extends('frontend.master')

@section('title', $package->title . ' - DAS Academy')

@section('content')

<!-- Page Header section -->
<div class="pageheader-section style-2">
    <div class="container">
        <div class="row justify-content-center justify-content-lg-between align-items-center flex-row-reverse">
            <div class="col-lg-7 col-12">
                <div class="pageheader-thumb">
                    <img src="{{ asset('storage/' . $package->image) }}" alt="{{ $package->title }}" class="w-100 rounded shadow-sm">
                    <a href="https://www.youtube.com" class="video-button" data-rel="lightcase">
                        <i class="icofont-ui-play"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-5 col-12">
                <div class="pageheader-content">
                    <div class="course-category mb-3">
                        <span class="badge bg-danger fs-6">Rs. {{ number_format($package->price, 2) }}</span>
                        <span class="badge bg-success text-white fs-6">VIP Exclusive</span>
                    </div>

                    <h2 class="phs-title mb-3">{{ $package->title }}</h2>

                    <ul class="list-unstyled mb-4 text-dark" style="font-size: 17px; line-height: 1.8;">
                        <li><i class="icofont-check-alt text-success me-2"></i> Daily signals & updates</li>
                        <li><i class="icofont-check-alt text-success me-2"></i> Lifetime channel access</li>
                        <li><i class="icofont-check-alt text-success me-2"></i> 24/7 support</li>
                    </ul>

                    <div class="alert alert-warning py-3 px-4" style="font-size: 16px; line-height: 1.7;">
                        <i class="icofont-light-bulb text-warning me-2"></i> Perfect for serious traders looking to maximize profits!
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Header end -->


<!-- VIP Package Details section -->
<div class="course-single-section padding-tb section-bg">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Main Content -->
            <div class="col-lg-8">
                <div class="main-part">
                    <div class="course-item">
                        <div class="course-inner">
                            <div class="course-content">
                                <h3 class="mb-3">Package Overview</h3>
                                <div class="border rounded p-3 bg-white shadow-sm">
                                    {!! $package->description !!}
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
                        <h4 class="mb-3 text-center text-success">Join Now</h4>

                        <div class="text-center mb-3">
                            <h3 class="text-danger">Rs. {{ number_format($package->price, 2) }}</h3>
                            <small class="text-muted">One-time payment</small>
                        </div>

                        <p class="text-center"><i class="icofont-clock-time"></i> Offer valid this week!</p>

                        <div class="d-grid">
                            <a href="{{ route('vip-packages.book', $package->id) }}" class="btn btn-primary btn-lg">
                                Join VIP Now
                            </a>
                        </div>

                    </div>

                    <!-- Optional Features -->
                    <div class="mt-4 p-3 bg-light rounded shadow-sm">
                        <h6 class="mb-2">This Package Includes:</h6>
                        <ul class="list-unstyled small" style="font-size: 17px; line-height: 1.8;">
                            <li><i class="icofont-check-alt"></i> Private signal group</li>
                            <li><i class="icofont-check-alt"></i> Telegram/WhatsApp alerts</li>
                            <li><i class="icofont-check-alt"></i> Market analysis</li>
                            <li><i class="icofont-check-alt"></i> Direct mentor support</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Sidebar End -->
        </div>
    </div>
</div>
<!-- VIP Package section end -->

@endsection
