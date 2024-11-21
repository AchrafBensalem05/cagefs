@extends("front.patients.layout")


@section("sidebar")
    <ul>
        <li class="submenu-open">
            <h6 class="submenu-hdr">Main</h6>
            <ul>
                <li class="active">
                    <a href="{{ route('patient.dashboard') }}"><i class="fa fa-columns"></i><span class="px-2">@lang("Dashboard")</span></a>
                </li>
                <li class="">
                    <a href="{{ route('patient.profile') }}"><i class="fa fa-user"></i><span class="px-2">@lang("My Profile")</span></a>
                </li>
                <li>
                    <a href="{{ route('patient.get_my_appointments_page') }}"><i class="fa fa-user-md"></i> <span class="px-2">@lang("My Appointments")</span></a>
                </li>
                <li class="">
                    <a href="{{ route('patient.get_my_chat_page' , ["type" => "healthcare"] ) }}"><i class="fa fa-envelope"></i><span class="px-2">@lang("Healthcare Messages")</span></a>
                </li>
                <li class="">
                    <a href="{{ route('patient.get_my_chat_page', ["type" => "patient"] ) }}"><i class="fa fa-comments"></i><span class="px-2">@lang("Timeline Messages")</span></a>
                </li>
                <li class="">
                    <a href="{{ route('patient.timeline') }}"><i class="fa fa-newspaper"></i><span class="px-2">@lang('Manage posts')</span></a>
                </li>
                <li class="">
                    <a href="{{ route('patient.saved_announces') }}"><i class="fa fa-save"></i><span class="px-2">@lang('Saved Announces')</span></a>
                </li>
                <li>
                    <form action="{{ route('logout_patient') }}" method="post">@csrf
                        <button  type="submit" style="font-weight: 500;font-size: 16px;color: #67748e;position: relative;display: flex;align-items: center;padding: 8px 15px;background: unset;border: 0;">
                            <i class="fa fa-door-open"></i>
                            <span class="px-2">@lang("Sign out")</span>
                        </button>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
