@extends('backLayout.app')
@section('title')
Show user {{$user->first_name}}
@stop

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">The user : {{$user->first_name}}</div>

    <div class="panel-body">

        <ul>
            <div class="row">
                {!! Form::label('first_name','First name', ['class' => 'col-md-4 col-sm-4 col-xs-4 col-12 control-label']) !!}
                <div class="col-sm-6 col-sx-6 col-12">
                    {{$user->first_name}}
                </div>
            </div>

            <div class="row">
                {!! Form::label('last_name', 'Last name', ['class' => 'col-md-4 col-sm-4 col-xs-4 col-12 control-label']) !!}
                <div class="col-sm-6 col-sx-6 col-12">
                    {{$user->last_name}}
                </div>
            </div>

            <div class="row">
                {!! Form::label('email', 'Email', ['class' => 'col-md-4 col-sm-4 col-xs-4 col-12 control-label']) !!}
                <div class="col-sm-6 col-sx-6 col-12">
                    {{$user->email}}
                </div>
            </div>

            <div class="row">
                {!! Form::label('role', 'Role', ['class' => 'col-md-4 col-sm-4 col-xs-4 col-12 control-label']) !!}
                <div class="col-sm-6 col-sx-6 col-12">
                    {{$user->roles->first()->name}}
                </div>
            </div>

            <div class="row">
                <br>
                <div class="col-md-6 col-md-offset-4">
                    <a href="{{route('user.index')}}" class="btn btn-default">Return to all users</a>
                </div>
            </div>
        </ul>
    </div>
</div>

@stop