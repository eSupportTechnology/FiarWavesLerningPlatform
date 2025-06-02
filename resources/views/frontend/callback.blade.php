@extends('frontend.master')

@section('title', 'Booking Status - DSA Academy')

@section('content')
<div class="pageheader-section">
    <div class="container">
        <div class="pageheader-content text-center">
            <h2>Booking Status</h2>
        </div>
    </div>
</div>

<div class="login-section padding-tb section-bg">
    <div class="container text-center">
        <div class="card border-0 shadow-sm p-5 bg-white">
            @if($status === 'success')
                <h2 class="text-success">🎉 Payment Successful!</h2>
                <p>{{ $message }}</p>
            @elseif($status === 'pending')
                <h2 class="text-warning">⏳ Payment Processing...</h2>
                <p>{{ $message }}</p>
                <p>Booking Reference: <strong>{{ $reference }}</strong></p>
                <p class="mt-3">Please wait or refresh this page after a few moments.</p>
            @else
                <h2 class="text-danger">❌ Unable to Confirm Payment</h2>
                <p>{{ $message }}</p>
            @endif
            <a href="{{ route('frontend.home') }}" class="btn btn-primary mt-4">Back to Home</a>
        </div>
    </div>
</div>
@endsection
