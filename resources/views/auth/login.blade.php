@extends('layouts.master')

@section('content')
    <div class="container">
        <nav class="white z-depth-0 nav-breadcrumb">
            <div class="nav-wrapper">
                <div class="col s12">
                    <a href="/" class="breadcrumb grey-text"><i class="material-icons">home</i>Trang chủ</a>
                    <a href="/login" class="breadcrumb grey-text active">Đăng nhập</a>
                </div>
            </div>
        </nav>
        <div class="row ">
            <div class="col s12 m6 offset-l3 offset-m3 l6">
                <div class="card-panel login-container z-depth-2">
                    <h3 class="green-text">Login</h3>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" placeholder="enter email" type="email" class="form-control" name="email"
                                           value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong class="red-text">{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" placeholder="enter password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong class="red-text">{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <input class="filled-in" id="filled-in-box" type="checkbox" name="remember">

                                        <label for="filled-in-box">Remember Me</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">




                                </div>

                            </div>


                    <div class="row center">
                        <div class="col s12 m6 offset-m3 ">
                            <button type="submit" class="btn btn-primary">
                                Login
                            </button>
                        </div>
                        <div class="col s12 m6 offset-m3 ">
                            <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                Forgot Your Password?
                            </a>
                        </div>
                        <div class="col s12 m6 offset-m3 ">
                            <a href="{{route('register')}}" class="btn orange">Register</a>

                        </div>

                        <div class="col s12 center">
                            <h2 class="title-h2">Login with social network</h2>
                            <a href="{{route('social.redirect',['provider'=>'facebook'])}}"><img src="{{asset('/img/fb4848.png')}}"></a>
                            <a href="{{route('social.redirect',['provider'=>'google'])}}"><img src="{{asset('/img/ggplus4848.png')}}"></a>

                        </div>
                        {{--<div class="col s12 m6 offset-m3 ">--}}
                            {{--<a href="{{route('social.redirect',['provider'=>'facebook'])}}" class="btn blue">Login with Facebook</a>--}}

                        {{--</div>--}}
                        {{--<div class="col s12 m6 offset-m3 ">--}}

                        {{--</div>--}}
                    </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
