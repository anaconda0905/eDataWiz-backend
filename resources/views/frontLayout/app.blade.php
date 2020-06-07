<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <meta name="csrf-token" content="{{ csrf_token() }}" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title')</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ URL::asset('/images/favicon.png') }}" type="image/x-icon" />
    <!-- Bootstrap CSS -->
    <link href="{{ URL::asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Animate CSS -->
    <link href="{{ URL::asset('/vendors/animate/animate.css') }}" rel="stylesheet">
    <!-- Icon CSS-->
    <link rel="stylesheet" href="{{ URL::asset('/vendors/font-awesome/css/font-awesome.min.css') }}">
    <!-- Camera Slider -->
    <link rel="stylesheet" href="{{ URL::asset('/vendors/camera-slider/camera.css') }}">
    <!-- Owlcarousel CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/vendors/owl_carousel/owl.carousel.css') }}" media="all">

    <!--Theme Styles CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/css/style.css') }}" media="all" />

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.min.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

	@yield('style')
</head>
<body>
	<!-- Preloader -->
    <div class="preloader"></div>
    @yield('content')
	

	<!-- jQuery JS -->
    <script src="{{ URL::asset('/js/jquery-1.12.0.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ URL::asset('/js/bootstrap.min.js') }}"></script>
    <!-- Animate JS -->
    <script src="{{ URL::asset('/vendors/animate/wow.min.js') }}"></script>
    <!-- Camera Slider -->
    <script src="{{ URL::asset('/vendors/camera-slider/jquery.easing.1.3.js') }}"></script>
    <script src="{{ URL::asset('/vendors/camera-slider/camera.min.js') }}"></script>
    <!-- Isotope JS -->
    <script src="{{ URL::asset('/vendors/isotope/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ URL::asset('/vendors/isotope/isotope.pkgd.min.js') }}"></script>
    <!-- Progress JS -->
    <script src="{{ URL::asset('/vendors/Counter-Up/jquery.counterup.min.js') }}"></script>
    <script src="{{ URL::asset('/vendors/Counter-Up/waypoints.min.js') }}"></script>
    <!-- Owlcarousel JS -->
    <script src="{{ URL::asset('/vendors/owl_carousel/owl.carousel.min.js') }}"></script>
    <!-- Stellar JS -->
    <script src="{{ URL::asset('/vendors/stellar/jquery.stellar.js') }}"></script>
    <!-- Theme JS -->
    <script src="{{ URL::asset('/js/theme.js') }}"></script>
	 <script type="text/javascript">
      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
    </script>
	@yield('scripts')
</body>
</html>