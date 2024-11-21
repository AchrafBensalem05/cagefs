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
                <form action="{{ route("healthcare.attempt_login" , $type) }}" method="post">
                    @csrf
                    <div style="grid-template-rows:unset">
                        <span style="background-color:transparent">{{ $title }}</span>
                        <p style="color:black">@lang("You don't have account ? ")<a href="{{ route('healthcare.register' , $type) }}">@lang("Create")</a></p>
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
            </div>
        </div>
    </div>
@endsection
@push('after-styles')
    <link rel="stylesheet" href="{{ asset('theme/css/auth-form-styles.css') }}">
    
@endpush