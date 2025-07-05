<!-- header section start here -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>

a {
    text-decoration: none !important;
}

/* Animation for dropdown menu */
@keyframes dropdown-fade-in {
    from {
        opacity: 0;
        transform: translateY(-8px) scale(0.98);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

.header-top a {

}
.header-top a:hover {
    color: #ee1831;
    text-decoration: underline;
}
.signup {
    border: 1px solid white;
    color: white !important;
    font-size: 14px;
    padding: 5px 20px;
    border-radius: 20px;
    text-transform: uppercase;
    margin-left:10px;
}

.signup:hover {
    background-color:rgb(4, 40, 75);
    color: #ee1831 !important;
    border: 1px solid #ee1831;
}

.login {

    border: 1px solid white;
    color: white !important;
    font-size: 14px;
    padding: 5px 20px;
    border-radius: 20px;
    text-transform: uppercase;
    margin-left:10px;
}
.login:hover {
    background-color:rgb(4, 40, 75);
    color: #ee1831 !important;
    border: 1px solid #ee1831;
}

.lab-ul li i{
    color: white !important;
    font-size:20px!important;
}
.lab-ul li i:hover{
    color:  #ee1831 !important;
    font-size:20px!important;
}

@media (max-width: 991px) {
    .dropdown-menu {
        position: absolute !important;
        right: 0 !important;
        left: auto !important;
        transform: translateY(10px);
        min-width: 200px !important; /* Slightly narrower on mobile */
        border-radius: 10px !important;
    }

    .dropdown-toggle::after {
        margin-left: 8px;
    }
    
    /* Improve spacing on mobile */
    .dropdown-menu .dropdown-item {
        padding: 10px 14px !important;
        font-size: 13px !important;
    }
}

/* Enhanced Dropdown Menu Styling */
.dropdown-menu {
    background: white !important;
    border: 1px solid rgba(224, 224, 224, 0.8) !important;
    border-radius: 12px !important;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12) !important;
    padding: 10px 6px !important; /* Improved padding for better spacing */
    margin-top: 10px !important;
    min-width: 220px !important;
    overflow: hidden !important; /* Ensures hover effects don't extend beyond boundaries */
    transform-origin: top right !important;
    animation: dropdown-fade-in 0.2s ease-out !important; /* Subtle animation */
}

.dropdown-menu .dropdown-item {
    padding: 12px 16px !important;
    font-size: 14px !important;
    font-weight: 500 !important;
    color: #333 !important;
    border-radius: 6px !important;
    margin: 2px 6px !important;
    transition: all 0.3s ease !important;
    display: flex !important;
    align-items: center !important;
    width: calc(100% - 12px) !important; /* Ensure items stay within dropdown width */
    max-width: 100% !important; /* Prevent overflow */
    box-sizing: border-box !important; /* Include padding in width calculation */
}

.dropdown-menu .dropdown-item i {
    margin-right: 12px !important;
    font-size: 16px !important;
    width: 24px !important;
    text-align: center !important;
    color: #555 !important;
    transition: all 0.3s ease !important;
    opacity: 0.85 !important; /* Slightly more subtle icons */
}

/* Dashboard Item Hover Effect - Light Blue */
.dropdown-menu .dropdown-item:not(.text-danger):hover {
    background: rgba(173, 216, 230, 0.2) !important;
    color: #1e88e5 !important;
    padding-left: 20px !important; /* Adjusted padding to stay within boundaries */
    box-sizing: border-box !important;
}

.dropdown-menu .dropdown-item:not(.text-danger):hover i {
    color: #1e88e5 !important;
}

/* Logout Item Hover Effect - Red */
.dropdown-menu .dropdown-item.text-danger:hover {
    background: rgba(244, 67, 54, 0.1) !important;
    color: #f44336 !important;
    padding-left: 20px !important; /* Adjusted padding to stay within boundaries */
    box-sizing: border-box !important;
}

.dropdown-menu .dropdown-item.text-danger:hover i {
    color: #f44336 !important;
}

/* Dropdown Divider Styling */
.dropdown-menu .dropdown-divider {
    margin: 8px 0 !important;
    border-color: #e9ecef !important;
}

/* Ensure dropdown items stay within dropdown bounds */
.dropdown-menu {
    overflow: hidden !important; /* Ensures children don't overflow */
}

/* Arrow positioning fix - with proper spacing */
.dropdown-toggle::after {
    margin-left: 13px !important;
    margin-right: 4px !important; /* Add a small gap after dropdown icon */
}

/* Improved profile dropdown button styling */
.login.dropdown-toggle {
    padding: 6px 22px 6px 18px !important; /* Balanced padding */
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 8px !important; /* Space between icon and text */
    border-radius: 20px !important;
    transition: all 0.3s ease !important;
    background-color: rgba(255, 255, 255, 0.08) !important; /* Subtle highlight */
    border: 1px solid rgba(255, 255, 255, 0.2) !important; /* More refined border */
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1) !important; /* Subtle shadow */
}

