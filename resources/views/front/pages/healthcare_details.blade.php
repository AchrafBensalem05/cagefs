@extends('front.layout')

@php
       $prefix_type = [
               '0'     =>      "Dr",
               '1'     =>      "Clc",
               "2"     =>      "Hos",
               "3"     =>      "Lab",
               '4'     =>      "Pha"
               ];
       $pattern = '/^[-+]?([1-8]?\d(\.\d+)?|90(\.0+)?),\s*[-+]?(180(\.0+)?|((1[0-7]\d)|([1-9]?\d))(\.\d+)?)$/';
@endphp



@section('header')

@endsection


@section('content')


    <div class="hero" style="background: #fff">
        <div class="header-doctor-profile">
            <div class="swiper background-swiper doctor-backgroud-profile">
                    <div class="swiper-wrapper">
                                @foreach($healthcare->getMedia('background') as $file)
                                <div class="swiper-slide">
                                    <img src="{{ $file->getUrl('sized') }}" >
                                </div>
                                @endforeach
                    </div>
                </div>

            <div class="doctor-photo-profile">
                <a href="#" style="text-decoration: none;"><img src="{{ $healthcare->getFirstMediaUrl('thumbnail' , 'sized') }}" alt=""></a>
            </div>

            <div class="phone-doctor-name-ident-specialite">
                <div class="phone-doctor-name-ident">
                    <div class="phone-doctor-name">{{ $prefix_type[$healthcare->type] }}. {{ $healthcare->fname }} {{ $healthcare->lname }}</div>
                    <div class="phone-doctor-userName">{{ $healthcare->name }}</div>
                </div>
                @if(in_array($healthcare->type,[0]))
                    <div class="phone-doctor-specialite">
                        @lang($healthcare->services->first()->title)
                    </div>
                @elseif(in_array($healthcare->type,[4]))
                <div class="phone-doctor-specialite">
                    @lang("Pharmacy")
                </div>
                @endif
            </div>

            <div class="phone-opening-etat">
                <div class="content-border">
                    <span class="right-ttl" @style(['color: #39bda7' => $healthcare->is_open_now == 'open'])><style>.phone-opening-etat .right-ttl::after, .phone-opening-etat .right-ttl::before{background-color:#39bda7;}</style>@if($healthcare->is_open_now == 'open')@lang("Currently Open") @else @lang("Currently Closed") <style>.phone-opening-etat .right-ttl::after, .phone-opening-etat .right-ttl::before{background-color:#ff1f47;}</style> @endif </span>
                    @if($healthcare->is_open_now == "closed")
                    <div class="dv-1 mb-0">
                        <span>@lang("Reason Of Closure :")</span>
                        <p class="mb-0">{{ __("{$healthcare->closure_reason}") }}</p>
                    </div>
                    <div class="dv-2 mb-0">
                        <span>@lang("Reopening Date :")</span>
                        <p class="mb-0">{{ $healthcare->next_open }}
                            <span style="color: blue;">
                                @if($healthcare->next_open != 'unknown')
                                    {{ \Carbon\Carbon::parse($healthcare->next_open)->diffForHumans(\Carbon\Carbon::now())}}
                                @endif
                            </span>
                        </p>
                    </div>
                    @endif
                </div>
            </div>
            <div class="doctor-principals-info">
                <div class="top">
                    <div class="left">
                        <div class="doctor-name-ident">
                            <div class="doctor-name">{{ $prefix_type[$healthcare->type] }}. {{ $healthcare->fname }} {{ $healthcare->lname }}</div>
                            <div class="doctor-userName">{{ $healthcare->name }}</div>
                        </div>
                        @if(in_array($healthcare->type,[0]))
                            <div class="doctor-specialite">@lang($healthcare->services->first()->title)</div>
                        @endif
                    </div>
                    <div class="right">
                        <div class="content-border mb-0">
                            <span class="right-ttl" @style(['color: green' => $healthcare->is_open_now == 'open'])>@if($healthcare->is_open_now == 'open')@lang("Currently Open") @else @lang("Currently Closed") @endif </span>
                            @if($healthcare->is_open_now == "closed")
                                <div class="mb-0">
                                <span class="spn-1">@lang("Reason Of Closure :")</span>
                                <span class="spn-2">{{ __("{$healthcare->closure_reason}") }}</span>
                                </div>
                                <div class="mb-0">
                                    <span class="spn-1">@lang("Reopening Date :")</span>
                                        {{ $healthcare->next_open }}
                                        <span style="color: blue;">
                                             @if($healthcare->next_open != 'unknown')
                                                {{ \Carbon\Carbon::parse($healthcare->next_open)->diffForHumans(\Carbon\Carbon::now())}}
                                            @endif
                                        </span>

                            </div>
                            @endif
                        </div>

                    </div>
                </div>
                <div class="bottom">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 0C149.3 0 64 85.3 64 192c0 36.9 11 65.4 30.1 94.3l141.7 215c4.3 6.5 11.7 10.7 20.2 10.7s16-4.3 20.2-10.7l141.7-215C437 257.4 448 228.9 448 192C448 85.3 362.7 0 256 0zm0 298.6c-58.9 0-106.7-47.8-106.7-106.8S197.1 85 256 85c58.9 0 106.7 47.8 106.7 106.8S314.9 298.6 256 298.6zm0-170.6c-35.4 0-64 28.6-64 64s28.6 64 64 64s64-28.6 64-64s-28.6-64-64-64z"/></svg>
                        <span>{{ optional($healthcare->daira)->name }} - {{ optional(optional($healthcare->daira)->wilaya)->name }}  - @lang("Algeria")</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M17.256 12.253c-.096-.667-.611-1.187-1.274-1.342c-2.577-.604-3.223-2.088-3.332-3.734C12.193 7.092 11.38 7 10 7s-2.193.092-2.65.177c-.109 1.646-.755 3.13-3.332 3.734c-.663.156-1.178.675-1.274 1.342l-.497 3.442C2.072 16.907 2.962 18 4.2 18h11.6c1.237 0 2.128-1.093 1.953-2.305l-.497-3.442zM10 15.492c-1.395 0-2.526-1.12-2.526-2.5s1.131-2.5 2.526-2.5s2.526 1.12 2.526 2.5s-1.132 2.5-2.526 2.5zM19.95 6c-.024-1.5-3.842-3.999-9.95-4C3.891 2.001.073 4.5.05 6s.021 3.452 2.535 3.127c2.941-.381 2.76-1.408 2.76-2.876C5.345 5.227 7.737 4.98 10 4.98s4.654.247 4.655 1.271c0 1.468-.181 2.495 2.76 2.876C19.928 9.452 19.973 7.5 19.95 6z"/></svg>
                        <span>{{ $healthcare->phones }}</span>
                    </div>
                    <div class="working-hours">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><g><path d="M16.005 23.999a9.003 9.003 0 1 1 0-18.004a9.003 9.003 0 1 1 0 18.004Zm0-5.001c.55 0 1-.44 1-1v-6.002c0-.55-.45-1-1-1s-1 .45-1 1v6.002c0 .55.45 1 1 1Zm1-11.002a1 1 0 1 0-2 0a1 1 0 0 0 2 0Zm-1 15.003a1 1 0 1 0 0-2a1 1 0 0 0 0 2Zm5.952-12.943a1 1 0 1 0-2 0a1 1 0 0 0 2 0ZM11.053 20.948a1 1 0 1 0 0-2a1 1 0 0 0 0 2ZM23.9 14.556a1 1 0 1 0-1.796.881a1 1 0 0 0 1.796-.881ZM9.438 15.894a1 1 0 1 0-.88-1.796a1 1 0 0 0 .88 1.796Zm11.832 3.11a1 1 0 1 0-.647 1.893a1 1 0 0 0 .647-1.893ZM12 10.376a1 1 0 1 0-1.893-.648a1 1 0 0 0 1.893.648Z"/><path d="M15.375 2.015C8.382 2.345 3 8.365 3 15.367V26.88C3 28.6 4.4 30 6.121 30H25.88c1.719 0 3.12-1.4 3.12-3.12V14.996c.01-7.381-6.162-13.332-13.625-12.982Zm.63 23.984C9.928 26 5.001 21.073 5.001 14.997C5 8.921 9.928 3.995 16.005 3.995c6.078 0 11.004 4.926 11.004 11.002C27.01 21.073 22.082 26 16.005 26Z"/></g></svg>
                        <span>{{ $healthcare->opening_hours_display }}</span>
                    </div>
                </div>
            </div>
            <div class="navbar-bottom-buttons-user">
                @if($healthcare->type != 4)
                    <button class="btn-nvbr-1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path d="M9.5 2A1.5 1.5 0 0 0 8 3.5v1A1.5 1.5 0 0 0 9.5 6h5A1.5 1.5 0 0 0 16 4.5v-1A1.5 1.5 0 0 0 14.5 2h-5Z"/><path fill-rule="evenodd" d="M6.5 4.037c-1.258.07-2.052.27-2.621.84C3 5.756 3 7.17 3 9.998v6c0 2.829 0 4.243.879 5.122c.878.878 2.293.878 5.121.878h6c2.828 0 4.243 0 5.121-.878c.879-.88.879-2.293.879-5.122v-6c0-2.828 0-4.242-.879-5.121c-.569-.57-1.363-.77-2.621-.84V4.5a3 3 0 0 1-3 3h-5a3 3 0 0 1-3-3v-.463ZM7 9.75a.75.75 0 0 0 0 1.5h.5a.75.75 0 0 0 0-1.5H7Zm3.5 0a.75.75 0 0 0 0 1.5H17a.75.75 0 0 0 0-1.5h-6.5ZM7 13.25a.75.75 0 0 0 0 1.5h.5a.75.75 0 0 0 0-1.5H7Zm3.5 0a.75.75 0 0 0 0 1.5H17a.75.75 0 0 0 0-1.5h-6.5ZM7 16.75a.75.75 0 0 0 0 1.5h.5a.75.75 0 0 0 0-1.5H7Zm3.5 0a.75.75 0 0 0 0 1.5H17a.75.75 0 0 0 0-1.5h-6.5Z" clip-rule="evenodd"/></g></svg>
                    <span>@lang("book appointment in waiting list")</span>
                </button>
                @else
                    <button class="btn-nvbr-1" @if(\Illuminate\Support\Facades\Auth::guard("patient")->user()) data-bs-toggle="modal" data-bs-target="#medication-modal" @else onclick="alert('@lang('You need to login')')" @endif >
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path d="M9.5 2A1.5 1.5 0 0 0 8 3.5v1A1.5 1.5 0 0 0 9.5 6h5A1.5 1.5 0 0 0 16 4.5v-1A1.5 1.5 0 0 0 14.5 2h-5Z"/><path fill-rule="evenodd" d="M6.5 4.037c-1.258.07-2.052.27-2.621.84C3 5.756 3 7.17 3 9.998v6c0 2.829 0 4.243.879 5.122c.878.878 2.293.878 5.121.878h6c2.828 0 4.243 0 5.121-.878c.879-.88.879-2.293.879-5.122v-6c0-2.828 0-4.242-.879-5.121c-.569-.57-1.363-.77-2.621-.84V4.5a3 3 0 0 1-3 3h-5a3 3 0 0 1-3-3v-.463ZM7 9.75a.75.75 0 0 0 0 1.5h.5a.75.75 0 0 0 0-1.5H7Zm3.5 0a.75.75 0 0 0 0 1.5H17a.75.75 0 0 0 0-1.5h-6.5ZM7 13.25a.75.75 0 0 0 0 1.5h.5a.75.75 0 0 0 0-1.5H7Zm3.5 0a.75.75 0 0 0 0 1.5H17a.75.75 0 0 0 0-1.5h-6.5ZM7 16.75a.75.75 0 0 0 0 1.5h.5a.75.75 0 0 0 0-1.5H7Zm3.5 0a.75.75 0 0 0 0 1.5H17a.75.75 0 0 0 0-1.5h-6.5Z" clip-rule="evenodd"/></g></svg>
                        <span>@lang("Ask For Medication")</span>
                    </button>
                @endif
                <button class="btn-nvbr-2">
                    <!--<a href="{{ 'https://www.google.com/maps/@' . $healthcare->maps }}"  style="text-decoration: none; display: flex;align-items: center;" target="_blank">-->
                    <a href="google.navigation:q={{ $healthcare->maps }}"  style="text-decoration: none; display: flex;align-items: center;" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M408 120c0 54.6-73.1 151.9-105.2 192c-7.7 9.6-22 9.6-29.6 0C241.1 271.9 168 174.6 168 120C168 53.7 221.7 0 288 0s120 53.7 120 120zm8 80.4c3.5-6.9 6.7-13.8 9.6-20.6c.5-1.2 1-2.5 1.5-3.7l116-46.4c15.8-6.3 32.9 5.3 32.9 22.3v270.8c0 9.8-6 18.6-15.1 22.3L416 503V200.4zm-278.4-62.1c2.4 14.1 7.2 28.3 12.8 41.5c2.9 6.8 6.1 13.7 9.6 20.6v251.4L32.9 502.7C17.1 509 0 497.4 0 480.4V209.6c0-9.8 6-18.6 15.1-22.3l122.6-49zM327.8 332c13.9-17.4 35.7-45.7 56.2-77v249.3l-192-54.9V255c20.5 31.3 42.3 59.6 56.2 77c20.5 25.6 59.1 25.6 79.6 0zM288 152a40 40 0 1 0 0-80a40 40 0 1 0 0 80z"/></svg>
                        <span>@lang("location")</span>
                    </a>
                </button>

                <button class="btn-nvbr-3"   @if(!\Illuminate\Support\Facades\Auth::guard("patient")->user()) onclick="alert('{{ __('You need to login')  }}')" @endif>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -1 21 22"><path fill-rule="evenodd" d="m7.172 11.334l2.83 1.935l2.728-1.882l6.115 6.033c-.161.052-.333.08-.512.08H1.667c-.22 0-.43-.043-.623-.12l6.128-6.046ZM20 6.376v9.457c0 .247-.054.481-.15.692l-5.994-5.914L20 6.376ZM0 6.429l6.042 4.132l-5.936 5.858A1.663 1.663 0 0 1 0 15.833V6.43ZM18.333 2.5c.92 0 1.667.746 1.667 1.667v.586L9.998 11.648L0 4.81v-.643C0 3.247.746 2.5 1.667 2.5h16.666Z"/></svg>
                    <span>@lang("send email")</span>
                </button>

                <button class="btn-nvbr-4" >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="2 2 20 20"><path fill-rule="evenodd" d="M10 4h4c3.771 0 5.657 0 6.828 1.172C22 6.343 22 8.229 22 12c0 3.771 0 5.657-1.172 6.828C19.657 20 17.771 20 14 20h-4c-3.771 0-5.657 0-6.828-1.172C2 17.657 2 15.771 2 12c0-3.771 0-5.657 1.172-6.828C4.343 4 6.229 4 10 4Zm3.25 5a.75.75 0 0 1 .75-.75h5a.75.75 0 0 1 0 1.5h-5a.75.75 0 0 1-.75-.75Zm1 3a.75.75 0 0 1 .75-.75h4a.75.75 0 0 1 0 1.5h-4a.75.75 0 0 1-.75-.75Zm1 3a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 0 1.5h-3a.75.75 0 0 1-.75-.75ZM11 9a2 2 0 1 1-4 0a2 2 0 0 1 4 0Zm-2 8c4 0 4-.895 4-2s-1.79-2-4-2s-4 .895-4 2s0 2 4 2Z" clip-rule="evenodd"/></svg>
                    <span>@lang("sharing doctor ID")</span>
                </button>
            </div>
        </div>

        @if($healthcare->type != 4)
            <div class="appointtement-list" >
                <div class="laboratory-apptmt-list-background" onclick="closeAppointtementList()"></div>
                <div class="Table">
                    <button class="cls-appoint-tbl">
                        <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" viewBox="0 0 256 256"><path d="M208 34H48a14 14 0 0 0-14 14v160a14 14 0 0 0 14 14h160a14 14 0 0 0 14-14V48a14 14 0 0 0-14-14Zm2 174a2 2 0 0 1-2 2H48a2 2 0 0 1-2-2V48a2 2 0 0 1 2-2h160a2 2 0 0 1 2 2Zm-45.76-107.76L136.48 128l27.76 27.76a6 6 0 1 1-8.48 8.48L128 136.48l-27.76 27.76a6 6 0 0 1-8.48-8.48L119.52 128l-27.76-27.76a6 6 0 0 1 8.48-8.48L128 119.52l27.76-27.76a6 6 0 0 1 8.48 8.48Z"/></svg>
                    </button>

                    <div class="table-header">
                        <div class="tbl-ttl">
                            <span>@lang("Appointtement List")</span>
                        </div>
                        @if($healthcare->limit_patient > optional($healthcare->registrations_for_the_opened_day)->count() or $healthcare->limit_patient == null)
                            <div class="tbl-btn">
                                <button class="rounded-3"

                                @if(!\Illuminate\Support\Facades\Auth::guard("patient")->user())  onclick="alert('{{ __('You need to login')  }}')"  @else  data-bs-toggle="modal" data-bs-target="#appointment-modal" @endif>

                                    @lang("Ask an appointment")</button>
                                    <button class="add-appoint-btn rounded-3">@lang("Book in waiting list")</button>
                            </div>
                        @endif

                    </div>
                    <div class="table-body">
                        <div class="table-container">
                            <div class="search-name">
                                <form method="get" action="{{ url()->current() }}">
                                    <input type="text" name="q" value="{{ request()->get('q') }}" placeholder="@lang("Book then write your name here to know your order")">
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path d="M15.25 2h-6.5A6.76 6.76 0 0 0 2 8.75v6.5A6.76 6.76 0 0 0 8.75 22h6.5A6.76 6.76 0 0 0 22 15.25v-6.5A6.76 6.76 0 0 0 15.25 2m2 14.94a.78.78 0 0 1-.57.23a.8.8 0 0 1-.56-.23l-2-2a4.81 4.81 0 1 1 1.13-1.13l2 2a.79.79 0 0 1 .01 1.13z"/><path d="M14.5 11a3.21 3.21 0 1 1-6.418 0a3.21 3.21 0 0 1 6.418 0"/></svg>
                                        </button>
                                </form>
                            </div>

                            <table class="appoint-list-table">
                                    <tr>
                                        <th class="column1">@lang("Order")</th>
                                        <th class="column2">@lang("Name")</th>
                                        <!--<th>@lang("Service")</th>-->
                                        <th class="column3">@lang("Waiting Delay")</th>
                                    </tr>
                                    @if($healthcare->registrations_for_the_opened_day and $healthcare->registrations_for_the_opened_day->count())
                                        @foreach($healthcare->registrations_for_the_opened_day as $record)
                                            <tr>
                                                <td class="column1">{{ $loop->index +1 }}</td>
                                                <td class="column2" @if($record->status == 'done') style="text-decoration:line-through solid 2px #0073e6;font-size:11.5px" @endif>@if($record->name == request()->get('q'))  {{ request()->get('q') }}  @else <span style="font-size:16px">****&nbsp;&nbsp;&nbsp;****</span> @endif</td>
                                                <!--
                                                <td class="column2" @if($record->status == 'done') style="text-decoration:line-through solid 2px" @endif>@if($record->name == request()->get('q')) {{ optional($record->service)->title }} @else **** @endif</td>
                                                -->
                                                <td class="column3" @if($record->status == 'done') style="text-decoration:line-through solid 2px #0073e6;font-size:11.5px" @endif>@if($record->name == request()->get('q')) {{ $record->started_at }} @else <span style="font-size:16px">****</span> @endif</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </table>
                           
                        </div>
                        <div class="add-appointtement-form">
                            <div class="add-appoint-switcher-btns">
                                <button class="add-appoint-btn btn-with-account" onclick="btnswitcherwithaccount()">@lang("By account")</button>
                                <button class="add-appoint-btn btn-without-account" onclick="btnswitcherwithoutaccount()">@lang("Without")</button>
                            </div>
                            <div class="appointtement-add appointtement-with-account">
                            <span class="appoint-form-ttl">
                                <span>@lang("Book on the waiting list using your account")</span>
                            </span>
                                <form action="{{ route('book_registration_auth', $healthcare->slug) }}" method="post">
                                    @csrf
                                    @if(Auth::guard('patient')->user())
                                        <div class="appoint-inputBox">
                                            <input type="text" name="name" required="required" placeholder="@lang("الإسم الذي ستحجز به")">
                                        </div>
                                    @else
                                        <div class="appoint-inputBox1">
                                            <input type="email"  name="email" required="required" placeholder="@lang("Username")">
                                        </div>
                                        <div class="appoint-inputBox">
                                            <input type="password" name="password" required="required" placeholder="@lang("Password")">
                                        </div>
                                        <div class="appoint-inputBox">
                                            <input type="text" name="name" required="required"  placeholder="@lang("الإسم الذي ستحجز به")">
                                        </div>
                                    @endif
                                    <div class="appoint-inputBox">
                                        <select class="form-control" name="service_id" id="" required>
                                            <option value="" selected disabled>-- @lang("select please") --</option>
                                            @if($healthcare->services->count())
                                                @foreach($healthcare->services as $service)
                                                    <option value="{{ $service->id }}">{{ $service->title }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <button class="appoint-enter-btn">@lang("Book")</button>
                                </form>

                            </div>
                            <div class="appointtement-add appointtement-without-account">
                                <form action="{{ route('book_registration' , $healthcare->slug) }}" method="post">
                                    @csrf
                                    <span class="appoint-form-ttl">
                                        @lang("Book on the waiting list even if you don't have an account")
                                    </span>
                                    <div class="appoint-inputBox1">
                                        <input type="text" name="name" required="required" placeholder="@lang("Full name")">
                                    </div>
                                    <div class="appoint-inputBox">
                                        <input type="text" name="phone" required="required" placeholder="@lang("Phone number")">
                                    </div>
                                    <div class="appoint-inputBox">
                                        <select class="form-control" name="service_id" id="" required>
                                            <option value="" selected disabled>-- @lang("select please")-- </option>
                                            @if($healthcare->services->count())
                                                @foreach($healthcare->services as $service)
                                                    <option value="{{ $service->id }}">{{ $service->title }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <button type="submit" class="appoint-enter-btn">@lang("Book")</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if(\Illuminate\Support\Facades\Auth::guard("patient")->user())
        <!------------------------------------------>
        <div class="email-box-container">
            <style>
                .email-box-container {
                  position: fixed;
                  bottom: 5vw;
                  right: 5vw;
                  width: 300px;
                  height: 220px;
                  background-color: #eee;
                  border-radius: 8px;
                  display: none;
                  flex-direction: column;
                  overflow: hidden;
                  direction:ltr;
                  z-index: 31;
                }
                
                .nav-bar-email-box {
                  width: 100%;
                  height: 60px;
                  background-color: #3e4394;
                  display: flex;
                  align-items: center;
                  justify-content: space-between;
                  color: #fff;
                  font-size:18px;
                  font-weight:700;
                  padding-left: 30px;
                }
                
                .close-btn-email-box{
                  width: 40px;
                  height: 40px;
                  background-color: transparent;
                  border: none;
                  display: flex;
                  justify-content: center;
                  align-items: center;
                  position: relative;
                  cursor: pointer;
                }
                
                .close-btn-email-box svg {
                  position: absolute;
                  width: 30px;
                  height: 30px;
                  fill: #fff;
                  margin-top:-20px;
                }
                .messages-area-email-box {
                  width: 100%;
                  height: 80px;
                }
                
                .messages-area-email-box .notice{
                    width:90%;
                  background-color: #eee;
                  font-size:12px;
                  text-align:justify;
                  border: 1px dashed #2E2F3A;
                  border-radius:3px;
                  padding:3px 6px;
                  margin: 10px auto;
                  
                }
                .sender-area-email-box {
                  background-color: #eee;
                  width: 100%;
                  height: 40px;
                  display: flex;
                  border-radius: 8px;
                }
                .messages-duscussion {
                  width: 100%;
                  height: 120px;
                  background-color: #fff;
                }
                
                
                .send-img {
                  width: 30px;
                }
                
                .send-input-email-box {
                  outline: none;
                  display: flex;
                  border: none;
                  background: none;
                  height: 40px;
                  width: 230px;
                  border-radius: 7px;
                  background: none;
                  color: #40414F;
                  text-overflow: ellipsis;
                  white-space: nowrap;
                  overflow: hidden;
                  margin-left: 5px;
                }
                
                .send-input-email-box::placeholder {
                  color: #828E9E;
                }
                
                .input-place-email-box {
                  display: flex;
                  flex-direction: row;
                  margin-top: 15px;
                  margin-left: 10px;
                  align-items: center;
                  background-color: #fff;
                  border-radius: 7px;
                  height: 40px;
                  width: 280px;
                  gap: 5px;
                  border: 1px solid #2E2F3A;
                }
                
                .send-icon-email-box{
                  width: 30px;
                  height: 30px;
                  background-color: #fff;
                  display: flex;
                  align-items: center;
                  justify-content: center;
                  cursor: pointer;
                }
                
                .send-icon-email-box svg {
                  width: 22px;
                  fill: #3e4394;
                }
            </style>
            <form action="{{ route('patient.send_message_to' , [$healthcare->id , 'healthcare']) }}"  method="post" enctype="multipart/form-data">
                @csrf
                <div class="nav-bar-email-box">
                    @lang("Send  Message")
                    <button class="close-btn-email-box">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 12"><path d="M2.22 2.22a.749.749 0 0 1 1.06 0L6 4.939L8.72 2.22a.749.749 0 1 1 1.06 1.06L7.061 6L9.78 8.72a.749.749 0 1 1-1.06 1.06L6 7.061L3.28 9.78a.749.749 0 1 1-1.06-1.06L4.939 6L2.22 3.28a.749.749 0 0 1 0-1.06Z"/></svg>
                    </button>
                </div>
                <div class="messages-area-email-box">
                    <div class="notice"><b style="color:#FA2742;">@lang("Notice:") </b>@lang("after sending your message, return to your account, go to healthcares messeges & you'll fing the conversation there")</div>
                </div>
                <div class="sender-area-email-box">
                    <div class="input-place-email-box">
                        <input placeholder="@lang("Write your message...")" class="send-input-email-box" type="text" name="content">
                        <button type="submit" class="send-icon-email-box border-0">
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><path d="M481.508,210.336L68.414,38.926c-17.403-7.222-37.064-4.045-51.309,8.287C2.86,59.547-3.098,78.551,1.558,96.808 L38.327,241h180.026c8.284,0,15.001,6.716,15.001,15.001c0,8.284-6.716,15.001-15.001,15.001H38.327L1.558,415.193 c-4.656,18.258,1.301,37.262,15.547,49.595c14.274,12.357,33.937,15.495,51.31,8.287l413.094-171.409 C500.317,293.862,512,276.364,512,256.001C512,235.638,500.317,218.139,481.508,210.336z"></path></g></g></svg>
                        </button>
                    </div>
                </div>
                <div>
                </div>
            </form>
        </div>
        <!------------------------------------->
        @endif
        <div class="labo-identi-container" >
            <div class="laboratory-ident-background" onclick="closeLaboIdentPoster()"></div>
            <div class="laboratory-ident">
                <iframe id="newposterIframe" style="width: 100%;height: 95%;border: none;" src="{{ route('front.get_healthcare_poster_page' , $healthcare->slug) }}"></iframe>

                <div class="labroat-bottom-btn">
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19 12v7H5v-7H3v7c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2v-7h-2zm-6 .67l2.59-2.58L17 11.5l-5 5l-5-5l1.41-1.41L11 12.67V3h2z"/></svg>
                        <span>save</span>
                    </button>
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="m13.576 17.271l-5.11-2.787a3.5 3.5 0 1 1 0-4.968l5.11-2.787a3.5 3.5 0 1 1 .958 1.755l-5.11 2.787a3.514 3.514 0 0 1 0 1.457l5.11 2.788a3.5 3.5 0 1 1-.958 1.755Z"/></svg>
                        <span>share</span>
                    </button>
                    <button class="cls-doc-labo-identic">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><path d="M208.49 191.51a12 12 0 0 1-17 17L128 145l-63.51 63.49a12 12 0 0 1-17-17L111 128L47.51 64.49a12 12 0 0 1 17-17L128 111l63.51-63.52a12 12 0 0 1 17 17L145 128Z"/></svg>
                        <span>close</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="phone-doctor-details">
            <div class="details-title">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 1C5.925 1 1 5.925 1 12s4.925 11 11 11s11-4.925 11-11S18.075 1 12 1Zm-.5 5a1 1 0 1 0 0 2h.5a1 1 0 1 0 0-2h-.5ZM10 10a1 1 0 1 0 0 2h1v3h-1a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-1v-4a1 1 0 0 0-1-1h-2Z" clip-rule="evenodd"/></svg>
                <span class="details-title">@lang("Details")</span>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 0C149.3 0 64 85.3 64 192c0 36.9 11 65.4 30.1 94.3l141.7 215c4.3 6.5 11.7 10.7 20.2 10.7s16-4.3 20.2-10.7l141.7-215C437 257.4 448 228.9 448 192C448 85.3 362.7 0 256 0zm0 298.6c-58.9 0-106.7-47.8-106.7-106.8S197.1 85 256 85c58.9 0 106.7 47.8 106.7 106.8S314.9 298.6 256 298.6zm0-170.6c-35.4 0-64 28.6-64 64s28.6 64 64 64s64-28.6 64-64s-28.6-64-64-64z"/></svg>
                <span>{{ optional($healthcare->daira)->name }} - {{ optional(optional($healthcare->daira)->wilaya)->name }}  - @lang("Algeria")</span>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M17.256 12.253c-.096-.667-.611-1.187-1.274-1.342c-2.577-.604-3.223-2.088-3.332-3.734C12.193 7.092 11.38 7 10 7s-2.193.092-2.65.177c-.109 1.646-.755 3.13-3.332 3.734c-.663.156-1.178.675-1.274 1.342l-.497 3.442C2.072 16.907 2.962 18 4.2 18h11.6c1.237 0 2.128-1.093 1.953-2.305l-.497-3.442zM10 15.492c-1.395 0-2.526-1.12-2.526-2.5s1.131-2.5 2.526-2.5s2.526 1.12 2.526 2.5s-1.132 2.5-2.526 2.5zM19.95 6c-.024-1.5-3.842-3.999-9.95-4C3.891 2.001.073 4.5.05 6s.021 3.452 2.535 3.127c2.941-.381 2.76-1.408 2.76-2.876C5.345 5.227 7.737 4.98 10 4.98s4.654.247 4.655 1.271c0 1.468-.181 2.495 2.76 2.876C19.928 9.452 19.973 7.5 19.95 6z"/></svg>
                <span>{{ $healthcare->phones }}</span>
            </div>
            <div class="working-hours">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><g><path d="M16.005 23.999a9.003 9.003 0 1 1 0-18.004a9.003 9.003 0 1 1 0 18.004Zm0-5.001c.55 0 1-.44 1-1v-6.002c0-.55-.45-1-1-1s-1 .45-1 1v6.002c0 .55.45 1 1 1Zm1-11.002a1 1 0 1 0-2 0a1 1 0 0 0 2 0Zm-1 15.003a1 1 0 1 0 0-2a1 1 0 0 0 0 2Zm5.952-12.943a1 1 0 1 0-2 0a1 1 0 0 0 2 0ZM11.053 20.948a1 1 0 1 0 0-2a1 1 0 0 0 0 2ZM23.9 14.556a1 1 0 1 0-1.796.881a1 1 0 0 0 1.796-.881ZM9.438 15.894a1 1 0 1 0-.88-1.796a1 1 0 0 0 .88 1.796Zm11.832 3.11a1 1 0 1 0-.647 1.893a1 1 0 0 0 .647-1.893ZM12 10.376a1 1 0 1 0-1.893-.648a1 1 0 0 0 1.893.648Z"/><path d="M15.375 2.015C8.382 2.345 3 8.365 3 15.367V26.88C3 28.6 4.4 30 6.121 30H25.88c1.719 0 3.12-1.4 3.12-3.12V14.996c.01-7.381-6.162-13.332-13.625-12.982Zm.63 23.984C9.928 26 5.001 21.073 5.001 14.997C5 8.921 9.928 3.995 16.005 3.995c6.078 0 11.004 4.926 11.004 11.002C27.01 21.073 22.082 26 16.005 26Z"/></g></svg>
                <span>{{ $healthcare->opening_hours_display }}</span>
            </div>
        </div>

        @if (flash()->message)
            <div class="{{ flash()->class }}">
                {{ flash()->message }}
            </div>
        @endif

        <div class="resume-doctor-profile">
            <div class="resume">
                <div class="bio">
                <div class="bio-title">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 1C5.925 1 1 5.925 1 12s4.925 11 11 11s11-4.925 11-11S18.075 1 12 1Zm-.5 5a1 1 0 1 0 0 2h.5a1 1 0 1 0 0-2h-.5ZM10 10a1 1 0 1 0 0 2h1v3h-1a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-1v-4a1 1 0 0 0-1-1h-2Z" clip-rule="evenodd"/></svg>
                    <span class="bio-title">@lang("Doctor's Bio")</span>
                </div>
                <div class="bio-separator"></div>
                <div class="bio-txt">
                    <span>{{ $healthcare->description }}</span>
                </div>

            </div>
                <div class="resume-tags">
                <div class="resume-title">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 21"><path d="m13.963 1.478l2.483 2.483a2 2 0 0 1 .498 2L15.71 9.99l-7.93 7.93L0 10.142l7.899-7.899l4.056-1.26a2 2 0 0 1 2.008.495zm-3.71 6.19a1.5 1.5 0 1 0 2.121-2.122a1.5 1.5 0 0 0-2.121 2.121zm7.222 1.047c.542.022.935-.07 1.178-.273a1.5 1.5 0 0 0 .185-2.113c-.11-.131-.285-.252-.527-.364a2 2 0 0 0-.538-1.848L16.05 2.395l2.269-.706a2 2 0 0 1 2.008.496l2.483 2.483a2 2 0 0 1 .498 2l-1.235 4.028l-7.93 7.931l-2.795-2.794l5.688-5.688l.439-1.43z"/></svg>
                    <span class="resume-title">@lang("Tags")</span>
                </div>
                <div class="resume-separator"></div>
                <div class="resume-txt">
                    @if(!empty(json_decode($healthcare->tags)) and is_array(json_decode($healthcare->tags)))
                        @foreach(json_decode($healthcare->tags) as $tag)
                            <button>{{ $tag }}</button>
                        @endforeach
                    @endif
                </div>
            </div>
            </div>
            <div class="excellence">
                @if(in_array($healthcare->type,[0 ]))
                    <div class="sub-section">
                        <div class="sub-sec-head">&#x2756; @lang("Estimated exam time by statistics")</div>
                        <div class="sub-sec-contain">
                            <svg style="margin-top:-10px;"  xmlns="http://www.w3.org/2000/svg" viewBox="5 0 70 80"><path fill="#d0d0d0" d="M32 0c-3.3 0-6 2.7-6 6s2.7 6 6 6s6-2.7 6-6s-2.7-6-6-6m0 10.3c-2.4 0-4.3-1.9-4.3-4.3s1.9-4.3 4.3-4.3s4.3 1.9 4.3 4.3s-1.9 4.3-4.3 4.3"/><path fill="#4e5c66" d="M30.5 8.6h3v6.5h-3z"/><path fill="#647a87" d="M34.5 11.6h-5V5.9c0-1.5 5-1.5 5 0v5.7"/><path fill="#4e5c66" d="m10.737 20.686l2.969-2.97l2.97 2.969l-2.968 2.97z"/><path fill="#647a87" d="m15.6 17.6l-5 5l-3.1-3.1c-.6-.6-.6-1.6 0-2.2l2.8-2.8c.6-.6 1.6-.6 2.2 0l3.1 3.1"/><path fill="#4e5c66" d="m47.344 20.705l2.97-2.97l2.97 2.97l-2.97 2.97z"/><g fill="#647a87"><path d="m53.4 22.6l-5-5l3.1-3.1c.6-.6 1.6-.6 2.2 0l2.8 2.8c.6.6.6 1.6 0 2.2l-3.1 3.1"/><circle cx="32" cy="39" r="25"/></g><circle cx="32" cy="39" r="21.7" fill="#d2d3d5"/><circle cx="32" cy="39" r="20" fill="#fff"/><path fill="#ed4c5c" d="M52 39c0 5.5-2.2 10.5-5.8 14.1L32 39V19c11 0 20 9 20 20z"/><g fill="#3e4347"><path d="M43.5 50.4L33.3 38.3l-2 2zM31.3 20.7h1.4v5.6h-1.4zm0 31h1.4v5.6h-1.4zM13.7 38.3h5.6v1.4h-5.6zm31 0h5.6v1.4h-5.6zM22.178 23.463l1.213-.7l1.4 2.425l-1.213.7zm-6.45 7l.7-1.212l2.425 1.4l-.7 1.213zm.033 17.149l2.424-1.402l.7 1.212l-2.423 1.402zm6.491 6.964l1.4-2.425l1.212.7l-1.4 2.425zm16.906-1.85l1.212-.7l1.4 2.425l-1.211.7zM45.1 47.43l.7-1.213l2.425 1.401l-.7 1.213zm-.074-16.802l2.424-1.4l.7 1.212l-2.424 1.4zm-5.89-5.478l1.401-2.424l1.212.7l-1.4 2.425z"/><circle cx="32" cy="39" r="2.8"/></g></svg>
                            <span>
                           <h2 class="d-inline-block" style="margin:0 20px;font-size:35px;">{{ gmdate("i:s", floor(intval($healthcare->average_patient_time * 60))) }} <span style="font-size:16px;">@lang("Minute")</span></h2>
                        </span>
                        </div>
                    </div>
                @endif
                @if(!empty(json_decode($healthcare->diplomas)) and is_array(json_decode($healthcare->diplomas)) and in_array($healthcare->type,[0 ]))
                    <div class="sub-section">
                    <div class="sub-sec-head">&#x2756; @lang("certificates & diplomas")</div>
                    <div class="sub-sec-contain">
                        <ul>
                                @foreach(json_decode($healthcare->diplomas) as $dip)
                                    <li>{{ $dip }}</li>
                                @endforeach
                        </ul>
                    </div>
                </div>
                @endif
                @if($healthcare->services->count() and $healthcare->type != 0 & $healthcare->type != 4)
                    <div class="sub-section">
                        <div class="sub-sec-head">&#x2756; Services</div>
                        <div class="sub-sec-contain">
                            <ul>
                                @foreach($healthcare->services as $service)
                                   <li>{{ $service->title }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                @if(!empty(json_decode($healthcare->experience)) and is_array(json_decode($healthcare->experience)) and in_array($healthcare->type,[0 , 4]))
                    <div class="sub-section">
                    <div class="sub-sec-head">&#x2756; @lang("experience & achievements")</div>
                    <div class="sub-sec-contain">
                        <ul>
                                @foreach(json_decode($healthcare->experience) as $exp)
                                    <li>{{ $exp }}</li>
                                @endforeach
                        </ul>
                    </div>
                </div>
                @endif
                @if(!empty(json_decode($healthcare->languages)) and is_array(json_decode($healthcare->languages)) and in_array($healthcare->type,[0 , 4]))
                    <div class="sub-section">
                    <div class="sub-sec-head">&#x2756; @lang("treated diseases")</div>
                    <div class="sub-sec-contain">
                        <ul>
                                @foreach(json_decode($healthcare->languages) as $lan)
                                    <li>{{ $lan }}</li>
                                @endforeach
                        </ul>
                    </div>
                </div>
                @endif
                @if(!empty(json_decode($healthcare->equipment)) and is_array(json_decode($healthcare->equipment)))
                    <div class="sub-section">
                        <div class="sub-sec-head">&#x2756;  @lang("specialized medical equipment")</div>
                        <div class="sub-sec-contain">
                            <ul>
                                @foreach(json_decode($healthcare->equipment) as $eqp)
                                    <li>{{ $eqp }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div> 
            <!--
            <div class="right-div-hider-scroll-effect"></div>
            -->
        </div>

        <div class="profile-location" id="location">
            <a href="google.navigation:q={{ $healthcare->maps }}" class="map" style="text-decoration: none;">
                <div class="map-title">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="M9.156 14.544C10.899 13.01 14 9.876 14 7A6 6 0 0 0 2 7c0 2.876 3.1 6.01 4.844 7.544a1.736 1.736 0 0 0 2.312 0ZM6 7a2 2 0 1 1 4 0a2 2 0 0 1-4 0Z"/></svg>
                    <span class="map-title">@lang("Location")</span>
                </div>
                <div class="map-separator"></div>
                <div class="map-iframe" id="map" style="width: 100%;"></div>
            </a>
            <div class="near-laboratory" style="height:fit-content">
                <div class="map-title map-title-near-lab">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18.75 3.94L4.07 10.08c-.83.35-.81 1.53.02 1.85L9.43 14a1 1 0 0 1 .57.57l2.06 5.33c.32.84 1.51.86 1.86.03l6.15-14.67c.33-.83-.5-1.66-1.32-1.32z"/></svg>
                    <span class="map-title">@lang("Doctors nearby") </span>
                </div>
                <div class="map-labo-near-separator"></div>
                <!--------fdgdg ------->
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        @if(!empty(json_decode($healthcare->healthcares)))
                            @foreach(json_decode($healthcare->healthcares) as $id)
                                @php
                                $entity = \App\Models\HealthcareEntity::find($id)
                                @endphp
                                <div class="swiper-slide">
                                    <!--
                                    <div style="background-image: url({{ $entity->getFirstMediaUrl('background') }});width: 100%;background-size: 100% 100%;background-repeat: no-repeat;">
                                    <a href="{{ route('front.get_healthcare_entity_page' , $entity->slug) }}" style="text-decoration: unset;color: #efefef;">
                                        <h2 style="background: #010c16c7;padding: 15px;">
                                            {{ $entity->fname .' '. $entity->lname }}
                                        </h2>
                                    </a>
                                </div>
                                -->
                                
                                <a href="{{ route('front.get_healthcare_entity_page' , $entity->slug) }}" style="text-decoration: unset;" class="card-near-account">
                                  <div class="photo-account">
                                    <img src="{{ $entity->getFirstMediaUrl('thumbnail' , 'sized') }}" alt="">
                                  </div>
                                  
                                  <div class="account-name">
                                    Dr. {{ $entity->lname .' '. $entity->fname }}
                                  </div>
                                  
                                  <div class="account-opening-etat">
                                    @if($entity->is_open_now == 'open')
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="currentColor" d="M1.998 21v-2h2V4.835a1 1 0 0 1 .821-.984l9.472-1.722a.6.6 0 0 1 .707.59V4h4a1 1 0 0 1 1 1v14h2v2h-4V6h-3v15h-13Zm10-10h-2v2h2v-2Z"></path>
                                        </svg>
                                        <span>@lang("Open")</span>
                                    @elseif($entity->is_open_now == 'unknown')
                                        <span class="badge bg-info">@lang("Unkonw situation")</span>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="#ff3856" d="M2.998 21v-2h2V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v15h2v2h-18Zm12-10h-2v2h2v-2Z"></path>
                                        </svg>
                                        <span style="color:red">@lang("Closed")</span>
                                    @endif
                                  </div>
                                  
                                  <div class="account-specialist">
                                    {!! $entity->services->first()->icon !!}  
                                  </div>
                                  <div class="card-bookmark">
                                  </div>
                                </a>

                                </div>
                            @endforeach
                        @else
                             <div class="alert alert-warning alert-dismissible" style="width:auto; padding: 20px;margin:60px auto;">@lang("No Accounts Selected")</div>
                        @endif

                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>



      @if($healthcare->type != 4 and \Illuminate\Support\Facades\Auth::guard('patient')->user())
          <div class="modal"  tabindex="-1" id="appointment-modal">
              <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title">@lang("Getting an appointment")</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="{{ route('book_appointment' , $healthcare->slug) }}" method="post">
                          @csrf
                          <div class="modal-body">
                              <div class="row">
                                  <div class="col-lg-6 col-md-12">
                                      <label for="">@lang("Name")</label>
                                      <input class="form-control" type="text" name="name">
                                  </div>
                                  <div class="col-lg-6 col-md-12">
                                      <label for="">@lang("Phone")</label>
                                      <input class="form-control" type="tel" name="phone">
                                  </div>
                                  <div class="col-lg-6 col-md-12">
                                      <label for="">@lang("Service")</label>
                                      <select class="form-control" name="service_id" id="" required>
                                          <option value="" selected disabled>@lang("Select service")</option>
                                          @if($healthcare->services->count())
                                              @foreach($healthcare->services as $service)
                                                  <option value="{{ $service->id }}">{{ $service->title }}</option>
                                              @endforeach
                                          @endif
                                      </select>
                                  </div>
                                  <div class="col-lg-6 col-md-12">
                                      <label for="">@lang("Date of the appointment")</label>
                                      <input class="form-control" type="date" name="date" min="{{ now()->format('Y-m-d') }}">
                                  </div>
                              </div>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang("Cancel")</button>
                              <button type="submit" class="btn btn-primary radius-0">@lang("Get an Appointment")</button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      @elseif($healthcare->type == 4 and \Illuminate\Support\Facades\Auth::guard('patient')->user())
         <!-- <div class="modal" tabindex="-1" id="medication-modal">
              <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title">@lang("Ask For Medication")</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="{{ route('ask_medication_healthcare' , $healthcare->slug) }}" method="post" enctype="multipart/form-data">
                          @csrf
                          <div class="modal-body">
                              <div class="row">
                                  <div class="col-12 row">
                                      <label for="">@lang("What medication are you looking for")</label>
                                      <div class="col mb-1 p-2 text-center">
                                          <div class="btn btn-outline-dark">
                                              <label for="1">@lang("Medication") 1</label>
                                              <input id="1" name="medication[]" value="1" type="checkbox">
                                          </div>
                                      </div>
                                      <div class="col mb-1 p-2 text-center">
                                          <div class="btn btn-outline-dark">
                                              <label for="2">@lang("Medication") 2</label>
                                              <input id="2" name="medication[]" value="2" type="checkbox">
                                          </div>
                                      </div>
                                      <div class="col mb-1 p-2 text-center">
                                          <div class="btn btn-outline-dark">
                                              <label for="3">@lang("Medication") 3</label>
                                              <input id="3" name="medication[]" value="3" type="checkbox">
                                          </div>
                                      </div>
                                      <div class="col mb-1 p-2 text-center">
                                          <div class="btn btn-outline-dark">
                                              <label for="4">@lang("Medication") 4</label>
                                              <input id="4" name="medication[]" value="4" type="checkbox">
                                          </div>
                                      </div>
                                      <div class="col mb-1 p-2 text-center">
                                          <div class="btn btn-outline-dark">
                                              <label  for="5">@lang("Medication") 5</label>
                                              <input id="5" name="medication[]" value="5" type="checkbox">
                                          </div>
                                      </div>
                                      <div class="col mb-1 p-2 text-center">
                                          <div class="btn btn-outline-dark">
                                              <label for="6">@lang("Medication") 6</label>
                                              <input id="6" name="medication[]" value="6" type="checkbox">
                                          </div>
                                      </div>
                                      <div class="col mb-1 p-2 text-center">
                                          <div class="btn btn-outline-dark">
                                              <label for="7">@lang("Medication") 7</label>
                                              <input id="7" name="medication[]" value="7" type="checkbox">
                                          </div>
                                      </div>
                                      <div class="col mb-1 p-2 text-center">
                                          <div class="btn btn-outline-dark">
                                              <label  for="8">@lang("Medication") 8</label>
                                              <input  id="8" name="medication[]" value="8" type="checkbox">
                                          </div>
                                      </div>
                                      <div class="col mb-1 p-2 text-center">
                                          <div class="btn btn-outline-dark">
                                              <label for="9">@lang("Medication") 9 </label>
                                              <input id="9" name="medication[]" value="9" type="checkbox">
                                          </div>
                                      </div>
                                      <div class="col mb-1 p-2 text-center">
                                          <div class="btn btn-outline-dark">
                                              <label for="10">@lang("Medication") 10</label>
                                              <input id="10" name="medication[]" value="10" type="checkbox">
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-lg-12 col-md-12 mt-4">
                                      <label class="mb-2" for="">@lang("If your order is available, what is the estimated time for you to attend the clinic to purchase the medicine?")</label>
                                      <select class="form-control" name="collecting_time" id="">
                                          <option value="Less than hour">@lang("Less than hour")</option>
                                          <option value="Within this day">@lang("Within this day")</option>
                                          <option value="Reserve these medications for me for tomorrow at the latest">@lang("Reserve these medications for me for tomorrow at the latest")</option>
                                      </select>
                                  </div>

                                  <div class="col-lg-12 col-md-12 mt-4">
                                      <label for="">@lang("Payment method")</label>
                                      <br>

                                      @if(!empty(json_decode($healthcare->payments)) and is_array(json_decode($healthcare->payments)))
                                          @php
                                              $selected_payments = json_decode($healthcare->payments);
                                          @endphp
                                      @else
                                          @php
                                              $selected_payments = [];
                                          @endphp
                                      @endif

                                        <div class="row">
                                            @if(in_array('cash' , $selected_payments))
                                                <div class="col text-center">
                                                    <div class="btn h-100 btn-outline-dark text-center">
                                                        <img style="width: 100%;height:40px;display: block" src="{{ asset('theme/img/cash.jpg') }}" alt="">
                                                        <label for="cash">@lang("espèce")</label>
                                                        <input id="cash" type="checkbox" name="payments[]" multiple value="cash">
                                                    </div>
                                                </div>
                                            @endif
                                            @if(in_array('chifa' , $selected_payments))
                                                <div class="col text-center">
                                                    <div class="btn h-100 btn-outline-dark text-center">
                                                        <img style="width: 100%;height:40px;display: block" src="{{ asset('theme/img/Carte_chifa.jpg') }}" alt="">
                                                        <label for="chifa">@lang("Carte Chifa")</label>
                                                        <input id="chifa" type="checkbox" name="payments[]" multiple value="chifa">
                                                        <br>
                                                    </div>
                                                </div>
                                            @endif
                                            @if(in_array('dahabia' , $selected_payments))
                                                <div class="col text-center">
                                                    <div class="btn h-100 btn-outline-dark text-center">
                                                        <img style="width: 100%;height:40px;display: block" src="{{ asset('theme/img/edahabia.png') }}" alt="">
                                                        <label for="dahabia">@lang("E-lDahabia")</label>
                                                        <input id="dahabia" type="checkbox" name="payments[]" multiple  value="dahabia">
                                                        <br>
                                                    </div>
                                                </div>
                                            @endif
                                            @if(in_array('assurance-militaire' , $selected_payments))
                                                <div class="col text-center">
                                                    <div class="btn h-100 btn-outline-dark text-center">
                                                        <img style="width: 100%;height:40px;display: block" src="{{ asset('theme/img/A.N.P.png') }}" alt="">
                                                        <label for="assurance-militaire">@lang('assurance-militaire')</label>
                                                        <input id="assurance-militaire" type="checkbox" name="payments[]" multiple value="assurance-militaire">
                                                        <br>
                                                    </div>
                                                </div>
                                            @endif
                                            @if(in_array('cib' , $selected_payments))
                                                <div class="col text-center">
                                                    <div class="btn h-100 btn-outline-dark text-center">
                                                        <img style="width: 100%;height:40px;display: block" src="{{ asset('theme/img/CIB.png') }}" alt="">
                                                        <label for="cib">@lang('cib')</label>
                                                        <input id="cib" type="checkbox" name="payments[]" multiple value="cib">
                                                        <br>
                                                    </div>
                                                </div>
                                            @endif
                                            @if(in_array('baridimob' , $selected_payments))
                                                <div class="col text-center">
                                                    <div class="btn h-100 btn-outline-dark text-center">
                                                        <img style="width: 100%;height:40px;display: block" src="{{ asset('theme/img/Picsart_24-03-04_19-57-38-871.png') }}" alt="">
                                                        <label for="baridimob">@lang('Baridimob')</label>
                                                        <input id="baridimob" type="checkbox" name="payments[]" multiple value="baridimob">
                                                        <br>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                  </div>

                                  <div class="col-lg-6 col-md-12 mt-4">
                                      <label for="">@lang("Ordonnance")</label>
                                      <input type="file" name="gallery" accept="image/jpeg">
                                  </div>
                              </div>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang("Cancel")</button>
                              <button type="submit" class="btn btn-primary radius-0">@lang("Ask For medication")</button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>-->
          <div class="appointtement-list">
                <div class="laboratory-apptmt-list-background" onclick="closeAppointtementList()"></div>
                <div class="Table" style="height: auto;">
                    <button class="cls-appoint-tbl">
                        <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" viewBox="0 0 256 256"><path d="M208 34H48a14 14 0 0 0-14 14v160a14 14 0 0 0 14 14h160a14 14 0 0 0 14-14V48a14 14 0 0 0-14-14Zm2 174a2 2 0 0 1-2 2H48a2 2 0 0 1-2-2V48a2 2 0 0 1 2-2h160a2 2 0 0 1 2 2Zm-45.76-107.76L136.48 128l27.76 27.76a6 6 0 1 1-8.48 8.48L128 136.48l-27.76 27.76a6 6 0 0 1-8.48-8.48L119.52 128l-27.76-27.76a6 6 0 0 1 8.48-8.48L128 119.52l27.76-27.76a6 6 0 0 1 8.48 8.48Z"/></svg>
                    </button>

                    <div class="table-header">
                        <div class="tbl-ttl">
                            <span>@lang("Ask For Medication")</span>
                        </div>
                        
                    </div>
                    <div class="form-inscription">
                        <form action="{{ route('ask_medication_healthcare' , $healthcare->slug) }}" method="post" enctype="multipart/form-data">
                          @csrf
                          <div class="input-ordonnance">
                                  <label class="comnt" for="">@lang("Take a photo of the Ordonnance")</label>
                                  <input type="file" name="gallery" accept="image/jpeg">
                              </div>
                              
                          <div class="select-number">
                                  
                                  <label class="comnt" for="">@lang("What medication are you looking for")</label>
                                  <div class="number-container">
                                      <div class="number-box" id="numberBox_11"  style="width:78px;" onclick="toggleNumber(11)">
                                          <label for="All">All</label>
                                          <input id="All" name="medication[]" value="All" type="checkbox">
                                      </div>
                                      <div class="number-box" id="numberBox_1" onclick="toggleNumber(1)">
                                          <label for="1">1</label>
                                          <input id="1" name="medication[]" value="1" type="checkbox">
                                      </div>
                                      <div class="number-box" id="numberBox_2" onclick="toggleNumber(2)">
                                          <label for="2">2</label>
                                          <input id="2" name="medication[]" value="2" type="checkbox">
                                      </div>
                                      <div class="number-box" id="numberBox_3" onclick="toggleNumber(3)">
                                          <label for="3">3</label>
                                          <input id="3" name="medication[]" value="3" type="checkbox">
                                      </div>
                                      <div class="number-box" id="numberBox_4" onclick="toggleNumber(4)">
                                          <label for="4">4</label>
                                          <input id="4" name="medication[]" value="4" type="checkbox">
                                      </div>
                                      <div class="number-box" id="numberBox_5" onclick="toggleNumber(5)">
                                          <label  for="5">5</label>
                                          <input id="5" name="medication[]" value="5" type="checkbox">
                                      </div>
                                      <div class="number-box" id="numberBox_6" onclick="toggleNumber(6)">
                                          <label for="6">6</label>
                                          <input id="6" name="medication[]" value="6" type="checkbox">
                                      </div>
                                      <div class="number-box" id="numberBox_7" onclick="toggleNumber(7)">
                                          <label for="7">7</label>
                                          <input id="7" name="medication[]" value="7" type="checkbox">
                                      </div>
                                      <div class="number-box" id="numberBox_8" onclick="toggleNumber(8)">
                                          <label  for="8">8</label>
                                          <input  id="8" name="medication[]" value="8" type="checkbox">
                                      </div>
                                      <div class="number-box" id="numberBox_9" onclick="toggleNumber(9)">
                                          <label for="9">9</label>
                                          <input id="9" name="medication[]" value="9" type="checkbox">
                                      </div>
                                      <div class="number-box" id="numberBox_10" onclick="toggleNumber(10)">
                                          <label for="10">10</label>
                                          <input id="10" name="medication[]" value="10" type="checkbox">
                                      </div>
                                  </div>
                              </div>
                              
                          <div class="select-region">
                              <label class="comnt region-label" for="">@lang("If your order is available, what is the estimated time for you to attend the clinic to purchase the medicine?")</label>
                              <select class="select-time" name="collecting_time" id="" required>
                                  <option value="Less than hour">@lang("Less than hour")</option>
                                  <option value="Within this day">@lang("Within this day")</option>
                                  <option value="Reserve these medications for me for tomorrow at the latest">@lang("Reserve these medications for me for tomorrow at the latest")</option>
                              </select>
                          </div>

                          <div class="select-payment">
                                  <label class="comnt" for="">@lang("Payment method")</label>
                                  <br>

                                  @if(!empty(json_decode($healthcare->payments)) and is_array(json_decode($healthcare->payments)))
                                      @php
                                          $selected_payments = json_decode($healthcare->payments);
                                      @endphp
                                  @else
                                      @php
                                          $selected_payments = [];
                                      @endphp
                                  @endif

                                    <div class="payments">
                                        @if(in_array('cash' , $selected_payments))
                                                <div class="number-box" id="numberBox_12" onclick="toggleNumber(12)">
                                                    
                                                    <label for="cash">
                                                        <img style="height:18px" src="{{ asset('theme/img/cash.jpg') }}" alt="">
                                                        @lang("Cash")
                                                    </label>
                                                    <input id="cash" type="checkbox" name="payments[]" multiple value="cash">
                                                </div>
                                        @endif
                                        @if(in_array('assurance-militaire' , $selected_payments))
                                                <div class="number-box" id="numberBox_15" onclick="toggleNumber(15)">
                                                    
                                                    <label for="assurance-militaire">
                                                        <img style="height:25px" src="{{ asset('theme/img/A.N.P.png') }}" alt="">
                                                        @lang('Military Fond')
                                                    </label>
                                                    <input id="assurance-militaire" type="checkbox" name="payments[]" multiple value="assurance-militaire">
                                                    <br>
                                                </div>
                                        @endif
                                        @if(in_array('dahabia' , $selected_payments))
                                                <div class="number-box" id="numberBox_14" onclick="toggleNumber(14)">
                                                    
                                                    <label for="dahabia">
                                                        <img style="height:19px" src="{{ asset('theme/img/edahabia.png') }}" alt="">
                                                        @lang("Dahabia")
                                                    </label>
                                                    <input id="dahabia" type="checkbox" name="payments[]" multiple  value="dahabia">
                                                    <br>
                                                </div>
                                        @endif
                                        @if(in_array('chifa' , $selected_payments))
                                                <div class="number-box" id="numberBox_13" onclick="toggleNumber(13)">
                                                    
                                                    <label for="chifa">
                                                        <img style="height:19px" src="{{ asset('theme/img/Carte_chifa.jpg') }}" alt="">
                                                        @lang("Chifa Card")
                                                    </label>
                                                    <input id="chifa" type="checkbox" name="payments[]" multiple value="chifa">
                                                    <br>
                                                </div>
                                        @endif
                                        @if(in_array('cib' , $selected_payments))
                                                <div class="number-box" id="16" onclick="toggleNumber(16)">
                                                    
                                                    <label for="cib">
                                                        <img style="width:29px" src="{{ asset('theme/img/CIB.png') }}" alt="">
                                                        @lang('CIB Cards')
                                                    </label>
                                                    <input id="cib" type="checkbox" name="payments[]" multiple value="cib">
                                                    <br>
                                                </div>
                                        @endif
                                        @if(in_array('baridimob' , $selected_payments))
                                                <div class="number-box" id="numberBox_17" onclick="toggleNumber(17)">
                                                    
                                                    <label for="baridimob">
                                                        <img style="width:24px" src="{{ asset('theme/img/Picsart_24-03-04_19-57-38-871.png') }}" alt="">
                                                        @lang('BaridiMob')
                                                    </label>
                                                    <input id="baridimob" type="checkbox" name="payments[]" multiple value="baridimob">
                                                    <br>
                                                </div>
                                        @endif
                                    </div>
                              </div>
                              
                          <div class="modal-footer" style="height:40px; margin-bottom:20px;padding:0;">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang("Cancel")</button>
                              <button style="margin:0 20px;" type="submit" class="btn btn-primary radius-0">@lang("Send")</button>
                          </div>
                        </form>
                      
                    </div>
                </div>
            </div>
          
      @endif

@endsection

@push('after-styles')
    <link rel="stylesheet" href="{{ asset('theme/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/doctor-profile-style.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    @if($healthcare->is_open_now  == 'open')
        <style>
            .doctor-principals-info .right .right-ttl::before, .doctor-principals-info .right .right-ttl::after
            {
                background-color:green
            }
        </style>
    @endif

@endpush
@push('before-scripts')
    <script src="{{ asset('theme/js/swiper-bundle.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });

        var background_swiper = new Swiper(".background-swiper", {
            slidesPerView: 1,
            loop: true,
        });

        @php
            $pattern = '/^[-+]?([1-8]?\d(\.\d+)?|90(\.0+)?),\s*[-+]?(180(\.0+)?|((1[0-7]\d)|([1-9]?\d))(\.\d+)?)$/';
        @endphp

        var coordinates = [{{ preg_match($pattern, $healthcare->maps) === 1  ? $healthcare->maps  : "" }}];

        var map = L.map('map').setView(coordinates, 10);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Add a marker for the coordinates
        L.marker(coordinates).addTo(map)
            .bindPopup("{{ $healthcare->name }}")
            .openPopup();

    </script>
    


@endpush

@push('after-styles')
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

        .btn-outline-dark:has( input[type=checkbox]:checked)
        {
            background: #212529;
            color: #fff;
        }
    </style>
@endpush

@push('after-scripts')
    <script src="{{ asset('patient/assets/plugins/select2/js/select2.min.js') }}"></script>
    <script>
    $(document).ready(function() {
    $('.select2bs4').select2({
        multiple: true,
        placeholder: "Select ...",
    });

    var iframe = document.getElementById('newposterIframe');
    iframe.onload = function() {
        iframe.contentWindow.document.body.style.zoom = '25%';
    };
});

    </script>

<script>
// تعريف الدالة لتغيير خلفية العنصر ولون النص
function toggleBackgroundAndColor(element) {
    // التحقق من اللون الحالي للخلفية
    var currentBackgroundColor = element.parentElement.style.backgroundColor;

    // التبديل بين الألوان
    if (currentBackgroundColor !== 'rgb(62, 67, 148)') {
        element.parentElement.style.backgroundColor = '#3e4394';
        element.style.color = '#ffffff';
    } else {
        element.parentElement.style.backgroundColor = '';
        element.style.color = '#3e4394';
    }
}

// التعريف لتنفيذ الدالة عند النقر
document.addEventListener('DOMContentLoaded', function() {
    var numberLabels = document.querySelectorAll('.number-box label');
    var paymentLabels = document.querySelectorAll('.select-payment .payments div label');

    numberLabels.forEach(function(label) {
        label.addEventListener('click', function() {
            toggleBackgroundAndColor(label);
        });
    });

    paymentLabels.forEach(function(label) {
        label.addEventListener('click', function() {
            toggleBackgroundAndColor(label);
        });
    });
});


</script>
<script>
// تعريف الدالة لتغيير لون خلفية قسم طريق الدفع ولون النص
function togglePaymentBackgroundAndTextColor(element) {
    var paymentSection = element.parentElement;
    var label = element;

    // التبديل بين الألوان
    if (paymentSection.style.backgroundColor !== 'rgb(62, 67, 148)') {
        paymentSection.style.backgroundColor = '#3e4394';
        label.style.color = '#ffffff';
    } else {
        paymentSection.style.backgroundColor = '';
        label.style.color = '#3e4394';
    }
}

// التعريف لتنفيذ الدالة عند النقر على label
document.addEventListener('DOMContentLoaded', function() {
    var paymentLabels = document.querySelectorAll('.select-payment .payments div label');

    paymentLabels.forEach(function(label) {
        label.addEventListener('click', function() {
            togglePaymentBackgroundAndTextColor(label);
        });
    });
});
</script>

@endpush
