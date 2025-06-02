@extends('frontend.master')

@section('title', 'Home - Edukon')

@section('content')

    
    <!-- 404 section start here -->
    <div class="four-zero-section padding-tb section-bg">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="four-zero-content">
                        <a href="index.html">
                            <img src="assets/images/logo/01.png" alt="CodexCoder">
                        </a>
                        <h2 class="title">Error 404!</h2>
                        <p>Oops! The Page You Are Looking For Could Not Be Found</p>
                        <a href="index.html" class="lab-btn"><span>Go Back To Home <i class="icofont-external-link"></i></span></a>
                    </div>
                </div>
                <div class="col-lg-8 col-sm-6 col-12">
                    <div class="foue-zero-thumb">
                        <img src="assets/images/404.png" alt="CodexCoder">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 404 section ending here -->

    @endsection

  