@extends('frontend.master')

@section('title', 'Privacy Policy - Better Way Education')

@section('content')

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

        .policy-content h4 {
            margin-top: 30px;
        }

        .policy-content p {
            text-align: justify;
        }
    </style>

    <!-- ✅ Page Header -->
    <div class="pageheader-section">
        <div class="container">
            <div class="pageheader-content text-center">
                <h2>Privacy Policy</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Privacy Policy</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- ✅ Privacy Policy Content -->
    <div class="help-center-section padding-tb bg-white">
        <div class="container">
            <div class="policy-content">
                <div class="mb-4">
                    <h3>🔒 Privacy Policy</h3>
                    <p><strong>Effective Date:</strong> 07/07/2025</p>
                    <p class="lead">At <strong>Better Way Education</strong>, your privacy is important to us. This policy explains how we collect, use, and protect your information.</p>
                </div>

                <h4>1. Information We Collect</h4>
                <p>We collect basic personal information to provide and improve our services, including:</p>
                <ul>
                    <li>Your name, email address, and other details used to create your account.</li>
                    <li>Course access and usage data.</li>
                    <li>Cookies and analytics data for website functionality and performance tracking.</li>
                </ul>

                <h4>2. How We Use Your Information</h4>
                <ul>
                    <li>To deliver course content and account-related services.</li>
                    <li>To personalize and enhance your learning experience.</li>
                    <li>To send updates, offers, and notifications (you can unsubscribe anytime).</li>
                </ul>

                <h4>3. Data Protection</h4>
                <ul>
                    <li>We do not sell your data to any third parties.</li>
                    <li>Payment details are not stored on our servers; they are securely handled by third-party gateways like PayHere.</li>
                    <li>We implement standard security measures to protect your data.</li>
                </ul>

                <h4>4. Cookies</h4>
                <ul>
                    <li>We use cookies to enhance site performance, gather analytics, and remember your preferences.</li>
                    <li>You can control or disable cookies through your browser settings.</li>
                </ul>

                <h4>5. Updates to This Policy</h4>
                <ul>
                    <li>We may update our Privacy Policy from time to time.</li>
                    <li>Any changes will be notified on our website or via email.</li>
                </ul>

                <h4>6. Contact</h4>
                <p>For any privacy-related questions or concerns:</p>
                <ul>
                    <li>📧 <strong>Email:</strong> <a href="mailto:betterwaylk@gmail.com">betterwaylk@gmail.com</a></li>
                    <li>🌐 <strong>Website:</strong> <a href="https://www.betterway.lk" target="_blank">https://www.betterway.lk</a></li>
                </ul>
            </div>
        </div>
    </div>

@endsection
