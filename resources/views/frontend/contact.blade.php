@extends('frontend.master')

@section('title', 'Home - Edukon')

@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<style>
.pageheader-section {
    position: relative;
    height: 500px;
    overflow: hidden;
}
.pageheader-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('{{ asset('assets/images/international-cover1.jpeg') }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    filter: blur(5px);
    z-index: 1;
}
.contact-item i {
    font-size: 24px;
}
</style>

<!-- ✅ Page Header section -->
<div class="pageheader-section">
    <div class="container">
        <div class="pageheader-content text-center">
            <h2>Get In Touch With Us</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- ✅ Map & Main Office Info -->
<div class="map-address-section padding-tb section-bg">
    <div class="container">
        <div class="section-header text-center">
            <span class="subtitle" style="color: #ee1831;">Main Office</span>
            <h2 class="title">We’re Always Eager To Hear From You!</h2>
        </div>
        <div class="row flex-row-reverse">
            <!-- Map -->
            <div class="col-xl-8 col-lg-7 col-12">
                <div class="map-area">
                    <div class="maps">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63319.92695043451!2d79.91882435000002!3d6.9776795!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae256634982c6f7%3A0x4018010c1909b6aa!2sKadawatha!5e0!3m2!1sen!2slk!4v1711828854992" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>

            <!-- Main Office Info -->
            <div class="col-xl-4 col-lg-5 col-12">
                <div class="contact-wrapper">
                    <div class="contact-item">
                        <div class="contact-thumb">
                            <i class="fas fa-map-marker-alt text-primary"></i>
                        </div>
                        <div class="contact-content">
                            <h6 class="title">Main Office</h6>
                            <p>Kirillawela, Kadawatha 11850</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-thumb">
                            <i class="fas fa-phone-alt text-primary"></i>
                        </div>
                        <div class="contact-content">
                            <h6 class="title">Phone</h6>
                            <p>074 002 0222 / 070 360 0690</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-thumb">
                            <i class="fas fa-envelope text-primary"></i>
                        </div>
                        <div class="contact-content">
                            <h6 class="title">Email</h6>
                            <a href="mailto:dsacademy995@gmail.com">dsacademy995@gmail.com</a>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-thumb">
                            <i class="fas fa-globe text-primary"></i>
                        </div>
                        <div class="contact-content">
                            <h6 class="title">Website</h6>
                            <a href="#">DSA.lk</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ✅ Branch Offices -->
<div class="contact-section padding-tb bg-white">
    <div class="container">
        <div class="section-header text-center">
            <span class="subtitle text-danger">Our Branches</span>
            <h2 class="title">You Can Also Reach Us At</h2>
        </div>
        <div class="row g-4 justify-content-center">
            <!-- Branch 1 -->
            <div class="col-md-4">
                <div class="card text-center shadow-sm h-100">
                    <div class="card-body">
                        <i class="fas fa-university fa-2x text-primary mb-3"></i>
                        <h5 class="card-title">Kadawatha Branch</h5>
                        <p>NO.446/A/01, RANMUTHUGALA, KADAWATHA </p>
                    </div>
                </div>
            </div>
            <!-- Branch 2 -->
            <div class="col-md-4">
                <div class="card text-center shadow-sm h-100">
                    <div class="card-body">
                        <i class="fas fa-university fa-2x text-primary mb-3"></i>
                        <h5 class="card-title">Kurunagala Branch</h5>
                        <p>Near Old Sathosa, Yanthampalawa, Kurunegala</p>
                    </div>
                </div>
            </div>
            <!-- Branch 3 -->
            <div class="col-md-4">
                <div class="card text-center shadow-sm h-100">
                    <div class="card-body">
                        <i class="fas fa-university fa-2x text-primary mb-3"></i>
                        <h5 class="card-title">Dehiaththakandiya Branch</h5>
                        <p>Main Road , Dehiaththakandiya</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- ✅ Contact Form -->
<div class="contact-section padding-tb">
    <div class="container">
        <div class="section-header text-center">
            <span class="subtitle">Contact Us</span>
            <h2 class="title">Fill the form to reach us</h2>
        </div>
        <div class="section-wrapper">
            <form class="contact-form" action="contact.php" method="POST">
                <div class="form-group">
                    <input type="text" name="name" placeholder="Your Name" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" placeholder="Your Email" required>
                </div>
                <div class="form-group">
                    <input type="text" name="phone" placeholder="Phone" required>
                </div>
                <div class="form-group">
                    <input type="text" name="subject" placeholder="Subject" required>
                </div>
                <div class="form-group w-100">
                    <textarea name="message" rows="6" placeholder="Your Message" required></textarea>
                </div>
                <div class="form-group w-100 text-center">
                    <button class="lab-btn"><span>Send Message</span></button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