/* Improve profile dropdown mobile responsiveness */
@media (max-width: 767px) {
    .login.dropdown-toggle {
        padding: 5px 18px 5px 15px !important;
        margin-left: 5px !important;
    }
    
    .login.dropdown-toggle i {
        font-size: 16px !important;
    }
    
    .login.dropdown-toggle span {
        font-size: 12px !important;
        max-width: 100px !important;
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
    }
}

/* Professional Mobile Header Top Enhancement */
@media (max-width: 991px) {
    .header-top {
        display: none; /* Hidden by default on mobile */
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        z-index: 999;
        background: linear-gradient(135deg, rgb(4, 40, 75) 0%, rgb(6, 50, 90) 100%);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        border-bottom: 3px solid #ee1831;
        backdrop-filter: blur(10px);
        animation: slideDown 0.3s ease-out;
    }
    
    .header-top.open {
        display: block !important;
    }
    
    .header-top .header-top-area {
        flex-direction: column;
        padding: 20px 15px;
        gap: 15px;
    }
    
    .header-top .lab-ul.left {
        width: 100%;
        flex-direction: column;
        gap: 12px;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .header-top .lab-ul.left li {
        background: rgba(255, 255, 255, 0.08);
        padding: 12px 16px;
        border-radius: 8px;
        border-left: 4px solid #ee1831;
        transition: all 0.3s ease;
    }
    
    .header-top .lab-ul.left li:hover {
        background: rgba(255, 255, 255, 0.12);
        transform: translateX(5px);
    }
    
    .header-top .lab-ul.left li i {
        color: #ee1831 !important;
        margin-right: 12px;
        font-size: 16px;
        width: 20px;
        text-align: center;
    }
    
    .header-top .lab-ul.left li span {
        color: white;
        font-weight: 500;
        font-size: 14px;
    }
    
    .header-top .social-icons {
        justify-content: center;
        gap: 15px;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .header-top .social-icons li a {
        width: 45px;
        height: 45px;
        background: rgba(255, 255, 255, 0.1);
        border: 2px solid rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    
    .header-top .social-icons li a:hover {
        background: #ee1831;
        border-color: #ee1831;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(238, 24, 49, 0.3);
    }
    
    .header-top .social-icons li a i {
        color: white;
        font-size: 18px;
    }
    
    .header-top .lab-ul.right {
        width: 100%;
        justify-content: center;
        gap: 10px;
    }
    
    .header-top .lab-ul.right .login,
    .header-top .lab-ul.right .signup {
        padding: 10px 20px;
        border-radius: 25px;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }
    
    .header-top .lab-ul.right .login {
        background: rgba(255, 255, 255, 0.1);
        border: 2px solid rgba(255, 255, 255, 0.3);
    }
    
    .header-top .lab-ul.right .signup {
        background: #ee1831;
        border: 2px solid #ee1831;
    }
    
    .header-top .lab-ul.right .login:hover {
        background: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.5);
        transform: translateY(-2px);
    }
    
    .header-top .lab-ul.right .signup:hover {
        background: #d41528;
        border-color: #d41528;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(238, 24, 49, 0.3);
    }
}

/* Enhanced Ellepsis Bar Styling */
.ellepsis-bar {
    position: relative;
    margin-left: 15px;
    padding: 8px;
    border-radius: 50%;
    background: rgba(238, 24, 49, 0.1);
    border: 2px solid rgba(238, 24, 49, 0.2);
    transition: all 0.3s ease;
    cursor: pointer;
}

.ellepsis-bar:hover {
    background: rgba(238, 24, 49, 0.2);
    border-color: rgba(238, 24, 49, 0.4);
    transform: scale(1.1);
}

.ellepsis-bar i {
    color: #ee1831 !important;
    font-size: 20px !important;
    transition: all 0.3s ease;
}

.ellepsis-bar:hover i {
    transform: rotate(180deg);
}

/* Slide down animation */
@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Header wrapper positioning for mobile dropdown */
@media (max-width: 991px) {
    .header-bottom {
        position: relative;
    }
    
    /* Fix profile dropdown positioning in mobile view */
    .header-top .lab-ul.right .nav-item.dropdown {
        position: relative;
    }
    
    .header-top .lab-ul.right .dropdown-menu {
        position: absolute !important;
        top: 100% !important;
        left: 0 !important;
        right: auto !important;
        transform: none !important;
        margin-top: 8px !important;
        min-width: 200px !important;
        border: none !important;
        border-radius: 12px !important;
        background: rgba(255, 255, 255, 0.98) !important;
        backdrop-filter: blur(10px) !important;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
        z-index: 1050 !important;
    }
    
    .header-top .lab-ul.right .dropdown-menu::before {
        content: '';
        position: absolute;
        top: -8px;
        left: 20px;
        width: 0;
        height: 0;
        border-left: 8px solid transparent;
        border-right: 8px solid transparent;
        border-bottom: 8px solid rgba(255, 255, 255, 0.98);
    }
    
    .header-top .lab-ul.right .dropdown-item {
        padding: 12px 20px !important;
        color: #333 !important;
        font-weight: 500 !important;
        border-radius: 8px !important;
        margin: 4px 8px !important;
        transition: all 0.3s ease !important;
    }
    
    .header-top .lab-ul.right .dropdown-item:hover {
        background: rgba(238, 24, 49, 0.1) !important;
        color: #ee1831 !important;
        transform: translateX(5px) !important;
    }
    
    .header-top .lab-ul.right .dropdown-item.text-danger {
        color: #dc3545 !important;
    }
    
    .header-top .lab-ul.right .dropdown-item.text-danger:hover {
        background: rgba(220, 53, 69, 0.1) !important;
        color: #dc3545 !important;
    }
    
    .header-top .lab-ul.right .dropdown-item i {
        margin-right: 10px !important;
        width: 16px !important;
        text-align: center !important;
    }
    
    .header-top .lab-ul.right .dropdown-divider {
        margin: 8px 12px !important;
        border-color: rgba(0, 0, 0, 0.1) !important;
    }
}

</style>


    <header class="header-section">
        <div class="header-top" style=" background-color:rgb(4, 40, 75);
    color: #fff; ">
            <div class="container">
                <div class="header-top-area">
                    <ul class="lab-ul left">
                        <li>
                            <i class="fa fa-envelope"></i> <span>{{$landingPageContent ? $landingPageContent->email : "example@gmail.com" }}</span>
                        </li>
                        <li>
                            <i class="icofont-ui-call"></i> <span>{{$landingPageContent ? $landingPageContent->number_1 : " 074 xxx xxxx" }} / {{$landingPageContent ? $landingPageContent->number_2 : " 070 xxx xxxx" }}</span>
                        </li>
                    </ul>
                    <ul class="lab-ul social-icons d-flex align-items-center">
                        <li><p></p></li>
                        <li>
                            <a href="{{$socialMediaLinks ? $socialMediaLinks->youtube_link : "#" }}" class="youtube" target="_blank" title="YouTube">
                                <i class="icofont-youtube"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{$socialMediaLinks ? $socialMediaLinks->tiktok_link : "#" }}" class="tiktok" target="_blank" title="TikTok">
                                <i class="icofont-twitch"></i> <!-- No TikTok icon, using Twitch as placeholder -->
                            </a>
                        </li>
                        <li>
                            <a href="{{$socialMediaLinks ? $socialMediaLinks->facebook_link : "#" }}" class="facebook" target="_blank" title="Facebook">
                                <i class="icofont-facebook-messenger"></i>
                            </a>
                        </li>
                        {{-- <li>
                            <a href="#" class="facebook" target="_blank" title="Facebook">
                                <i class="icofont-facebook-messenger"></i>
                            </a>
                        </li> --}}
                    </ul>
                    <ul class="lab-ul right d-flex align-items-center gap-2 pr-3">

    @if(session()->has('customer_id'))
        <li class="nav-item dropdown position-relative">
            <a class="login dropdown-toggle d-flex align-items-center gap-2" href="#" id="customerDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="icofont-user-alt-3"></i>
                <span>{{ session('customer_name') }}</span>
            </a>

            <ul class="dropdown-menu dropdown-menu-end shadow-sm mt-2 " aria-labelledby="customerDropdown" style="min-width: 180px;">
                <li>
                    <a class="dropdown-item" href="{{ route('customer.dashboard') }}">
                        <i class="icofont-dashboard-web"></i> Dashboard
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item text-danger" href="{{ route('customer.logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="icofont-logout"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('customer.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
    @else
        <li><a href="{{ route('customer.login') }}" class="login"><i class="icofont-user"></i> LOG IN</a></li>
        <li><a href="{{ route('customer.register') }}" class="signup"><i class="icofont-users" ></i> SIGN UP</a></li>
    @endif

</ul>



                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="container">
                <div class="header-wrapper">
                    <div class="logo">
                        <a href="{{ route('frontend.home') }}"><img src="{{ asset('frontend/assets/images/newlogo.png') }}" alt="logo"  style="width:100px; height:auto"></a>
                    </div>
                    <div class="menu-area">
                        <div class="menu"  >
                            <ul class="lab-ul right" >

                                <li> <a href="{{ route('frontend.home') }}">Home</a>  </li>

                                <li> <a href="{{route('frontend.Course')}}">courses</a> </li>

                                {{-- <li> <a href="{{route('frontend.vip.packages')}}">VIP Package</a> </li> --}}

                                <li> <a href="{{route('frontend.blog_style3')}}">Blog</a> </li>

                                <li> <a href="{{ route('frontend.about') }}">About Us</a> </li>

                                <li><a href="{{ route('frontend.contact') }}">Contact</a></li>

                            </ul>
                        </div>

                        <!-- toggle icons -->
                        <div class="header-bar d-lg-none">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="ellepsis-bar d-lg-none">
                            <i class="icofont-info-square"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header section ending here -->


