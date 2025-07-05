@extends('frontend.master')

@section('title', 'Home - Fire Waves')

@section('content')

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
</style>



    <!-- Page Header section start here -->
    <div class="pageheader-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="pageheader-content text-center">
                        <h2>Login Page</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Login</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header section ending here -->

    <!-- Login Section Section Starts Here -->
    <div class="login-section padding-tb section-bg">
        <div class="container">
            <div class="account-wrapper">
                <h3 class="title">Login</h3>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif


                <form form class="account-form" action="{{ route('customer.login.submit') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" placeholder="User Id" name="invite_code">
                    </div>
                    <div class="form-group position-relative">
                        <input type="password" placeholder="Password" name="password" id="password-input">
                        <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor:pointer;" onclick="togglePasswordVisibility()">
                            <i class="fa fa-eye" id="toggle-password-icon"></i>
                        </span>
                    </div>
                    <script>
                        function togglePasswordVisibility() {
                            const passwordInput = document.getElementById('password-input');
                            const icon = document.getElementById('toggle-password-icon');
                            if (passwordInput.type === 'password') {
                                passwordInput.type = 'text';
                                icon.classList.remove('fa-eye');
                                icon.classList.add('fa-eye-slash');
                            } else {
                                passwordInput.type = 'password';
                                icon.classList.remove('fa-eye-slash');
                                icon.classList.add('fa-eye');
                            }
                        }
                    </script>
                    <div class="form-group">
                        <div class="d-flex justify-content-between flex-wrap pt-sm-2">
                            <div class="checkgroup">
                                <input type="checkbox" name="remember" id="remember">
                                <label for="remember">Remember Me</label>
                            </div>
                            <a href="{{route('frontend.forgetpass')}}">Forget Password?</a>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button class="d-block lab-btn"><span>Submit Now</span></button>
                    </div>
                </form>
                <div class="account-bottom">
                    <span class="d-block cate pt-10">Don’t Have any Account?  <a href="{{ route('customer.register') }}">Sign Up</a></span>

                </div>
            </div>
        </div>
    </div>
    <!-- Login Section Section Ends Here -->

    @endsection
