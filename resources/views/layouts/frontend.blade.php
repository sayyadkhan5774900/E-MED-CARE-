<!DOCTYPE html>
<html lang="en">

<head>
  <title>Pharma &mdash; Colorlib Template</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Rubik:400,700|Crimson+Text:400,400i" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('asset/fonts/icomoon/style.css') }}">

  <link rel="stylesheet" href="{{ asset('asset/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('asset/css/magnific-popup.css') }}">
  <link rel="stylesheet" href="{{ asset('asset/css/jquery-ui.css') }}">
  <link rel="stylesheet" href="{{ asset('asset/css/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('asset/css/owl.theme.default.min.css') }}">


  <link rel="stylesheet" href="{{ asset('asset/css/aos.css') }}">

  <link rel="stylesheet" href="{{ asset('asset/css/style.css') }}">
  
</head>

<body>

  <div class="site-wrap">

    @include('partials.navbar')

    @yield('content')
  
    @include('partials.footer')

    
  </div>

  <script src="{{ asset('asset/js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('asset/js/jquery-ui.js') }}"></script>
  <script src="{{ asset('asset/js/popper.min.js') }}"></script>
  <script src="{{ asset('asset/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('asset/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('asset/js/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ asset('asset/js/aos.js') }}"></script>

  <script src="{{ asset('asset/js/main.js') }}"></script>

</body>

</html>