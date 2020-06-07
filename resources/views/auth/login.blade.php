@extends('frontLayout.app')
@section('title')
Login
@stop
@section('content')
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
          <li><a href="index.html">Home</a></li>
          <li><a href="about.html">About Us</a></li>
          <li><a href="solutions.html">Solutions</a></li>
          <li><a href="contact.html">Contact Us</a></li>
          <li><a href="login.html">Log In</a></li>
          <li><a href="contact.html" class="nav_demo">Demo</a></li>
          <!-- <li><a href="#" class="nav_searchFrom"><i class="fa fa-search"></i></a></li> -->
        </ul>
      </div><!-- /.navbar-collapse -->
    </div>
  </div><!-- /.container -->
</nav>
<!-- End Header_Area -->
<!-- Login Form -->
<section class="log-in-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-3 text-center"></div>
      <div class="col-lg-6 text-center">
        <div class="login-form-area">
          <a class="site-logo site-title" href="index.html"><img src="images/logo.png" style="height:100px;" alt="site-logo"></a>
          @if (Session::has('message'))
          <div class="alert alert-{{(Session::get('status')=='error')?'danger':Session::get('status')}} " alert-dismissable fade in id="sessions-hide">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>{{Session::get('status')}}!</strong> {!! Session::get('message') !!}
          </div>
          @endif
          {{ Form::open(array('url' => route('login'), 'class' => 'create-account-form','files' => true)) }}    
            <div class="form-group">
              <i class="fa fa-envelope"></i>
              {!! Form::text('email', null, ['style' => 'padding-left:50px','placeholder '=>'E-mail']) !!}
              {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="form-group">
              <i class="fa fa-lock"></i>
              {!! Form::password('password', ['style' => 'padding-left:50px','placeholder '=>'Password']) !!}
              {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
            </div>
            <div style="text-align:right;">
              <a href="{{url('password/reset')}}">Forget Password?</a>
            </div>
            <div class="form-group form-group--style">
              <input type="submit" value="Login">
            </div>
          </form>
          <div class="social-login">
            <p>Or Login with social account.</p>
          </div>
          <ul class="sign-up-option">
            <li>
              <a href="#0" class="google"><i class="fa fa-google"></i></a>
            </li>
            <li>
              <a href="#0" class="facebook"><i class="fa fa-facebook-f"></i></a>
            </li>
            <li>
              <a href="#0" class="twitter"><i class="fa fa-linkedin"></i></a>
            </li>
          </ul>
          <div class="terms-area">
            <p class="terms-and-conditions">Don't have an account? &nbsp;&nbsp;
              <a href="signup.html" class="account-control-button">Sign up</a>
            </p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 text-center"></div>
    </div>
  </div>
</section>
<!-- End Login Form -->

<!-- Footer Area -->
<footer class="footer_area">
  <div class="container">
    <div class="footer_row row">
      <div class="col-md-4 col-sm-6 footer_about first">
        <img src="images/footer-logo.png" alt="">
      </div>
      <div class="col-md-4 col-sm-6 footer_about quick">
        <h2>Quick links</h2>
        <ul class="quick_link">
          <li><a href="#"><i class="fa fa-chevron-right"></i>Home</a></li>
          <li><a href="#"><i class="fa fa-chevron-right"></i>About Us</a></li>
          <li><a href="solutions.html"><i class="fa fa-chevron-right"></i>Solutions</a></li>
          <li><a href="#"><i class="fa fa-chevron-right"></i>Log in/Sign Up</a></li>
          <li><a href="#"><i class="fa fa-chevron-right"></i>Contact Us</a></li>
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
@endsection

@section('scr