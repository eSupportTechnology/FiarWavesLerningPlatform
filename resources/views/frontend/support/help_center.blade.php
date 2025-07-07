@extends('frontend.master')

@section('title', 'Help Center - Edukon')

@section('content')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
        /* Enhanced Pageheader Section with Beautiful Gradient - Matching Login Page */
        .pageheader-section {
            position: relative;
            min-height: 300px;
            background: linear-gradient(135deg, #1a1a1a 0%, #2c2c2c 25%, #E85D04 75%, #d34a02 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        /* Animated background patterns */
        .pageheader-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 80%, rgba(232, 93, 4, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(232, 93, 4, 0.2) 0%, transparent 50%);
            animation: backgroundMove 20s ease-in-out infinite;
        }

        @keyframes backgroundMove {
            0%, 100% { transform: translateX(0) translateY(0); }
            25% { transform: translateX(-20px) translateY(-10px); }
            50% { transform: translateX(20px) translateY(-20px); }
            75% { transform: translateX(-10px) translateY(10px); }
        }

        /* Content styling */
        .pageheader-content {
            position: relative;
            z-index: 2;
            color: white;
            text-align: center;
            padding: 60px 20px;
        }

        .pageheader-content h2 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 0 2px 20px rgba(0, 0, 0, 0.3);
            letter-spacing: -1px;
        }

        /* Enhanced breadcrumb styling */
        .pageheader-content .breadcrumb {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 25px;
            padding: 8px 20px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            white-space: nowrap;
            margin: 0 auto;
            font-weight: 500;
            font-size: 1rem;
            line-height: 1 !important;
            height: auto !important;
            vertical-align: middle !important;
        }

        .pageheader-content .breadcrumb-item {
            font-weight: 500;
            font-size: 1rem;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            white-space: nowrap;
            line-height: 1 !important;
            margin: 0 !important;
            padding: 0 !important;
            height: 100% !important;
            vertical-align: middle !important;
        }

        .pageheader-content .breadcrumb-item a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            transition: all 0.3s ease;
            padding: 4px 8px;
            border-radius: 20px;
            display: inline-flex !important;
            align-items: center !important;
            line-height: 1 !important;
            height: 100% !important;
            vertical-align: middle !important;
        }

        .pageheader-content .breadcrumb-item a:hover {
            color: white;
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .pageheader-content .breadcrumb-item.active {
            color: white;
            font-weight: 600;
            display: inline-flex !important;
            align-items: center !important;
            line-height: 1 !important;
            margin: 0 !important;
            padding: 4px 8px !important;
            height: 100% !important;
            vertical-align: middle !important;
        }

        .pageheader-content .breadcrumb-item + .breadcrumb-item::before {
            content: "→";
            color: rgba(255, 255, 255, 0.7);
            font-weight: bold;
            margin: 0 8px;
            float: none !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            line-height: 1 !important;
            height: 100% !important;
            vertical-align: middle !important;
            font-size: 16px !important;
            padding: 0 !important;
        }

        /* Floating elements for visual appeal */
        .pageheader-section::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: linear-gradient(45deg, rgba(232, 93, 4, 0.2), rgba(232, 93, 4, 0.1));
            border-radius: 50%;
            top: -100px;
            right: -100px;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .pageheader-section {
                min-height: 250px;
            }
            
            .pageheader-content {
                padding: 40px 15px;
            }
            
            .pageheader-content h2 {
                font-size: 2.2rem;
            }
            
            .pageheader-content .breadcrumb {
                padding: 8px 16px;
                font-size: 0.9rem;
                flex-wrap: nowrap !important;
                overflow-x: auto;
            }
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
