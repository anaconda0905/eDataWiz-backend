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
    <!-- Top Header_Area -->

    <section class="top_header_area">
        <div class="container">
            <ul class="nav navbar-nav top_nav">
                <li><a href="tel:+65 86996780"><i class="fa fa-phone"></i>+65 86996780</a></li>
                <li><a href="mailto:info@edatawiz.com"><i class="fa fa-envelope-o"></i>info@edatawiz.com</a></li>
                <!-- <li><a href="#"><i class="fa fa-clock-o"></i>Mon - Sat 12:00 - 20:00</a></li> -->
            </ul>
            <ul class="nav navbar-nav navbar-right social_nav">
                <li><a href="https://www.facebook.com" target=" _blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="https://www.twitter.com" target=" _blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="https://www.google.com" target=" _blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                <li><a href="https://www.instagram.com" target=" _blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                <li><a href="https://www.pinterest.com" target=" _blank"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
                <li><a href="https://www.linkedin.com" target=" _blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                <li><a href="https://wa.me/6586996780" title="" target=" _blank"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
                <li><a href="we-chat.html" title="" target=" _blank"><i class="fa fa-weixin" aria-hidden="true"></i></a></li>
            </ul>
        </div>
    </section>
    <!-- End Top Header_Area -->

    <!-- Header_Area -->
    <nav class="navbar navbar-default header_aera" id="main_navbar">
        <div class="container">
            <!-- searchForm -->
            <div class="searchForm">
                <form action="#" class="row m0">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                        <input type="search" name="search" class="form-control" placeholder="Type & Hit Enter">
                        <span class="input-group-addon form_hide"><i class="fa fa-times"></i></span>
                    </div>
                </form>
            </div><!-- End searchForm -->
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="col-md-2 p0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#min_navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html"><img src="images/logo.png" alt=""></a>
                </div>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="col-md-10 p0">
                <div class="collapse navbar-collapse" id="min_navbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('solution') }}">Solutions</a></li>
                        <li><a href="{{ route('contact') }}">Contact Us</a></li>
                        <li><a href="{{ url('login') }}">Log In</a></li>
                        <li><a href="{{ route('demo') }}" class="nav_demo">Demo</a></li>
                        <!-- <li><a href="#" class="nav_searchFrom"><i class="fa fa-search"></i></a></li> -->
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div>
        </div><!-- /.container -->
    </nav>
    <!-- End Header_Area -->

    @yield('content')

    <!-- Footer Area -->
    <footer class="footer_area">
        <div class="container">
            <div class="footer_row row">
                <div class="col-md-4 col-sm-6 footer_about first">
                    <img src="/images/footer-logo.png" alt="">
                </div>
                <div class="col-md-4 col-sm-6 footer_about quick">
                    <h2>Quick links</h2>
                    <ul class="quick_link">
                        <li><a href="{{ route('home') }}"><i class="fa fa-chevron-right"></i>Home</a></li>
                        <li><a href="{{ route('about') }}"><i class="fa fa-chevron-right"></i>About Us</a></li>
                        <li><a href="{{ route('solution') }}"><i class="fa fa-chevron-right"></i>Solutions</a></li>
                        <li><a href="{{ url('login') }}"><i class="fa fa-chevron-right"></i>Log in/Sign Up</a></li>
                        <li><a href="{{ url('contact') }}"><i class="fa fa-chevron-right"></i>Contact Us</a></li>
                    </ul>
                </div>

                <div class="col-md-4 col-sm-6 footer_about">
                    <h2>CONTACT US</h2>
                    <address>
                        <ul class="my_address">
                            <li><a href="tel:+65 86996780"><i class="fa fa-phone"></i>+65 86996780</a></li>
                            <li><a href="mailto:info@edatawiz.com"><i class="fa fa-envelope-o"></i>info@edatawiz.com</a>
                            </li>
                            <li><a href="#"><i class="fa fa-clock-o"></i>Mon - Sat 9:00 - 19:00</a></li>
                            <!-- <li><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i>Singapore</a></li> -->
                        </ul>
                    </address>
                </div>
            </div>
        </div>
        <div class="copyright_area">
            Copyright 2020 All rights reserved by The <a href="https://edatawiz.com">eDatawiz.</a>
        </div>
    </footer>
    <!-- End Footer Area -->
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
    <!-- Custom JS -->
    <script src="{{ URL::asset('/js/custom.js') }}"></script>
    
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