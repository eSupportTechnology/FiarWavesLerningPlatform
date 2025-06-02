<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/vendors/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/vendors/feather-icon.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('backend/assets/css/color-1.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/responsive.css') }}">
  </head>

  <body>
    <!-- login page start-->
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-7">
          <img class="bg-img-cover bg-center" src="{{ asset('backend/assets/images/login/2.jpg') }}" alt="login">
        </div>
        <div class="col-xl-5 p-0">
          <div class="login-card login-dark">
            <div>
              <div class="text-start mb-4">
                <a class="logo" href="#"><img class="img-fluid for-light" src="{{ asset('frontend/assets/images/logo/logo.png') }}" alt=""><img class="img-fluid for-dark" src="{{ asset('assets/images/logo/logo_dark.png') }}" alt=""></a>
              </div>

              <div class="login-main">
                <form method="POST" action="{{ route('admin.login') }}" class="theme-form">
                  @csrf
                  <h4>Sign in to Admin Panel</h4>
                  <p>Enter your credentials below</p>

                  {{-- Show validation errors --}}
                  @if ($errors->any())
                    <div class="alert alert-danger">
                      <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                      </ul>
                    </div>
                  @endif

                  <div class="form-group">
                    <label>Email Address</label>
                    <input class="form-control" type="email" name="email" value="{{ old('email') }}" required placeholder="admin@example.com">
                  </div>

                  <div class="form-group">
                    <label>Password</label>
                    <div class="form-input position-relative">
                      <input class="form-control" type="password" name="password" required placeholder="********">
                      <div class="show-hide"><span class="show"></span></div>
                    </div>
                  </div>

                  <div class="form-group mb-0">
                    
                    <button class="btn btn-primary w-100 mt-3" type="submit">Sign in</button>
                  </div>

                </form>
              </div>

            </div>
          </div>
        </div>
      </div>

      <!-- Scripts -->
      <script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>
      <script src="{{ asset('backend/assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('backend/assets/js/icons/feather-icon/feather.min.js') }}"></script>
      <script src="{{ asset('backend/assets/js/icons/feather-icon/feather-icon.js') }}"></script>
      <script src="{{ asset('backend/assets/js/config.js') }}"></script>
      <script src="{{ asset('backend/assets/js/script.js') }}"></script>
    </div>
  </body>
</html>
