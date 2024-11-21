@extends('front.layout')


@section('header')

@endsection


@section('content')

    <div class="container-fluid mt-4 text-center w-xl-50">
        <form action="{{ url()->current() }}" method="post">
            @csrf
             <div class="row">
            <div class="col-lg-4 col-md-12 mb-2">
                <input name="q" type="search"  value="@if(request()->get('q')){{ request()->get('q') }}@endif" class="form-control" placeholder="@lang("Keywords")..." style="letter-spacing:0;">
            </div>
            <div class="col">
                <select class="select-bs4 form-control h-100"  name="wilaya" id="wilaya_select">
                    <option value="*">@lang("")All</option>
                    @foreach($wilayas as $wilaya)
                        <option @if(request()->get('wilaya')  == $wilaya->id  ) selected  @endif value="{{ $wilaya->id }}"  dairas-url="{{ route('get_dairas_by_wilaya' , $wilaya->id) }}">{{ $wilaya->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col mb-2">
                <select name="daira_id" class="select-bs4 form-control" id="">
                    <option value="*">@lang("All")</option>
                    @if(request()->get('wilaya') )
                        @php
                            $dairas =  \App\Models\Daira::whereHas('wilaya' , function ($builder){
                                $builder->where('wilaya_id' , request()->get("wilaya"));
                            })->get()
                        @endphp
                        @foreach($dairas as $daira)
                            <option @if(request()->get('daira_id')  == $daira->id  ) selected  @endif value="{{ $daira }}">{{ $daira->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="col mb-2">
                <select name="type" class="select-bs4" >
                    <option value="*">@lang("All")</option>
                    @foreach(\App\Models\HealthcareEntity::Types as $key => $type)
                        @if(!in_array($key , [2 , 3]))
                            <option  @if(request()->get('type')  == $key ) selected  @endif value="{{ $key }}">{{ $type }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
             <div class="col mb-2">
                 <select name="sex" class="select-bs4" >
                     <option value="*">@lang("All")</option>
                     <option value="female" @if(request()->get('sex')  == 'female' ) selected  @endif>@lang("Only female doctors")</option>
                     <option value="male" @if(request()->get('sex')  == 'male' ) selected  @endif>@lang("Only male doctors")</option>
                </select>
            </div>
            <div class="col-md-2 mb-2">
                <a href="{{ url()->current() }}" class="btn btn-secondary h-100"><i class="mt-2 fa fa-undo"></i></a>
                <button type="submit" class="btn btn-info h-100"><i class="text-white fa fa-search"></i></button>
            </div>
        </div>
        </form>
    </div>

    <div class="list-specialist-doctor">
       
        @if($healthcares->count())
              @foreach($healthcares as $healthcare)
                     <div class="card-thm" >
            <div class="card-1">
                @if($healthcare->getFirstMediaUrl('thumbnail', 'sized'))
                    <a href="{{ route('front.get_healthcare_entity_page' , $healthcare->slug) }}" style="color:#002664;text-decoration:none;"><img src="{{ $healthcare->getFirstMediaUrl('thumbnail', 'sized') }}" alt=""></a>
                @endif
            </div>
            <div class="right">
                <div class="card-2">
                    <p class="doctor-name"><a href="{{ route('front.get_healthcare_entity_page' , $healthcare->slug) }}" style="color:#002664;text-decoration:none;">{{ $healthcare->fname . ' ' . $healthcare->lname }}</a></p>
                    <p class="doctor-username">
                        <a href="{{ route('front.get_healthcare_entity_page' , $healthcare->slug) }}" style="color:#444;text-decoration:none;">{{ $healthcare->name }}</a></p>
                </div>

                <div class="card-3">
                    @if(optional($healthcare->services)->count())
                        <p> @lang($healthcare->services->first()->title) ...</p>
                        
                    @elseif($healthcare->type==4)
                        <p>@lang("Pharmacy")</p>
                    @endif

                </div>

                <div class="card-4">
                    @if($healthcare->is_open_now == 'open')
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="currentColor" d="M1.998 21v-2h2V4.835a1 1 0 0 1 .821-.984l9.472-1.722a.6.6 0 0 1 .707.59V4h4a1 1 0 0 1 1 1v14h2v2h-4V6h-3v15h-13Zm10-10h-2v2h2v-2Z"></path>
                        </svg>
                        <span>@lang("Open")</span>
                    @elseif($healthcare->is_open_now == 'unknown')
                        <span class="badge bg-info">@lang("Unkonw situation")</span>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="#ff3856" d="M2.998 21v-2h2V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v15h2v2h-18Zm12-10h-2v2h2v-2Z"></path>
                        </svg>
                        <span style="color:red">@lang("Closed")</span>
                    @endif
                </div>
                <div class="bottom">
                    <div class="card-6">
                        <!--<a href="{{ 'https://www.google.com/maps/@' . $healthcare->maps }}" target="_blank" class="text-center">-->
                        <a href="google.navigation:q={{ $healthcare->maps }}" target="_blank" class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M288 0c-69.59 0-126 56.41-126 126c0 56.26 82.35 158.8 113.9 196.02c6.39 7.54 17.82 7.54 24.2 0C331.65 284.8 414 182.26 414 126C414 56.41 357.59 0 288 0zm0 168c-23.2 0-42-18.8-42-42s18.8-42 42-42s42 18.8 42 42s-18.8 42-42 42zM20.12 215.95A32.006 32.006 0 0 0 0 245.66v250.32c0 11.32 11.43 19.06 21.94 14.86L160 448V214.92c-8.84-15.98-16.07-31.54-21.25-46.42L20.12 215.95zM288 359.67c-14.07 0-27.38-6.18-36.51-16.96c-19.66-23.2-40.57-49.62-59.49-76.72v182l192 64V266c-18.92 27.09-39.82 53.52-59.49 76.72c-9.13 10.77-22.44 16.95-36.51 16.95zm266.06-198.51L416 224v288l139.88-55.95A31.996 31.996 0 0 0 576 426.34V176.02c0-11.32-11.43-19.06-21.94-14.86z"></path>
                            </svg>
                        </a>
                    </div>

                    <div class="card-7">
                        <a href="{{ route('front.get_healthcare_entity_page' , $healthcare->slug) }}" style="color:#fff;text-decoration:none;">
                            @if($healthcare->type==0)
                                @lang("book appointement")
                            @elseif($healthcare->type==4)
                                @lang("Ask Now")
                            @endif
                        </a>
                    </div>
                </div>

                <div class="card-8">
                    <a href="{{ route('front.get_healthcare_entity_page' , $healthcare->slug) }}" style="direction:ltr;">
                        @lang("visit profile")
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 30 25"><g transform="rotate(180 15 15)"><path fill="currentColor" d="M7.09 14.96c0 .37.12.68.37.92l3.84 3.75c.22.25.51.38.85.38c.35 0 .65-.12.89-.35s.37-.53.37-.88s-.12-.65-.37-.89l-1.64-1.64h10.3c.35 0 .64-.12.87-.37s.34-.55.34-.9s-.11-.65-.34-.9s-.52-.38-.87-.39H11.4l1.64-1.66c.24-.24.37-.53.37-.86c0-.35-.12-.65-.37-.89s-.54-.38-.9-.38c-.32 0-.61.14-.85.41l-3.84 3.75c-.24.25-.36.54-.36.9z"></path></g></svg>
                    </a>
                </div>
            </div>
        </div>
              @endforeach

        @else
            <div class="alert alert-warning alert-dismissible" style="width:auto; padding: 40px;margin:40px auto;">@lang("No results found")</div>
        @endif
    </div>
@endsection

@push('after-styles')
    <link rel="stylesheet" href="{{ asset('theme/css/list-doc-special-style.css') }}">
    <link rel="stylesheet" href="{{ asset("patient/assets/plugins/select2/css/select2.min.css") }}">
    <style>
        .select2-container--default .select2-selection--multiple {
            height: 50px;
            grid-row: span 1;
            grid-column: span 2;
            font-size: 18px;
            letter-spacing: 1px;
            color: #000851;
            background-color: #eee;
            text-transform: lowercase;
            font-family: Arial, Helvetica, sans-serif;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding-left: 20px;
            outline: none;
        }
        .select2-selection__rendered {
            line-height: 46px !important;
        }
        .select2-container .select2-selection--single {
            height: 47px !important;
        }
        .select2-selection__arrow {
            height: 44px !important;
        }
    </style>
@endpush
@push('after-scripts')
    <script src="{{ asset('patient/assets/plugins/select2/js/select2.min.js') }}"></script>

    <script>

        $('.select2bs4').select2({
            multiple: true,
            maximumSelectionLength:1,
            placeholder: "Select ...",
        })
        $('.select-bs4').select2({
            placeholder: "Select ...",
        })

        $('#wilaya_select').on('change' , function (event)
        {
            $.get($(event.target).find('option:selected').attr('dairas-url') , function (data)
            {
                let daira_select = $('select[name=daira_id]');
                daira_select.empty()
                daira_select.append(`<option value="*">All</option>`)
                data.forEach(function (daira){
                    daira_select.append(`<option value="${daira.id}">${daira.name}</option>`)
                })
            } , 'json')
        })
    </script>
@endpush
