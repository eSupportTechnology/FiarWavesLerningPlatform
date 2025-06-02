@extends('frontend.master')

@section('title', 'Booking Successful - DSA Academy')

@section('content')

<!-- Success Page Header -->
<div class="pageheader-section">
    <div class="container">
        <div class="pageheader-content text-center">
            <h2>Booking Successful</h2>
        </div>
    </div>
</div>

<!-- Success Message Section -->
<div class="login-section padding-tb section-bg">
    <div class="container text-center">
        <div class="card border-0 shadow-sm p-5 bg-white">
            <img src="{{ asset('frontend/assets/images/scs.png') }}" alt="Success" class="mb-4 mx-auto d-block" style="width: 120px;">

            <h3 class="text-success mb-3">Your Order Has Been Received!</h3>
            <p class="text-muted">Thank you for your booking. Our team will verify your payment and confirm your enrollment shortly.</p>

            <a href="{{ route('frontend.Course') }}" class="btn btn-outline-primary mt-4">Explore More Courses</a>
        </div>
    </div>
</div>

@endsection
