@extends('frontLayout.app')
@section('title')
Login
@stop
@section('content')

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


@endsection

@section('scripts')


@endsection