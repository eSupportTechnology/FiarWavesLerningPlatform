<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Better Way</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('frontend/assets/images/newlogo.png') }}" type="image/x-icon">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/icofont.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/lightcase.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>

    <style>
        .pageheader-section {
            background-position: center center; /* default for desktop */
        }

        @media (max-width: 767.98px) {
            .pageheader-section {
                background-position: 30% center !important; /* shift left on mobile */
            }
        }

        /* Global breadcrumb alignment fix */
        .breadcrumb {
            flex-wrap: nowrap !important;
            white-space: nowrap;
            display: inline-flex !important;
            align-items: center;
            margin-bottom: 1rem;
        }

        .breadcrumb-item {
            display: inline-flex;
            align-items: center;
            white-space: nowrap;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            float: none !important;
            display: inline-block;
            line-height: 1;
        }

        /* Handle overflow on very small screens */
        @media (max-width: 480px) {
            .breadcrumb {
                overflow-x: auto;
                scrollbar-width: none;
                -ms-overflow-style: none;
            }
            
            .breadcrumb::-webkit-scrollbar {
                display: none;
            }
        }
    </style>


</head>

<body>


    <!-- Scroll to Top -->
    <a href="#" class="scrollToTop"><i class="icofont-rounded-up"></i></a>

    <!-- Header -->
    @include('frontend.header')

    <!-- Content -->
    <div id="content">
        @yield('content')
    </div>

    <!-- Footer -->
    @include('frontend.footer')

    <script src="{{ asset('frontend/assets/js/jquery.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/lightcase.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/functions.js') }}"></script>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>


    @stack('script')


</body>
</html>
