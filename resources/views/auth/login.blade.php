@extends('frontLayout.app')
@section('title')
Login
@stop
@section('content')

<!-- Login Form -->
<section class="log-in-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-3 text-center"></div>
      <div class="col-lg-6 text-center">
        <div class="login-form-area">
          <a class="site-logo site-title" href="{{ route('home') }}"><img src="images/logo.png" style="height:100px;" alt="site-logo"></a>
          @if (Session::has('message'))
          <div class="alert alert-{{(Session::get('status')=='error')?'danger':Session::get('status')}} " alert-dismissable fade in id="sessions-hide">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>{{Session::get('status')}}!</strong> {!! Session::get('message') !!}
          </div>
          @endif
          
          {{ Form::open(array('url' => route('login'), 'class' => 'create-account-form','files' => true)) }}
          {!! csrf_field() !!}
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
          @if ($errors->has('global'))
          <span class="help-block danger">
            <strong style="color:red">{{ $errors->first('global') }}</strong>
          </span>
          @endif
          </form>
          <div class="social-login">
            <p>Or Login with social account.</p>
          </div>
          <ul class="sign-up-option">
            <li>
              <a href="{{ url('login/google') }}" class="google"><i class="fa fa-google"></i></a>
            </li>
            <li>
              <a href="{{ url('login/facebook') }}" class="facebook"><i class="fa fa-facebook-f"></i></a>
            </li>
            <li>
              <a href="{{ url('login/linkedin') }}" class="twitter"><i class="fa fa-linkedin"></i></a>
            </li>
          </ul>
          <div class="terms-area">
            <p class="terms-and-conditions">Don't have an account? &nbsp;&nbsp;
              <a href="{{url('register')}}" class="account-control-button">Sign up</a>
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