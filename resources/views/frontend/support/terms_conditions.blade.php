@extends('frontend.master')

@section('title', 'Terms & Conditions - Edukon')

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
            background-image: url('{{ asset('assets/images/terms-banner.jpg') }}');
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
                <h4>1. Acceptance of Terms</h4>
                <p>
                    By accessing and using the Edukon website, you agree to be bound by these Terms and Conditions and all applicable laws and regulations.
                </p>

                <h4>2. Use License</h4>
                <p>
                    Permission is granted to temporarily download one copy of the materials (information or software) on Edukon's website for personal, non-commercial use only. This is a grant of a license, not a transfer of title.
                </p>

                <h4>3. User Responsibilities</h4>
                <p>
                    Users agree not to misuse the website or its content. Any unauthorized use, including but not limited to hacking, scraping, or attempting to access restricted areas, is strictly prohibited.
                </p>

                <h4>4. Limitations</h4>
                <p>
                    Edukon shall not be held liable for any damages arising out of the use or inability to use the materials on the website, even if Edukon or a representative has been notified orally or in writing of the possibility of such damage.
                </p>

                <h4>5. Revisions and Errata</h4>
                <p>
                    The materials appearing on Edukon's website could include technical, typographical, or photographic errors. Edukon does not warrant that any of the materials are accurate, complete, or current.
                </p>

                <h4>6. Modifications</h4>
                <p>
                    Edukon may revise these Terms and Conditions at any time without notice. By using this website, you agree to be bound by the current version of these terms.
                </p>

                <h4>7. Governing Law</h4>
                <p>
                    Any claims relating to Edukon’s website shall be governed by the laws of Sri Lanka, without regard to its conflict of law provisions.
                </p>

                <h4>8. Contact Information</h4>
                <p>
                    If you have any questions about these Terms and Conditions, feel free to contact us at:
                    <br>Email: <a href="mailto:legal@edukon.lk">legal@edukon.lk</a>
                </p>
            </div>
        </div>
    </div>

@endsection
