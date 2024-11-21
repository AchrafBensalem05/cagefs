@extends('front.layout')



@section('content')
    <div class="contant-us-container">
        <div class="contact-us h-auto">
            @if (flash()->message)
                <div class="{{ flash()->class }}">
                    {{ flash()->message }}
                </div>
            @endif
            <div class="container" style="margin:6vh auto;">
                <div class="row" style="display:flex; justify-content:center;">
                    <div class="col-10 text-center" >
                        <!--<img " src="{{ $config->getFirstMediaUrl('images', 'thumb') }}">-->
                        <img style="max-height: 160px;margin-bottom:20px;" src="{{asset('theme/img/logo zellig circle.svg')}}" alt="">
                    </div>
                    <div class="col-10 mb-4">
                        <a href="{{ route('patient.login') }}"  style="background-color: #7d3c98;height:50px;display:flex;align-items:center;justify-content:center;border:none;" class="btn rounded-3 btn-primary w-100">@lang("Login as") @lang("User")</a>
                    </div>
                    <div class="col-10 mb-3">
                        <a href="{{ route("healthcare.login" , ['type' => 0]) }}" style="background-color: #01bfa6;height:50px;display:flex;align-items:center;justify-content:center;border:none;" class="btn rounded-3 btn-info w-100 text-white">@lang("Login as") @lang("Doctor")</a>
                    </div>
                    <!--
                    <div class="col-10 mb-6">
                        <a href="{{ route("healthcare.login" , ['type' => 2]) }}" class="btn rounded-3 btn-success w-100">@lang("Login as") @lang("Hospital")</a>
                    </div>
                    <div class="col-10 mb-6">
                        <a href="{{ route("healthcare.login" , ['type' => 1]) }}" style="background-color: #090979;" class="btn rounded-3 btn-primary w-100">@lang("Login as") @lang("Clinic")</a>
                    </div>
                    <div class="col-10 mb-6">
                        <a href="{{ route("healthcare.login" , ['type' => 3]) }}" class="btn rounded-3 btn-info w-100 text-white">@lang("Login as") @lang("Laboratory")</a>
                    </div>
                    -->
                    <div class="col-10 mb-3">
                        <a href="{{ route("healthcare.login" , ['type' => 4]) }}" style="background-color: #3e4393;height:50px;display:flex;align-items:center;justify-content:center;border:none;" class="btn rounded-3 btn-success w-100">@lang("Login as") @lang("Pharmacy")</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

