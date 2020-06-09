@extends('frontLayout.app')
@section('title')
Register
@stop
@section('content')

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
          
          {{ Form::open(array('url' => route('register'), 'class' => 'create-account-form','files' => true)) }}
          {!! csrf_field() !!}

          <div class="form-group">
            <i class="fa fa-envelope"></i>
            {!! Form::email('email', null, ['style' => 'padding-left:50px','placeholder '=>'E-mail']) !!}
            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
          </div>
          <div class="form-group">
            <i class="fa fa-id-card"></i>
            {!! Form::text('first_name', null, ['style' => 'padding-left:50px','placeholder '=>'Enter your firtst name']) !!}
            {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
          </div>
          <div class="form-group">
            <i class="fa fa-id-card"></i>
            {!! Form::text('last_name', null, ['style' => 'padding-left:50px','placeholder '=>'Enter your last name']) !!}
            {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
          </div>
          <div class="form-group">
            <i class="fa fa-industry"></i>
            <input style="padding-left:50px" type="text" placeholder="Company">
          </div>
          <div class="form-group">
            <i class="fa fa-mobile"></i>
            <input style="padding-left:50px" type="text" placeholder="(+65)">
          </div>
          <div class="form-group">
            <i class="fa fa-lock"></i>
            {!! Form::password('password', ['style' => 'padding-left:50px','rel'=>'gp' ,'data-size'=>'10' ,'data-character-set'=>'a-z,A-Z,0-9,#' ,'placeholder '=>'Enter your Password']) !!}
            {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
          </div>
          <div class="form-group">
            <i class="fa fa-lock"></i>
            {!! Form::password('password_confirmation', ['style' => 'padding-left:50px','rel'=>'gp' ,'data-size'=>'10' ,'data-character-set'=>'a-z,A-Z,0-9,#' ,'placeholder '=>'Confirm your Password']) !!}
            {!! $errors->first('password_confirmation', '<p class="help-block">:message</p>') !!}
          </div>

          <div class="form-group">
            <input type="submit" value="Sign Up">
          </div>

          @if ($errors->has('global'))
          <span class="help-block danger">
            <strong style="color:red">{{ $errors->first('global') }}</strong>
          </span>
          @endif
          {{ Form::close() }}
          <div class="terms-area">
            <p class="terms-and-conditions">Already have an account? &nbsp;&nbsp;
              <a href="{{ url('login') }}" class="account-control-button">Log In</a>
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