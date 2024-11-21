@extends('front.layout')


@section('header')

@endsection


@section('content')

    <div class="container-fluid mt-4 text-center w-xl-50">
        <form action="{{ url()->current() }}" method="post">
            @csrf
            <div class="row">
                <div class="col-lg-4 col-md-12 mb-2">
                    <input name="q" type="search"  value="@if(request()->get('q')){{ request()->get('q') }}@endif" class="form-control" placeholder="keywords ... ">
                </div>
                <div class="col">
                    <select class="select-bs4 form-control h-100"  name="wilaya" id="wilaya_select">
                        <option value="*">All</option>
                        @foreach($wilayas as $wilaya)
                            <option @if(request()->get('wilaya')  == $wilaya->id  ) selected  @endif value="{{ $wilaya->id }}"  dairas-url="{{ route('get_dairas_by_wilaya' , $wilaya->id) }}">{{ $wilaya->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col mb-2">
                    <select name="daira_id" class="select-bs4 form-control" id="">
                        <option value="*">All</option>
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
                <div class="col-md-2 mb-2">
                    <a href="{{ url()->current() }}" class="btn btn-secondary h-100"><i class="mt-2 fa fa-undo"></i></a>
                    <button type="submit" class="btn btn-info h-100"><i class="text-white fa fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>

    <div class="list-specialist-doctor">
        @if($patients->count())
            @foreach($patients as $entity)
                <div class="card-thm" >
                    <div class="card-1">
                        @if($entity->getFirstMediaUrl('avatar', 'sized'))
                            <img src="{{ $entity->getFirstMediaUrl('avatar' , 'sized') }}" alt="">
                        @endif
                    </div>
                    <div class="right">
                        <div class="card-2">
                            <p class="doctor-name">{{ $entity->fname . ' ' . $entity->lname }}</p>
                            <p class="doctor-username">{{ $entity->name }}</p>
                        </div>
                        <div class="card-4">
                            <p>
                                {{ optional(optional($entity->daira)->wilaya)->name . ' , ' . optional($entity->daira)->name  }}
                            </p>
                        </div>
                        <div class="card-3">
                            <a href="">
                                visit profile
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 30 25"><g transform="rotate(180 15 15)"><path fill="currentColor" d="M7.09 14.96c0 .37.12.68.37.92l3.84 3.75c.22.25.51.38.85.38c.35 0 .65-.12.89-.35s.37-.53.37-.88s-.12-.65-.37-.89l-1.64-1.64h10.3c.35 0 .64-.12.87-.37s.34-.55.34-.9s-.11-.65-.34-.9s-.52-.38-.87-.39H11.4l1.64-1.66c.24-.24.37-.53.37-.86c0-.35-.12-.65-.37-.89s-.54-.38-.9-.38c-.32 0-.61.14-.85.41l-3.84 3.75c-.24.25-.36.54-.36.9z"></path></g></svg>
                            </a>
                        </div>

                    </div>
                </div>
            @endforeach
        @else
            <div class="alert alert-warning alert-dismissible"> No records found in this section </div>
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
