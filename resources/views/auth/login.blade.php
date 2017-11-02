@extends('layout.app')

@section('content')


    <div class="row">
        <div class="col-sm-6 offset-sm-3">
            <h1>Connexion</h1>
            <form class="form-signin" action="{{ route('login') }}" method="POST">
                {{ csrf_field() }}

                <div class="form-group mb-1 {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="control-label sr-only">E-Mail Address</label>

                    <input id="email" type="email" class="form-control" name="email" placeholder="Email address" value="{{ old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                    @endif
                </div>

                <div class="form-group mb-1{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label sr-only">Password</label>

                    <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                    @endif
                </div>

                <div class="form-group mb-1">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                        </label>
                    </div>
                </div>

                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary btn-block btn-lg">
                        Login
                    </button>

                    <a class="" href="{{ route('password.request') }}">
                        Forgot Your Password?
                    </a>
                </div>
            </form>
        </div>
    </div>


@endsection
