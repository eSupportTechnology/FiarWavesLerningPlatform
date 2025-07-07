@extends('frontend.master')

@section('title', 'Terms & Conditions - Better Way Education')

@section('content')

    <style>
        /* Enhanced Pageheader Section with Beautiful Gradient - Matching Login Page */
        .pageheader-section {
            posi                <h4>7. Intellectual Property</h4>r                <h4>7. Business Terms</h4>
                <ul>
                    <li>Our services are educational in nature and do not guarantee exam success, job placement, or certification unless explicitly stated.</li>
                    <li>Content is subject to updates, improvements, or removal.</li>
                    <li>We may send emails about new courses, updates, or offers — you can unsubscribe anytime.</li>
                    <li>We reserve the right to change pricing or policies at any time with notice.</li>
                </ul>ive;
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

        .terms-content h4 {
            margin-top: 30px;
        }

        .terms-content p {
            text-align: justify;
        }
    </style>

    <!-- ✅ Page Header -->
    <div class="pageheader-section">
        <div class="container">
            <div class="pageheader-content text-center">
                <h2>Terms & Conditions</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Terms & Conditions</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- ✅ Terms Content -->
    <div class="help-center-section padding-tb bg-white">
        <div class="container">
            <div class="terms-content">
                <div class="mb-4">
                    <p><strong>Effective Date:</strong> 07/07/2025</p>
                    <p class="lead">Welcome to <strong>Better Way Education</strong>!</p>
                    <p>These Terms and Conditions ("Terms") govern your use of our website, courses, and services. By registering or making a purchase, you agree to these Terms.</p>
                </div>

                <h4>1. About Us</h4>
                <p>
                    We offer online educational courses and learning materials through our website <a href="https://www.betterway.lk" target="_blank">https://www.betterway.lk</a>. Our goal is to provide quality learning content and support to help students grow.
                </p>

                <h4>2. User Accounts</h4>
                <ul>
                    <li>You must create an account to access paid courses.</li>
                    <li>You are responsible for keeping your login details secure.</li>
                    <li>Do not share your account with others.</li>
                    <li>We reserve the right to suspend or terminate accounts for any misuse or policy violations.</li>
                </ul>

                <h4>3. Course Access</h4>
                <ul>
                    <li>Once purchased, courses are accessible through your account.</li>
                    <li>Access may be limited by time (e.g., 6 months), depending on the course.</li>
                    <li>Do not download, copy, or share course content without permission.</li>
                </ul>

                <h4>4. Payments</h4>
                <ul>
                    <li>All prices are shown in LKR.</li>
                    <li>Payments are processed securely via trusted payment gateways (e.g., PayHere).</li>
                    <li>We do not store your payment information.</li>
                </ul>

                <h4>5. Return & Refund Policy</h4>
                <p>We want you to be satisfied. If you're not happy with a course:</p>
                <ul>
                    <li>Full refund available within 3 days of purchase.</li>
                    <li>No refunds will be issued after 3 days.</li>
                    <li>To request a refund, email us at <a href="mailto:betterwaylk@gmail.com">betterwaylk@gmail.com</a> with your course name and reason.</li>
                </ul>

                <h4>6. Business Terms</h4>
                <ul>
                    <li>Our services are educational and do not guarantee exam success, job placement, or certification unless explicitly stated.</li>
                    <li>Content is subject to updates, improvements, or removal.</li>
                    <li>We may send emails about new courses, updates, or offers — you can unsubscribe anytime.</li>
                    <li>We reserve the right to change pricing or policies at any time with notice.</li>
                </ul>

                <!--h4>7. Governing Law</h4>
                <p>
                    Any claims relating to Edukon’s website shall be governed by the laws of Sri Lanka, without regard to its conflict of law provisions.
                </p-->

                <h4>7. Intellectual Property</h4>
                <ul>
                    <li>All content on this site — videos, PDFs, quizzes, logos, and graphics — is owned by <a href="https://www.betterway.lk" target="_blank">betterway.lk</a>.</li>
                    <li>You may not reuse, reproduce, or redistribute any content without written permission.</li>
                </ul>

                <h4>8. Limitation of Liability</h4>
                <ul>
                    <li>We are not responsible for any loss, damage, or interruption caused by website downtime, errors, or third-party issues.</li>
                    <li>Use of the platform is at your own risk.</li>
                </ul>

                <h4>9. Changes to These Terms</h4>
                <ul>
                    <li>We may update these Terms occasionally.</li>
                    <li>We'll notify users via email or a notice on the website.</li>
                    <li>Continued use of the site means you accept the updated Terms.</li>
                </ul>

                <h4>10. Contact Us</h4>
                <p>Have questions? Contact us:</p>
                <ul>
                    <li>📧 <strong>Email:</strong> <a href="mailto:betterwaylk@gmail.com">betterwaylk@gmail.com</a></li>
                    <li>🌐 <strong>Website:</strong> <a href="https://www.betterway.lk" target="_blank">https://www.betterway.lk</a></li>
                </ul>
            </div>
        </div>
    </div>

@endsection
