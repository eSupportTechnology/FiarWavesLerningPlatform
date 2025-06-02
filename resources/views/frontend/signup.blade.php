@extends('frontend.master')

@section('title', 'Home - DSA Academy')

@section('content')

    <!-- Page Header section start here -->
    <div class="pageheader-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="pageheader-content text-center">
                        <h2>Register Now</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">SIGN UP</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header section ending here -->

    <!-- Login Section Section Starts Here -->
    <div class="login-section padding-tb section-bg">
        <div class="container">
            <div class="account-wrapper">
                <h3 class="title">Register Now</h3>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form class="account-form"  action="{{ route('customer.register.submit') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" placeholder="Full Name" name="name">
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Email" name="email">
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Contact Number" name="contact_number" value="{{ old('contact_number') }}">
                        @error('contact_number') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="Password" name="password">
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="Confirm Password" name="password_confirmation">
                    </div>
                    <div class="form-group">
                        <button class="lab-btn"><span>Get Started Now</span></button>
                    </div>
                </form>
                

                <span class="d-block cate">Are you an old student? 
                    <a href="{{ route('customer.old.register') }}" class="text-primary fw-bold">Click Here</a>
                </span>

                <hr class="my-3">
                
                <div class="account-bottom">
                    <span class="d-block cate pt-10">Are you a member? <a href="{{ route('customer.login') }}">Login</a></span>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Login Section Section Ends Here -->
     
    @endsection
