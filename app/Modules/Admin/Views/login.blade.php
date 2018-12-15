@extends('layouts.login_layout')
@section('title','Ventive - Login' )

@section('login')

<form name='frmlogin' method="post" action="{{URL::route("auth.handleLogin")}}">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
   
    <div class="panel panel-body login-form">

        <div class="text-center">
            <div class="icon-object border-warning-400 text-warning-400"><i class="icon-people"></i></div>
            <h5 class="content-group-lg">Login to your account <small class="display-block">Enter your credentials</small></h5>

        </div>
        @include('layouts.message')
        @if( $errors->has('email') )
        <div class="alert alert-danger" >{{ $errors->first('email') }}</div>
        @endif

        <div class="form-group has-feedback has-feedback-left">
            <input type="text" name='email' class="form-control" placeholder="Username">
            <div class="form-control-feedback">
                <i class="icon-user text-muted"></i>
            </div>
        </div>

        <div class="form-group has-feedback has-feedback-left">
            <input type="password" name='password' class="form-control" placeholder="Password">
            <div class="form-control-feedback">
                <i class="icon-lock2 text-muted"></i>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn bg-pink-400 btn-block legitRipple">Login <i class="icon-circle-right2 position-right"></i></button>
        </div>
    </div>
</form>
@stop

