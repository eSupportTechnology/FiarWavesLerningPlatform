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






.vis-container {
    display: flex;
    justify-content: space-around;
    align-items: flex-start;
    background-color:rgb(27, 41, 84);;
    padding: 50px;
    color: white;
    margin-top: 50px; /* Add spacing between sections */
    padding: 20px 10px;
}

.vis-content-box {
    width: 40%;
}

.vis-content-box h2 {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 10px;
}

.vis-content-box h2::after {
    content: '';
    display: block;
    width: 50px;
    height: 5px;
    background-color:  #ee1831 !important;
    margin-top: 5px;
}

.vis-content-box p {
    font-size: 16px;
    line-height: 1.8;
    margin: 20px 0;
}

.vis-content-box .quote {
    font-size: 30px;
    font-weight: bold;
}

.sr-left i {
    color: blue !important; /* Replace with your desired color */
}


</style>

<!-- Pageheader section start here -->
<div class="pageheader-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="pageheader-content text-center">
                        <h2>About Us Page</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">About Us</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Pageheader section ending here -->

<!-- About Us Section Start Here -->
<div class="about-section style-3 padding-tb section-bg">
    <div class="container">
        <div class="row justify-content-center row-cols-xl-2 row-cols-1 align-items-center">
            <div class="col">
                <div class="about-left">
                    <div class="about-thumb">
                        <img src="frontend/assets/images/about/4.png" alt="about">
                    </div>
                    <div class="abs-thumb">
                        <img src="frontend/assets/images/about/5.png" alt="about">
                    </div>
                    <div class="about-left-content">
                        <h3>30+</h3>
                        <p>Years Of Experiences</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="about-right">
                    <div class="section-header">
                        <div class="subtitle">
                            <span class="subtitle" style="color: #ee1831 !important">About Our DSA Academy</span>
                        </div>
                        <h2 class="title">Good Qualification Services And Better Skills</h2>
                        <p>We are a body of professionals specialising in the fields of Management, Marketing, Finance, Human Resources, Education, and Visa guidance. Having worked for decades in industries relevant to our fields, we have now collaborated in order to provide you with the best solution for your business & educational needs. In order to remain a forerunner among competitors, it is our belief that continuous transformation, creativity, and innovation provide a competitive edge within the industry.</p>
                    </div>
                    <div class="section-wrapper">
                        <ul class="lab-ul">
                            <li>
                                <div class="sr-left">
                                    <i class="fas fa-chalkboard-teacher fa-3x" style="color: rgb(18, 89, 254) !important;font-size:50px !important"></i>
                                </div>
                                <div class="sr-right">
                                    <h5>Skilled Instructors</h5>
                                    <p>We provide access to skilled instructors who are ready to share their expertise.</p>
                                </div>
                            </li>
                            <li>
                                <div class="sr-left">
                                    <i class="fas fa-certificate fa-3x"  style="color: rgb(18, 89, 254) !important ;font-size:50px !important"></i>
                                </div>
                                <div class="sr-right">
                                    <h5>Get Certificate</h5>
                                    <p>Earn certificates to showcase your achievements and skills effectively.</p>
                                </div>
                            </li>
                            <li>
                                <div class="sr-left">
                                    <i class="fas fa-laptop fa-3x"  style="color: rgb(18, 89, 254) !important;font-size:50px !important"></i>
                                </div>
                                <div class="sr-right">
                                    <h5>Online Classes</h5>
                                    <p>Access engaging and interactive online classes from anywhere in the world.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About Us Section Ending Here -->

<!-- Vision and Mission Section Start Here -->
<div class="vis-container" style = "margin-left: 90px; margin-right: 90px;margin-bottom:150px;">
    <div class="vis-content-box" style="color: white;">
        <h2 style="color: white;">Our Vision</h2>
        <span class="quote">“</span>
        <p style="color:white">
            We aspire to cultivate a dynamic learning environment that nurtures creativity, critical thinking, and entrepreneurial mindset to our graduates and aim to inspire our students to become catalysts for change, instilling in them a deep understanding of ethical business practices and social responsibility.
        </p>
    </div>
    <div class="vis-content-box" style="color: white;">
        <h2 style="color: white;">Our Mission</h2>
        <span class="quote">“</span>
        <p style="color:white">
            Our mission at Imperial College of Business Studies is to empower individuals with knowledge, skills, positive attitude and values that drive business excellence and societal impact. We are dedicated to delivering world-class education, coupled with cutting-edge learning tools, and aim to foster a vibrant community of diverse and innovative thinkers who will become successful business leaders.
        </p>
    </div>
</div>

@endsection
