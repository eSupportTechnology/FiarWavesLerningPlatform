@extends('frontend.master')

@section('title', 'Booking Failed - DSA Academy')

@section('content')

<!-- Failed Page Header -->
<div class="pageheader-section">
    <div class="container">
        <div class="pageheader-content text-center">
            <h2>Booking Status</h2>
        </div>
    </div>
</div>

<!-- Failed Message Section -->
<div class="login-section padding-tb section-bg">
    <div class="container text-center">
        <div class="card border-0 shadow-sm p-5 bg-white">
            <div class="container text-center mt-5">
                <h2 class="text-danger">❌ Payment Failed!</h2>
                <p>Unfortunately, your payment did not go through. Please try again or contact support if the issue persists.</p>
                <a href="{{ route('frontend.Course') }}" class="btn btn-warning mt-4">Try Again</a>
            </div>
        </div>
    </div>
</div>

@endsection
