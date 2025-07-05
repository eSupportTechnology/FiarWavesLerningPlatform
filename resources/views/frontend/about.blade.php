@extends('frontend.master')

@section('title', 'Home - Edukon')

@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<style>
/* Enhanced Pageheader Section with Beautiful Gradient */
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
    letter-spacing: 1px;
}

/* Enhanced breadcrumb styling - Perfect horizontal alignment */
.pageheader-content .breadcrumb {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50px;
    padding: 12px 24px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    flex-wrap: nowrap !important;
    white-space: nowrap;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    margin-bottom: 0 !important;
    margin-top: 0 !important;
    height: 44px !important; /* Fixed height for perfect alignment */
    min-height: 44px !important;
    max-height: 44px !important;
    overflow: hidden;
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
        white-space: nowrap;
        overflow-x: auto;
        scrollbar-width: none;
        -ms-overflow-style: none;
        height: 38px !important;
        min-height: 38px !important;
        max-height: 38px !important;
    }
    
    .pageheader-content .breadcrumb::-webkit-scrollbar {
        display: none;
    }
    
    .pageheader-content .breadcrumb-item + .breadcrumb-item::before {
        margin: 0 6px;
        font-size: 0.9rem !important;
    }
}

@media (max-width: 480px) {
    .pageheader-content h2 {
        font-size: 1.8rem;
    }
    
    .pageheader-content .breadcrumb {
        padding: 6px 12px;
        font-size: 0.8rem;
        flex-wrap: nowrap !important;
        white-space: nowrap;
        overflow-x: auto;
        scrollbar-width: none;
        -ms-overflow-style: none;
        height: 32px !important;
        min-height: 32px !important;
        max-height: 32px !important;
    }
    
    .pageheader-content .breadcrumb::-webkit-scrollbar {
        display: none;
    }
    
    .pageheader-content .breadcrumb-item + .breadcrumb-item::before {
        margin: 0 4px;
        font-size: 0.7rem !important;
    }
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
                            <span class="subtitle" style="color: #ee1831 !important">About Our Better Way</span>
                        </div>
                        <h2 class="title">{{$landingPageContent ? $landingPageContent->about_title : "Good Qualification Services And Better Skills" }}</h2>
                        <p>{{$landingPageContent ? $landingPageContent->about_title_description : "We are a body of professionals specialising in the fields of Management, Marketing, Finance, Human Resources, Education, and Visa guidance. Having worked for decades in industries relevant to our fields, we have now collaborated in order to provide you with the best solution for your business & educational needs. In order to remain a forerunner among competitors, it is our belief that continuous transformation, creativity, and innovation provide a competitive edge within the industry." }}</p>
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
        <p style="color:white">{{$landingPageContent ? $landingPageContent->vision : "We aspire to cultivate a dynamic learning environment that nurtures creativity, critical thinking, and entrepreneurial mindset to our graduates and aim to inspire our students to become catalysts for change, instilling in them a deep understanding of ethical business practices and social responsibility." }}

        </p>
    </div>
    <div class="vis-content-box" style="color: white;">
        <h2 style="color: white;">Our Mission</h2>
        <span class="quote">“</span>
        <p style="color:white">{{$landingPageContent ? $landingPageContent->mission : "Our mission at Imperial College of Business Studies is to empower individuals with knowledge, skills, positive attitude and values that drive business excellence and societal impact. We are dedicated to delivering world-class education, coupled with cutting-edge learning tools, and aim to foster a vibrant community of diverse and innovative thinkers who will become successful business leaders." }}

        </p>
    </div>
</div>

@endsection
