@extends('frontend.master')

@section('title', 'Verify Email - DSA Academy')

@section('content')

<!-- Page Header section start here -->
<div class="pageheader-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="pageheader-content text-center">
                    <h2>Email Verification</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Verify Email</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Header section ending here -->

<!-- Verification Section -->
<div class="login-section padding-tb section-bg">
    <div class="container">
        <div class="account-wrapper">
            <h3 class="title">Enter the 4-digit code sent to your Mobile</h3>

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('customer.verify.code') }}" method="POST" class="account-form">
                @csrf
                <input type="hidden" name="email" value="{{ session('email') }}">
                <div class="form-group">
                    <input type="text" name="code" class="form-control" placeholder="Enter 6-digit code" required>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="lab-btn"><span>Verify Code</span></button>
                </div>
            </form>

            
        </div>
    </div>
</div>
<!-- Verification Section Ends Here -->

@endsection
