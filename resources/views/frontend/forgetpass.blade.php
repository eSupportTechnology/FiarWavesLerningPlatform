@extends('frontend.master')

@section('title', 'Home - Edukon')

@section('content')

    <!-- Page Header section start here -->
    <div class="pageheader-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="pageheader-content text-center">
                        <h2>Login Page</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Forget Password</li>
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
                <h3 class="title">Forget Password</h3>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form class="account-form" method="POST" action="{{ route('password.emailNew') }}">
                    @csrf
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email">
                    </div>
                    {{-- <div class="form-group">
                        <input type="text" placeholder="G-123456">
                    </div> --}}
                    <div class="form-group text-center">
                        <button type="submit" class="d-block lab-btn"><span>Email Password Reset Link</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Login Section Section Ends Here -->


@endsection
