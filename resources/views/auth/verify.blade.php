@extends('frontLayout.app')

@section('content')

<!-- Banner area -->
<section class="banner_area" data-stellar-background-ratio="0.5">
    <h2>Verify Your Account</h2>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="#" class="active">Verify Your Account</a></li>
        
    </ol>
</section>
<!-- End Banner area -->

<section class="password_reset_section">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Verify Your Account</div>
                    <div class="panel-body">
                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif

                        <form class="form-horizontal" role="form" method="POST" action="/verifyCode">
                            {{ csrf_field() }}
                            
                            <input type="hidden" name="token" value="{{ app('request')->input('token') }}">
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="verify_code" class="col-md-4 col-sm-4 col-xs-4 col-4 control-label">Verification Code</label>

                                <div class="col-md-6 col-sm-6 col-xs-6 col-6">
                                    <input id="verify_code" type="text" class="form-control" name="verify_code" required placeholder='Enter the 6-digit code'>
                                    @if ($errors->has('verify_code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('verify_code') }}</strong>
                                    </span>
                                    @endif
                                    @if ($errors->has('global'))
                                    <span class="help-block danger">
                                        <strong style="color:red">{{ $errors->first('global') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4 col-sm-offset-4 col-xs-offset-4 col-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Verify
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <p style="text-align:center;">
                    Check your email to activate your account. If it doesn't appear within a few minutes, check your spam folder.<br/>
                    <a id="resend_verification_email" href=""><b>Or Resend verification code again.</b></a>
                </p>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
$('#resend_verification_email').on('click', function (e) {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url:"/resend_verification_email",
        method: "POST",
        data: {
            _token: CSRF_TOKEN,
            token: $('input[name="token"]').val()
        },
        success:function(result)
        {
            alert("Email has been successfully sent.");
        },
        error:function (err) {
            alert("unexpected error occured while sending email. Please try again.");
        },
    });
});
</script>
@endsection