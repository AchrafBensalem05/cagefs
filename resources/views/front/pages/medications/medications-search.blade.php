@extends('front.layout')


@section('header')

@endsection


@section('content')

        <div class="services-wrap" style="padding-top: 80px;padding-bottom: 80px;">
            <div class="servise-row doctor-book-service-row">
                <a class="service-row-link" href="{{ route('front.get_medication_timeline_page' , 'search') }}">
                    <span>@lang("Search")</span>
                    <p>@lang("Search for medications via prescription")</p>
                </a>
            </div>
            <div class="servise-row doctor-book-service-row">
                <a class="service-row-link" href="{{ route('front.get_medication_timeline_page' , 'offer') }}">
                    <span>@lang("Offers")</span>
                    <p>@lang("Special offers on specific medications")</p>
                </a>
            </div>
        </div>

@endsection

@push("after-styles")
    <link rel="stylesheet" href="{{ asset('theme/css/categorie-Bloos-style.css') }}">
@endpush
