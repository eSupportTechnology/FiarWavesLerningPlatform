@extends('frontend.master')

@section('title', 'Old Student Registration - DSA Academy')

@section('content')

<!-- Page Header section start here -->
<div class="pageheader-section">
    <div class="container">
        <div class="pageheader-content text-center">
            <h2>Old Student Registration</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Old Student Sign Up</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Header section ending here -->

<!-- Old Student Registration Section -->
<div class="login-section padding-tb section-bg">
    <div class="container">
        <div class="account-wrapper">
            <h3 class="title">Welcome Back, Student</h3>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form class="account-form" action="{{ route('customer.old.register.submit') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" placeholder="Student ID" name="student_id" value="{{ old('student_id') }}">
                </div>
                <div class="form-group">
                    <input type="text" placeholder="Full Name" name="name" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <input type="email" placeholder="Email" name="email" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <input type="text" placeholder="Contact Number" name="contact_number" value="{{ old('contact_number') }}">
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Password" name="password">
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Confirm Password" name="password_confirmation">
                </div>
                <div class="form-group">
                    <button class="lab-btn"><span>Register as Old Student</span></button>
                </div>
            </form>

            <div class="account-bottom text-center mt-3">
                <span>New Student? <a href="{{ route('customer.register') }}">Register here</a></span>
            </div>
        </div>
    </div>
</div>
<!-- Old Student Registration Section Ends -->

@endsection
