@extends('layouts.master')

@section('content')

    <script src='https://www.google.com/recaptcha/api.js'></script>
    <div class="container">
        <nav class="white z-depth-0 nav-breadcrumb">
            <div class="nav-wrapper">
                <div class="col s12">
                    <a href="/" class="breadcrumb grey-text"><i class="material-icons">home</i>Home</a>
                    <a href="/register" class="breadcrumb grey-text active">Register Flipmanga</a>
                </div>
            </div>
        </nav>
        <div class="row">
            <div class="col s12 m6 offset-m3">
                <div class="card-panel">
                    <h3 class="orange-text">Register</h3>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ secure_url('/register') }}">
                            {{ csrf_field() }}
                            <div class="hide">
                                @foreach($errors->all() as $error)
                                <span>{{$error}}</span>
                                    @endforeach
                            </div>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required>
                                </div>
                                <div class="g-recaptcha" data-sitekey="6Le5tA4UAAAAAOeZNbTZQzmrKBZDrF2JunX9p3Bl"></div>
                                @if ($errors->has('capcha') || $errors->has('g-recaptcha-response'))
                                    <span class="help-block">
                                        <strong class="red-text">{{ $errors->first('capcha').$errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary orange">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
