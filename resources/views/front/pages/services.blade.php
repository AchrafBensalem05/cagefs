@extends('front.layout')


@section('header')

@endsection


@section('content')

    <div class="categorie-medical-doctor">
        @if($services->count())
            @foreach($services as $service)
                <a href="{{ route('front.get_healtcare_entities_page_by_service' , $service->slug) }}" class="cat-med-doc-dev-container">
                    <button class="btn">
                        {!! $service->icon !!}
                        <!--
                        <span>{{ $service->title }}</span>
                        -->
                        <span>@lang($service->title)</span>
                    </button>
                </a>
            @endforeach
        @endif
    </div>

@endsection

@push("after-styles")
    <link rel="stylesheet" href="{{ asset('theme/css/categorie-medical-doctor-style.css') }}">
@endpush
