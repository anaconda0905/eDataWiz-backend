@extends('frontLayout.app')

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
        <a class="navbar-brand" href="index.html"><img src="/images/logo.png" alt=""></a>
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

<!-- Banner area -->
<section class="banner_area" data-stellar-background-ratio="0.5">
        <h2>Reset Password</h2>
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="#" class="active">Reset Password</a></li>
        </ol>
    </section>
    <!-- End Banner area -->

<section class="password_reset_section">
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

@endsection
