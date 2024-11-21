@extends('front.layout')


@section('header')

@endsection


@section('content')
    <div class="contain-categorie">
        <div class="categorie-laboratory">
            @if($services->count())
                @foreach($services as $service)
                    <div class="col-2">
                        <div class="card m-4">
                            <a class="" href="{{ route('front.get_healtcare_entities_page_by_service' , $service->slug) }}">
                                {!! $service->icon !!}
                            </a>
                            <h6 class="p-2">{{ $service->title }}</h6>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection

@push("after-styles")
    <link rel="stylesheet" href="{{ asset('theme/css/categorie-laboratory-style.css') }}">
@endpush
