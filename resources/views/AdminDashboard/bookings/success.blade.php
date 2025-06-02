@extends('frontend.master')

@section('title', 'Booking Successful - DSA Academy')

@section('content')

<!-- Success Page Header -->
<div class="pageheader-section">
    <div class="container">
        <div class="pageheader-content text-center">
            <h2>Booking Status</h2>
        </div>
    </div>
</div>

<!-- Success Message Section -->
<div class="login-section padding-tb section-bg">
    <div class="container text-center">
        <div class="card border-0 shadow-sm p-5 bg-white">
            <div class="container text-center mt-5">
                <h2 class="text-success">🎉 Payment Successful!</h2>
                <p>Your payment was processed successfully. Thank you for booking with DSA Academy.</p>
                <a href="{{ route('frontend.home') }}" class="btn btn-primary mt-4">Go to Home</a>
            </div>
        </div>
    </div>
</div>

@endsection
