<!-- header section start here --> 

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>

a {
    text-decoration: none !important;
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
    }

    .dropdown-toggle::after {
        margin-left: 8px;
    }
}

.dropdown-menu a.dropdown-item i {
    margin-right: 15px;
}

</style>


    <header class="header-section">
        <div class="header-top" style=" background-color:rgb(4, 40, 75); 
    color: #fff; ">
            <div class="container">
                <div class="header-top-area">
                    <ul class="lab-ul left">
                        <li>
                            <i class="fa fa-envelope"></i> <span>dsacademy995@gmail.com</span>
                        </li>
                        <li>
                            <i class="icofont-ui-call"></i> <span>074 002 0222 / 070 360 0690</span>
                        </li>
                    </ul>
                    <ul class="lab-ul social-icons d-flex align-items-center">
                        <li><p></p></li>
                        <li>
                            <a href="https://youtube.com/@dsaacademylk?si=wYkBGSyTYsxDbKAr" class="youtube" target="_blank" title="YouTube">
                                <i class="icofont-youtube"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.tiktok.com/@dsa_academy?_t=ZS-8uwiQdxgMmO&_r=1" class="tiktok" target="_blank" title="TikTok">
                                <i class="icofont-twitch"></i> <!-- No TikTok icon, using Twitch as placeholder -->
                            </a>
                        </li>
                        <li>
                            <a href="https://www.facebook.com/share/1EAj83c8JN/?mibextid=wwXIfr" class="facebook" target="_blank" title="Facebook">
                                <i class="icofont-facebook-messenger"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.facebook.com/share/1B8Hty84zo/?mibextid=wwXIfr" class="facebook" target="_blank" title="Facebook">
                                <i class="icofont-facebook-messenger"></i>
                            </a>
                        </li>
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
        <li><a href="{{ route('customer.register') }}" class="signup"><i class="icofont-users" "></i> SIGN UP</a></li>
    @endif

</ul>



                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="container">
                <div class="header-wrapper">
                    <div class="logo">
                        <a href="{{ route('frontend.home') }}"><img src="{{ asset('frontend/assets/images/logo.png') }}" alt="logo"  style="width:200px; height:auto"></a>
                    </div> 
                    <div class="menu-area">
                        <div class="menu"  >
                            <ul class="lab-ul right" >
                                
                                <li> <a href="{{ route('frontend.home') }}">Home</a>  </li>

                                <li> <a href="{{route('frontend.Course')}}">courses</a> </li>

                                <li> <a href="{{route('frontend.vip.packages')}}">VIP Package</a> </li>

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


    