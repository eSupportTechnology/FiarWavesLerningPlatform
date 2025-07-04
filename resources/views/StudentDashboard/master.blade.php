<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{asset('frontend/assets/images/newlogo.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('frontend/assets/images/newlogo.png')}}" type="image/x-icon">

    <title>BetterWay - Student Dashboard</title>

    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/font-awesome.css')}}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/vendors/icofont.css')}}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/vendors/themify.css')}}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/vendors/flag-icon.css')}}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/vendors/feather-icon.css')}}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/vendors/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/vendors/slick-theme.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/vendors/scrollbar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/vendors/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/vendors/quill.snow.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/vendors/select2.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/vendors/dropzone.css')}}">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/vendors/bootstrap.css')}}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/style.css')}}">
    <link id="color" rel="stylesheet" href="{{asset('backend/assets/css/color-1.css')}}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/responsive.css')}}">

    <!-- Custom Student Dashboard Styles -->
    <style>
        /* Increased Navbar and Sidebar Height for Better Visibility */
        .sidebar-wrapper .logo-wrapper {
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
            height: 90px !important;
            min-height: 90px !important;
            display: flex !important;
            align-items: center !important;
            padding: 0 24px !important;
            margin: 0 !important;
            border-bottom: 1px solid #e9ecef !important;
        }
        
        .sidebar-wrapper .logo-wrapper a {
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .sidebar-wrapper .logo-wrapper span {
            font-weight: 700;
            font-size: 26px;
            color: #2c3e50;
            letter-spacing: 0.8px;
            margin-left: 15px;
        }
        
        /* Increased navbar height to match sidebar */
        .page-header {
            height: 90px !important;
            min-height: 90px !important;
            display: flex !important;
            align-items: center !important;
        }
        
        .header-wrapper {
            height: 90px !important;
            min-height: 90px !important;
            align-items: center !important;
            display: flex !important;
            padding: 0 20px !important;
        }
        
        .header-logo-wrapper {
            height: 90px !important;
            display: flex !important;
            align-items: center !important;
        }
        
        .header-logo-wrapper .logo-wrapper {
            height: 90px !important;
            display: flex !important;
            align-items: center !important;
        }
        
        /* Adjust sidebar content height for increased header */
        .sidebar-wrapper #sidebar-menu {
            max-height: calc(100vh - 90px);
            overflow-y: auto;
            padding-top: 20px;
        }
        
        /* Mobile view sidebar menu spacing fix */
        @media (max-width: 991px) {
            .sidebar-wrapper #sidebar-menu {
                padding-top: 40px !important; /* Extra padding for mobile to avoid overlap */
                margin-top: 10px !important;
            }
            
            .sidebar-wrapper .sidebar-links {
                padding-top: 20px !important;
            }
            
            /* Ensure first sidebar item is properly spaced */
            .sidebar-wrapper .sidebar-links .sidebar-list:first-child {
                margin-top: 15px !important;
            }
        }
        
        /* Enhanced sidebar menu styling */
        .sidebar-wrapper .sidebar-links .sidebar-list {
            margin-bottom: 8px;
        }
        
        .sidebar-wrapper .sidebar-links .sidebar-title {
            padding: 14px 24px;
            font-weight: 500;
            transition: all 0.3s ease;
            border-radius: 0;
        }
        
        .sidebar-wrapper .sidebar-links .sidebar-title:hover {
            background: rgba(232, 93, 4, 0.15) !important;
            color: #c44b03 !important;
            transform: translateX(4px) !important;
        }
        
        /* Logo hover effect with orange theme */
        .sidebar-wrapper .logo-wrapper a:hover {
            transform: scale(1.02);
            transition: transform 0.2s ease;
        }
        
        .sidebar-wrapper .logo-wrapper a:hover span {
            color: #E85D04;
            transition: color 0.2s ease;
        }
        
        /* Orange sidebar background using #E85D04 */
        .sidebar-wrapper,
        .sidebar-wrapper > div,
        .sidebar-wrapper .sidebar-main {
            background: linear-gradient(180deg, #fef3e7 0%, #fce8d0 100%) !important;
        }
        
        /* Logo wrapper with orange background */
        .sidebar-wrapper .logo-wrapper {
            background: linear-gradient(135deg, #fef3e7 0%, #fcead5 100%) !important;
            border-bottom: 1px solid #f4a261 !important;
        }
        
        /* Sidebar menu items styling for orange theme */
        .sidebar-wrapper .sidebar-links .sidebar-title {
            color: #E85D04 !important;
            border-radius: 8px !important;
            margin: 4px 12px !important;
        }
        
        .sidebar-wrapper .sidebar-links .sidebar-title:hover {
            background: rgba(232, 93, 4, 0.15) !important;
            color: #c44b03 !important;
            transform: translateX(4px) !important;
        }
        
        /* Active sidebar item */
        .sidebar-wrapper .sidebar-links .sidebar-list.active .sidebar-title,
        .sidebar-wrapper .sidebar-links .sidebar-title.active {
            background: rgba(232, 93, 4, 0.2) !important;
            color: #a63902 !important;
            font-weight: 600 !important;
        }
        
        /* Sidebar icons color */
        .sidebar-wrapper .sidebar-links .sidebar-title i {
            color: #E85D04 !important;
            margin-right: 12px !important;
        }
        
        /* Submenu styling */
        .sidebar-wrapper .sidebar-submenu {
            background: rgba(252, 234, 213, 0.4) !important;
            border-left: 3px solid #f4a261 !important;
            margin-left: 20px !important;
            border-radius: 0 8px 8px 0 !important;
        }
        
        .sidebar-wrapper .sidebar-submenu li a {
            color: #c44b03 !important;
            padding: 8px 20px !important;
            transition: all 0.3s ease !important;
        }
        
        .sidebar-wrapper .sidebar-submenu li a:hover {
            background: rgba(232, 93, 4, 0.1) !important;
            color: #a63902 !important;
            padding-left: 24px !important;
        }
        
        /* Ensure proper alignment with navbar */
        .page-body-wrapper .sidebar-wrapper {
            top: 0;
            position: fixed;
            z-index: 999;
        }
        
        /* Mobile responsiveness for back button */
        @media (max-width: 991px) {
            .sidebar-wrapper .logo-wrapper .back-btn {
                display: block !important;
                color: #333;
                cursor: pointer;
                padding: 10px;
                border-radius: 5px;
                transition: background 0.2s ease;
            }
            
            .sidebar-wrapper .logo-wrapper .back-btn:hover {
                background: rgba(0,0,0,0.1);
            }
        }
        
        /* Ensure navbar and sidebar logos are on same horizontal line */
        .page-wrapper.compact-wrapper .page-body-wrapper .sidebar-wrapper {
            margin-top: 0;
        }
        
        /* Enhanced styling for larger logo in sidebar */
        .sidebar-wrapper .logo-wrapper img {
            max-height: 200px !important;
            width: auto !important;
            object-fit: contain !important;
            transition: transform 0.3s ease;
        }
        
        .sidebar-wrapper .logo-wrapper a:hover img {
            transform: scale(1.05);
        }
        
        /* Ensure page body adjusts to new navbar height */
        .page-body-wrapper .page-body {
            margin-top: 90px !important;
        }
        
        /* Additional spacing and alignment improvements */
        .sidebar-wrapper .back-btn {
            padding: 15px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        
        .sidebar-wrapper .back-btn:hover {
            background: rgba(232, 93, 4, 0.15);
            color: #E85D04;
        }
        
        /* Fix profile dropdown position to avoid scrollbar overlap */
        .page-wrapper .page-header .header-wrapper .nav-right .profile-dropdown {
            right: 5px !important; /* Shifted right by 5px to avoid scrollbar overlap */
            left: auto !important; /* Override any left positioning */
        }
        
        /* Profile Media Spacing Improvements */
        .page-wrapper .page-header .header-wrapper .nav-right.right-header ul li .profile-media {
            display: flex;
            align-items: center;
            gap: 0;
            padding: 8px 12px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        
        .page-wrapper .page-header .header-wrapper .nav-right.right-header ul li .profile-media:hover {
            background: rgba(68, 102, 242, 0.05);
        }
        
        .page-wrapper .page-header .header-wrapper .nav-right.right-header ul li .profile-media .media-body {
            margin-left: 0 !important;
            display: flex;
            flex-direction: column;
            gap: 2px;
        }
        
        .page-wrapper .page-header .header-wrapper .nav-right.right-header ul li .profile-media .media-body span {
            font-weight: 600;
            color: #2c3e50;
            font-size: 14px;
            line-height: 1.2;
        }
        
        .page-wrapper .page-header .header-wrapper .nav-right.right-header ul li .profile-media .media-body p {
            margin: 0;
            font-size: 12px;
            color: rgba(47, 47, 59, 0.7);
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        .page-wrapper .page-header .header-wrapper .nav-right.right-header ul li .profile-media .media-body p i {
            font-size: 12px;
            color: rgba(47, 47, 59, 0.5);
        }
        
        /* Profile Icon Styling */
        .profile-icon-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #D00000 0%, #B60000 100%);
            margin-right: 12px;
            transition: all 0.3s ease;
        }
        
        .profile-icon-wrapper:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(208, 0, 0, 0.3);
        }
        
        .profile-icon {
            color: white;
            width: 22px;
            height: 22px;
        }
        
        /* Allowance Progress Circle Container Fix */
        .allowance-progress-container {
            position: relative !important;
            display: inline-block !important;
            width: 150px !important;
            height: 150px !important;
        }
        
        .allowance-progress-container svg {
            position: relative !important;
            display: block !important;
            z-index: 1 !important;
        }
        
        /* Allowance Progress Text Positioning Fix */
        .allowance-progress-text {
            position: absolute !important;
            top: 50% !important;
            left: 50% !important;
            transform: translate(-50%, -50%) !important;
            z-index: 2 !important;
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            justify-content: center !important;
            text-align: center !important;
            pointer-events: none !important;
        }
        
        .allowance-progress-text h2 {
            font-size: 1.8rem !important;
            font-weight: 700 !important;
            line-height: 1.2 !important;
            margin: 0 !important;
            color: white !important;
        }
        
        .allowance-progress-text small {
            font-size: 0.75rem !important;
            font-weight: 500 !important;
            line-height: 1.1 !important;
            margin-top: 2px !important;
            color: rgba(255, 255, 255, 0.9) !important;
            white-space: nowrap !important;
        }
        
        /* Responsive adjustments for smaller screens */
        @media (max-width: 576px) {
            .allowance-progress-text h2 {
                font-size: 1.5rem !important;
            }
            
            .allowance-progress-text small {
                font-size: 0.7rem !important;
            }
        }
        
        /* Profile Dropdown Menu Icon Visibility Improvements */
        /* Target all icon types in dropdown menu */
        .profile-dropdown.onhover-show-div li a i,
        .profile-dropdown.onhover-show-div li a svg,
        .profile-dropdown.onhover-show-div li a .fa,
        .profile-dropdown.onhover-show-div li a .fas,
        .profile-dropdown.onhover-show-div li a .far,
        .profile-dropdown.onhover-show-div li a .fab {
            color: #000 !important; /* Make all icons black for better visibility */
            fill: #000 !important; /* For SVG icons */
            stroke: #000 !important; /* For outlined SVG icons */
            font-size: 16px !important;
            margin-right: 8px !important;
            opacity: 1 !important; /* Ensure full opacity */
        }
        
        /* Specifically target feather icons */
        .profile-dropdown.onhover-show-div li a i[data-feather],
        .profile-dropdown.onhover-show-div li a svg[data-feather] {
            color: #000 !important;
            stroke: #000 !important;
            fill: none !important; /* Feather icons should not be filled */
        }
        
        /* Target Font Awesome icons specifically */
        .profile-dropdown.onhover-show-div li a .fa,
        .profile-dropdown.onhover-show-div li a [class*="fa-"] {
            color: #000 !important;
            font-weight: 900 !important;
        }
        
        /* Ensure dropdown items have proper contrast */
        .profile-dropdown.onhover-show-div li a {
            color: #333 !important;
            display: flex !important;
            align-items: center !important;
            padding: 8px 16px !important;
            transition: all 0.2s ease !important;
            background-color: #fff !important; /* White background for better contrast */
        }
        
        /* Hover effects for dropdown items */
        .profile-dropdown.onhover-show-div li a:hover {
            background-color: rgba(52, 152, 219, 0.1) !important;
            color: #2c3e50 !important;
        }
        
        .profile-dropdown.onhover-show-div li a:hover i,
        .profile-dropdown.onhover-show-div li a:hover svg,
        .profile-dropdown.onhover-show-div li a:hover .fa {
            color: #2c3e50 !important;
            stroke: #2c3e50 !important;
            fill: #2c3e50 !important;
        }
        
        /* Ensure dropdown menu itself has proper styling */
        .profile-dropdown.onhover-show-div {
            background-color: #fff !important;
            border: 1px solid #ddd !important;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important;
            border-radius: 8px !important;
            padding: 8px 0 !important;
            min-width: 180px !important;
        }
    </style>


</head>

  <body onload="startTime()">

@if (!session()->has('customer_id'))
    <script>
        window.location.href = "{{ route('customer.login') }}";
    </script>
    @php exit; @endphp
@endif

    <!-- loader starts-->
    <div class="loader-wrapper">
      <div class="loader-index"> <span></span></div>
      <svg>
        <defs></defs>
        <filter id="goo">
          <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
          <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"> </fecolormatrix>
        </filter>
      </svg>
    </div>
    <!-- loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">

      @include('StudentDashboard.header')
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        @include('StudentDashboard.sidebar')

        <div class="page-body">
            @yield('content')
        </div>
        @include('StudentDashboard.footer')
      </div>
    </div>
    <!-- latest jquery-->
    <!-- JavaScript Files -->
    <script src="{{asset('backend/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/icons/feather-icon/feather.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/icons/feather-icon/feather-icon.js')}}"></script>
    <script src="{{asset('backend/assets/js/scrollbar/simplebar.js')}}"></script>
    <script src="{{asset('backend/assets/js/scrollbar/custom.js')}}"></script>
    <script src="{{asset('backend/assets/js/config.js')}}"></script>
    <script src="{{asset('backend/assets/js/sidebar-menu.js')}}"></script>
    <script src="{{asset('backend/assets/js/sidebar-pin.js')}}"></script>
    <script src="{{asset('backend/assets/js/clock.js')}}"></script>
    <script src="{{asset('backend/assets/js/slick/slick.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/slick/slick.js')}}"></script>
    <script src="{{asset('backend/assets/js/header-slick.js')}}"></script>
    <script src="{{asset('backend/assets/js/chart/apex-chart/apex-chart.js')}}"></script>
    <script src="{{asset('backend/assets/js/chart/apex-chart/stock-prices.js')}}"></script>
    <script src="{{asset('backend/assets/js/chart/apex-chart/moment.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/dashboard/default.js')}}"></script>
    <script src="{{asset('backend/assets/js/notify/index.js')}}"></script>
    <script src="{{asset('backend/assets/js/typeahead/handlebars.js')}}"></script>
    <script src="{{asset('backend/assets/js/typeahead/typeahead.bundle.js')}}"></script>
    <script src="{{asset('backend/assets/js/typeahead/typeahead.custom.js')}}"></script>
    <script src="{{asset('backend/assets/js/typeahead-search/handlebars.js')}}"></script>
    <script src="{{asset('backend/assets/js/typeahead-search/typeahead-custom.js')}}"></script>
    <script src="{{asset('backend/assets/js/height-equal.js')}}"></script>
    <script src="{{asset('backend/assets/js/animation/wow/wow.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/script.js')}}"></script>

    <script src="{{asset('backend/assets/js/dropzone/dropzone.js')}}"></script>
    <script src="{{asset('backend/assets/js/dropzone/dropzone-script.js')}}"></script>
    <script src="{{asset('backend/assets/js/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/select2/select2-custom.js')}}"></script>
    <script src="{{asset('backend/assets/js/editors/quill.js')}}"></script>
    <script src="{{asset('backend/assets/js/custom-add-product4.js')}}"></script>
    <script src="{{asset('backend/assets/js/form-validation-custom.js')}}"></script>

    <script src="{{asset('backend/assets/js/script.js')}}"></script>

    <script>new WOW().init();</script>
    @yield('script')

  </body>
</html>
