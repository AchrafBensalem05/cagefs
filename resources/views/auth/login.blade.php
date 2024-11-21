@extends('back.layout.app' , ['bodyclass' => "login-page"])

@section('content')
<div class="login-box">
    <div class="login-logo">
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <a href="{{ route('front.home') }}">{{ env('APP_NAME') }}</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input name="email" type="email" class="form-control" placeholder="Email">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input name="password" type="password" class="form-control" placeholder="Password">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input name="remember" type="checkbox" id="remember">
                            <label for="remember">
                                {{ __('Remember me') }}
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">{{ __('Log in') }}</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            @if(Route::has('password.request'))
            <p class="mb-1">
                <span> {{ __('Forgot your password?') }}</span>
                <a href="{{ route('password.request') }}">I forgot my password</a>
            </p>
            @endif
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
@endsection
