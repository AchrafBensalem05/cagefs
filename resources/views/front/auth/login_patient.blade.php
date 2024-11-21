@extends('front.layout')



@section('content')
    <div class="contant-us-container">
        <div class="contact-us h-auto">
            @if (flash()->message)
                <div class="{{ flash()->class }}">
                    {{ flash()->message }}
                </div>
            @endif
            <div class="contacts-form ms-0" >
                <form action="{{ route("patient.attempt_login") }}" method="post">
                @csrf
                <div class="ms-auto w-100" style="grid-template-rows:unset">
                    <span>{{ $title }}</span>
                    <p>@lang("You don't have account ? ")<a href="{{ route('patient.register') }}">@lang("Create")</a></p>
                    <input name="email" type="text" placeholder="@lang("Email ...")" required="required" class="m-1">
                    @error('email')
                    <small class="text-danger text-bold">{{ $message }}</small>
                    @enderror
                    <input name="password" type="password" placeholder="@lang("Password ...")" required="required" class="m-1">
                    @error('password')
                    <small class="text-danger text-bold">{{ $message }}</small>
                    @enderror
                    <button type="submit">@lang("Sign in")</button>
                </div>
                </form>
                <a href="{{ route('auth0_google') }}" class="w-100 btn btn-success rounded-0"><i class="fa fa-google"></i>@lang("Connect with Google")</a>

            </div>
        </div>
    </div>
@endsection