@endsection
@section('content')
    
    <div class="profile-set">
        <div class="profile-head"></div>
        <div class="profile-top">
            <div class="profile-content d-flex align-items-left" style="margin-left:3%;flex-direction:row;width:95%;">
                <div class="profile-contentimg">
                    <img src="{{ $profile->getFirstMediaUrl('avatar' , 'thumb') }}" alt="img" id="blah">
                </div>
                <div class="profile-contentname" style="margin-left:3%;">
                    <h2> {{ $profile->fname }} {{ $profile->lname }}</h2>
                </div>
            </div>
        </div>
    </div>
    
    
    <!--------------------------------------------------------------->
    <!--------------------button commands---------------------------->
    <div class="ntbs-container">
        <style>
        .ntbs-container{
            width:90vw;
            max-width:620px;
            height:14vw;
            max-height:350px;
            display:grid;
            grid-template-columns: repeat(2, 1fr);
            grid-template-rows: repeat(5, 1fr);
            margin:auto;
        }
        
        .btn-profil-user{
            grid-column: 1 span;
            grid-row: 1 span;
            width:98%;
            height:94%;
            background-color:grey;
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            border:none;
            border-radius:10px;
            font-size:16px;
            color:#fff;
            white-space: nowrap;
            margin:5%;
        }
        .ntbs-container .wide-btn-profil-user{grid-row: 2 span;height:97%;background-color:#bc0653;}
        .ntbs-container .btn2{background-color:#0007bd;}
        .ntbs-container .btn3{background-color:#01bfa6;}
        .ntbs-container .btn4{background-color:#0007bd;}
        .ntbs-container .btn5{background-color:#01bfa6;}
        .ntbs-container .btn6{background-color:#000851;}
        .ntbs-container .btn7{background-color:#01bfa6;}
        .ntbs-container .wide-btn-profil-user2{grid-column: 2 span;margin: 3%;background-color:#bc0653;}
        .btn-profil-user button{
             display: flex;
             align-items: center;
             justify-content:center;
             background: unset;
             border: 0;
             height:100%;
             width:100%;
             color:#fff;
         }
        .btn-profil-user i{
            font-size:25px;
            margin:5px 10px 0 10px;
        }
        .btn-profil-user span{
            font-size:15px;
            
        }
        </style>
                    <a href="{{ route('patient.dashboard') }}" class="btn-profil-user wide-btn-profil-user"><i class="fas fa-home"></i><span class="px-2">@lang("Home Page")</span></a>
                    <a href="{{ route('patient.profile') }}" class="btn-profil-user btn2"><i class="fa fa-user"></i><span class="px-2">@lang("My Profile")</span></a>
                    <a href="{{ route('patient.get_my_appointments_page') }}" class="btn-profil-user btn3"><i class="fa fa-user-md"></i> <span class="px-2">@lang("My Appointments")</span></a>
                    <a href="{{ route('patient.get_my_chat_page' , ["type" => "healthcare"] ) }}" class="btn-profil-user btn4"><i class="fa fa-envelope"></i><span class="px-2">@lang("Healthcare Messages")</span></a>
                    <a href="{{ route('patient.get_my_chat_page', ["type" => "patient"] ) }}" class="btn-profil-user btn5"><i class="fa fa-comments"></i><span class="px-2">@lang("Timeline Messages")</span></a>
                    <a href="{{ route('patient.timeline') }}" class="btn-profil-user btn6"><i class="fa fa-newspaper"></i><span class="px-2">@lang('Manage posts')</span></a>
                    <a href="{{ route('patient.saved_announces') }}" class="btn-profil-user btn7"><i class="fa fa-save"></i><span class="px-2">@lang('Saved Announces')</span></a>
                    <form class="btn-profil-user wide-btn-profil-user2" action="{{ route('logout_patient') }}" method="post">@csrf
                        <button  type="submit">
                            <i class="fa fa-door-open"></i>
                            <span class="px-2">@lang("Sign out")</span>
                        </button>
                    </form>
    </div>
    
   <!--
    <div class="page-header mt-4">
        <div class="page-title">
            <h4>{{ $title }}</h4>
            <h6>@lang("Quick Access")</h6>
        </div>
    </div>
       -->
   <!--   
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 order-xl-first ">
                <div class="card">
                    <form action="{{ url()->current() }}" method="post">
                        @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">@lang("Search")</label>
                            <input name="q" type="search"  value="@if(request()->get('q')) {{ request()->get('q') }} @endif" class="form-control" placeholder="keywords ... ">
                        </div>
                        <div class="form-group">
                            <label for="">@lang("Wilaya")</label>
                            <select class="select2bs4 form-control"  name="wilaya" id="wilaya_select">
                                <option value="*">@lang("All")</option>
                                @foreach($wilayas as $wilaya)
                                    <option @if(request()->get('wilaya')  == $wilaya->id  ) selected @endif value="{{ $wilaya->id }}"  dairas-url="{{ route('get_dairas_by_wilaya' , $wilaya->id) }}">{{ $wilaya->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">@lang("Daira")</label>
                            <select name="daira_id" class="select2bs4 form-control" id="">
                                <option value="*">@lang("All")</option>
                                @if(request()->get('wilaya') )
                                    @php
                                       $dairas =  \App\Models\Daira::whereHas('wilaya' , function ($builder){
                                           $builder->where('wilaya_id' , request()->get("wilaya"));
                                       })->get()
                                    @endphp
                                    @foreach($dairas as $daira)
                                        <option @if(request()->get('daira_id')  == $daira->id  ) selected @endif value="{{ $daira }}">{{ $daira->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label>@lang("Filter By Healthcare Entity")</label>
                            <select name="type" class="select2bs4" >
                                <option value="*">@lang("All")</option>
                                @foreach(\App\Models\HealthcareEntity::Types as $key => $entity)
                                    @if(!in_array($key , [2 , 3]))
                                        <option  @if(request()->get('type')  == $key ) selected @endif value="{{ $key }}">{{ $entity }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <a href="{{ url()->current() }}" class="d-inline btn btn-sm btn-outline-secondary w-25">@lang("Reset")</a>
                        <button class="btn btn-sm btn-info fw-bolder text-white w-75">@lang("Search") <i class="fa fa-search"></i></button>
                    </div>
                    </form>
                </div>
            </div>
            
            <div class="col-lg-12 col-md-12 ">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @if($healthcares->count())
                                @foreach($healthcares as $healthcare)
                                    <div class="col-12 col-md-12 col-lg-6 col-xl-4 d-flex">
                                        <div class="card flex-fill bg-white">
                                            <img alt="Card Image" src="{{ $healthcare->getFirstMediaUrl('thumbnail', 'sized') }}" class="card-img-top">
                                            <div class="card-header">
                                                <a href="{{ route('front.get_healthcare_entity_page' , $healthcare->slug) }}"></a><h5 class="card-title mb-0">{{ $healthcare->name }}</h5>
                                                <small class="badge bg-success">{{ \App\Models\HealthcareEntity::Types[$healthcare->type] }}</small>
                                                @if($healthcare->is_open_now == 'open')
                                                    <small class="badge bg-info">@lang("OPEN")</small>
                                                @else
                                                    <small class="badge bg-danger">@lang("CLOSE")</small>
                                                @endif
                                                <small>{{ optional(optional($healthcare->daira)->wilaya)->name }} | {{ optional($healthcare->daira)->name }}</small>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text">{{ $healthcare->description }}</p>
                                                <a class="btn-sm btn btn-primary"  href="{{ route("front.get_healthcare_entity_page" , $healthcare->slug) }}">Get Appointment</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="alert alert-warning">@lang("No records found with this criteria") </div>
                            @endif
                            {{ $healthcares->links() }}
                        </div>
                    </div
                   
                    
                    <div class="list-specialist-doctor">
                        @if($healthcares->count())
                            @foreach($healthcares as $entity)
                                <div class="card-thm" >
                                    <div class="card-1">
                                        @if($entity->getFirstMediaUrl('thumbnail', 'sized'))
                                            <img src="{{ $entity->getFirstMediaUrl('thumbnail', 'sized') }}" alt="">
                                        @endif
                                    </div>
                                    <div class="right">
                                        <div class="card-2">
                                            <p class="doctor-name">{{ $entity->fname . ' ' . $entity->lname }}</p>
                                            <p class="doctor-username">{{ $entity->name }}</p>
                                        </div>
                                        <div class="card-3">
                                            @if(optional($entity->services)->count())
                                                    <p>{{ $entity->services->first()->title }}</p>
                                            @endif
                                        </div>
                                        <div class="card-4">
                                            @if($entity->is_open_now == 'open')
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="currentColor" d="M1.998 21v-2h2V4.835a1 1 0 0 1 .821-.984l9.472-1.722a.6.6 0 0 1 .707.59V4h4a1 1 0 0 1 1 1v14h2v2h-4V6h-3v15h-13Zm10-10h-2v2h2v-2Z"></path>
                                                </svg>
                                                Open
                                            @elseif($entity->is_open_now == 'unknown')
                                                <span class="badge bg-info">Unkonw situation</span>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="#ff3856" d="M2.998 21v-2h2V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v15h2v2h-18Zm12-10h-2v2h2v-2Z"></path>
                                                </svg>
                                                <span style="color:red">Closed</span>
                                            @endif
                                        </div>
                                        <div class="bottom">
                                                <div class="card-6">
                                                    <a href="{{ 'https://www.google.com/maps/@' . $entity->maps }}" target="_blank" class="text-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M288 0c-69.59 0-126 56.41-126 126c0 56.26 82.35 158.8 113.9 196.02c6.39 7.54 17.82 7.54 24.2 0C331.65 284.8 414 182.26 414 126C414 56.41 357.59 0 288 0zm0 168c-23.2 0-42-18.8-42-42s18.8-42 42-42s42 18.8 42 42s-18.8 42-42 42zM20.12 215.95A32.006 32.006 0 0 0 0 245.66v250.32c0 11.32 11.43 19.06 21.94 14.86L160 448V214.92c-8.84-15.98-16.07-31.54-21.25-46.42L20.12 215.95zM288 359.67c-14.07 0-27.38-6.18-36.51-16.96c-19.66-23.2-40.57-49.62-59.49-76.72v182l192 64V266c-18.92 27.09-39.82 53.52-59.49 76.72c-9.13 10.77-22.44 16.95-36.51 16.95zm266.06-198.51L416 224v288l139.88-55.95A31.996 31.996 0 0 0 576 426.34V176.02c0-11.32-11.43-19.06-21.94-14.86z"></path>
                                                    </svg>
                                                    </a>
                                                </div>
                
                                            <div class="card-7">
                                                book appointement
                                            </div>
                                        </div>
                
                                        <div class="card-8">
                                            <a href="{{ route('front.get_healthcare_entity_page' , $entity->slug) }}">
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
                    
                </div>
            </div>
            
        </div>
   -->
    
    
 

@endsection
@push('after-styles')
    <link rel="stylesheet" href="{{ asset('theme/css/list-doc-special-style.css') }}">
    <link rel="stylesheet" href="{{ asset("patient/assets/plugins/select2/css/select2.min.css") }}">
@endpush
@push('after-scripts')
    <script src="{{ asset('patient/assets/plugins/select2/js/select2.min.js') }}"></script>

    <script>

        $('.select2bs4').select2({
            placeholder: "Select ..."
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



