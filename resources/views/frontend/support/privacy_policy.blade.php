@extends('frontend.master')

@section('title', 'Privacy Policy - Edukon')

@section('content')

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
            background-image: url('{{ asset('assets/images/privacy-banner.jpg') }}');
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
                <h4>1. Introduction</h4>
                <p>
                    At Edukon, your privacy is important to us. This Privacy Policy outlines the types of personal
                    information we collect, how it is used, and the measures we take to protect it.
                </p>

                <h4>2. Information We Collect</h4>
                <p>
                    We may collect personal information such as your name, email address, phone number, and any other
                    information you voluntarily provide when registering, submitting forms, or contacting support.
                </p>

                <h4>3. How We Use Your Information</h4>
                <p>
                    Your data is used to improve our services, communicate with you, respond to inquiries, and provide
                    support. We may also use your information to send relevant updates or marketing emails with your
                    consent.
                </p>

                <h4>4. Cookies and Tracking</h4>
                <p>
                    We use cookies to enhance your experience on our website, analyze traffic, and personalize content.
                    You may choose to disable cookies via your browser settings, though some site features may not work
                    correctly.
                </p>

                <h4>5. Data Protection</h4>
                <p>
                    We implement industry-standard security measures to protect your data from unauthorized access or
                    disclosure. However, no method of transmission over the Internet is completely secure.
                </p>

                <h4>6. Third-Party Links</h4>
                <p>
                    Our website may contain links to external sites. We are not responsible for the privacy practices
                    or content of these third-party websites.
                </p>

                <h4>7. Changes to This Policy</h4>
                <p>
                    Edukon reserves the right to update this Privacy Policy at any time. We encourage users to check
                    this page periodically for any changes.
                </p>

                <h4>8. Contact Us</h4>
                <p>
                    If you have any questions about this Privacy Policy, you may contact us at:
                    <br>Email: <a href="mailto:support@edukon.lk">support@edukon.lk</a>
                </p>
            </div>
        </div>
    </div>

@endsection
