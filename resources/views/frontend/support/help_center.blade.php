@extends('frontend.master')

@section('title', 'Help Center - Edukon')

@section('content')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
        .pageheader-section {
            position: relative;
            height: 400px;
            overflow: hidden;
        }

        .pageheader-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ asset('assets/images/help-center-banner.jpeg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            filter: blur(4px);
            z-index: 1;
        }

        .pageheader-content {
            position: relative;
            z-index: 2;
            padding-top: 150px;
            color: #fff;
        }

        .accordion-button:focus {
            box-shadow: none;
        }
    </style>

    <!-- ✅ Page Header -->
    <div class="pageheader-section">
        <div class="container">
            <div class="pageheader-content text-center">
                <h2>Help Center</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Help Center</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- ✅ Help Center Main Content -->
    <div class="help-center-section padding-tb bg-white">
        <div class="container">
            <div class="section-header text-center">
                <span class="subtitle text-danger">How Can We Help?</span>
                <h2 class="title">Browse Help Topics</h2>
            </div>

            <div class="row g-4 justify-content-center">
                <div class="col-md-10">
                    <div class="accordion" id="helpAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <i class="fas fa-user-circle me-2 text-primary"></i> Account Management
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                 data-bs-parent="#helpAccordion">
                                <div class="accordion-body">
                                    Learn how to update your profile, change your password, and manage account settings.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <i class="fas fa-lock me-2 text-primary"></i> Privacy & Security
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                 data-bs-parent="#helpAccordion">
                                <div class="accordion-body">
                                    Understand how we protect your data and how you can stay secure on our platform.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <i class="fas fa-credit-card me-2 text-primary"></i> Payments & Subscriptions
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                 data-bs-parent="#helpAccordion">
                                <div class="accordion-body">
                                    Get help with billing, payments, refunds, and managing your subscriptions.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    <i class="fas fa-question-circle me-2 text-primary"></i> General FAQs
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                 data-bs-parent="#helpAccordion">
                                <div class="accordion-body">
                                    Find quick answers to the most commonly asked questions.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
