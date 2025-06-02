<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DSA Academy</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('frontend/assets/images/logo2.png') }}" type="image/x-icon">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/icofont.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/lightcase.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
    

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