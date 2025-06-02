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
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
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
                <form class="account-form">
                    <div class="form-group">
                        <input type="text" placeholder="Phone / Email">
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="G-123456">
                    </div>
                    <div class="form-group text-center">
                        <button class="d-block lab-btn"><span>Reset My Password</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Login Section Section Ends Here -->


    @endsection 