@extends('front.layout')


@section('header')

@endsection


@section('content')
    <div class="hero">
        <div class="top-fixed-menu">
            <form action="{{ url()->current() }}">
            <div class="top-fixed-menu-container">
                <button class="tp-fxd-buttons tp-fxd-email-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -1 20 21"><path fill-rule="evenodd" d="m7.172 11.334l2.83 1.935l2.728-1.882l6.115 6.033c-.161.052-.333.08-.512.08H1.667c-.22 0-.43-.043-.623-.12l6.128-6.046ZM20 6.376v9.457c0 .247-.054.481-.15.692l-5.994-5.914L20 6.376ZM0 6.429l6.042 4.132l-5.936 5.858A1.663 1.663 0 0 1 0 15.833V6.43ZM18.333 2.5c.92 0 1.667.746 1.667 1.667v.586L9.998 11.648L0 4.81v-.643C0 3.247.746 2.5 1.667 2.5h16.666Z"/></svg>
                </button>
                <input type="search" class="tp-fxd-buttons tp-fxd-search-btn" name="q" value="{{ request()->get("q") }}">
                <button class="tp-fxd-buttons tp-fxd-notificatio-btn" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M456.69 421.39L362.6 327.3a173.81 173.81 0 0 0 34.84-104.58C397.44 126.38 319.06 48 222.72 48S48 126.38 48 222.72s78.38 174.72 174.72 174.72A173.81 173.81 0 0 0 327.3 362.6l94.09 94.09a25 25 0 0 0 35.3-35.3ZM97.92 222.72a124.8 124.8 0 1 1 124.8 124.8a124.95 124.95 0 0 1-124.8-124.8Z"></path></svg>
                </button>
                <button class="tp-fxd-buttons tp-fxd-saved-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19 19H5V8h14m-3-7v2H8V1H6v2H5c-1.11 0-2 .89-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2h-1V1m-1 11h-5v5h5v-5Z"/></svg>
                </button>
                <button class="tp-fxd-buttons tp-fxd-filtre-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M13.875 22h-3.75q-.375 0-.65-.25t-.325-.625l-.3-2.325q-.325-.125-.613-.3t-.562-.375l-2.175.9q-.35.125-.7.025t-.55-.425L2.4 15.4q-.2-.325-.125-.7t.375-.6l1.875-1.425Q4.5 12.5 4.5 12.337v-.674q0-.163.025-.338L2.65 9.9q-.3-.225-.375-.6t.125-.7l1.85-3.225q.175-.35.537-.438t.713.038l2.175.9q.275-.2.575-.375t.6-.3l.3-2.325q.05-.375.325-.625t.65-.25h3.75q.375 0 .65.25t.325.625l.3 2.325q.325.125.613.3t.562.375l2.175-.9q.35-.125.7-.025t.55.425L21.6 8.6q.2.325.125.7t-.375.6l-1.875 1.425q.025.175.025.338v.674q0 .163-.05.338l1.875 1.425q.3.225.375.6t-.125.7l-1.85 3.2q-.2.325-.563.438t-.712-.013l-2.125-.9q-.275.2-.575.375t-.6.3l-.3 2.325q-.05.375-.325.625t-.65.25Zm-1.825-6.5q1.45 0 2.475-1.025T15.55 12q0-1.45-1.025-2.475T12.05 8.5q-1.475 0-2.488 1.025T8.55 12q0 1.45 1.012 2.475T12.05 15.5Z"/></svg>
                </button>
            </div>
            </form>
        </div>
        <div class="left-fixed-menu">
            @if(\Illuminate\Support\Facades\Auth::guard('patient')->user())
                <div class="profile">
                    <div class="top">
                        <div class="background"></div>
                        <div class="photo-profile">
                            <img src="{{ \Illuminate\Support\Facades\Auth::guard('patient')->user()->getFirstMediaUrl('avatar' , 'sized') }}" alt="">
                        </div>
                        <div class="user-name">{{ \Illuminate\Support\Facades\Auth::guard('patient')->user()->fname . ' ' .\Illuminate\Support\Facades\Auth::guard('patient')->user()->lname }}</div>
                    </div>
                    <div class="bottom">
                        <div class="dv email">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="-1 -1 21 21"><path fill-rule="evenodd" d="m7.172 11.334l2.83 1.935l2.728-1.882l6.115 6.033c-.161.052-.333.08-.512.08H1.667c-.22 0-.43-.043-.623-.12l6.128-6.046ZM20 6.376v9.457c0 .247-.054.481-.15.692l-5.994-5.914L20 6.376ZM0 6.429l6.042 4.132l-5.936 5.858A1.663 1.663 0 0 1 0 15.833V6.43ZM18.333 2.5c.92 0 1.667.746 1.667 1.667v.586L9.998 11.648L0 4.81v-.643C0 3.247.746 2.5 1.667 2.5h16.666Z"/></svg>
                        </div>
                        <div class="dv notification">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="1 1 21 21"><path d="M12 22c1.1 0 2-.9 2-2h-4a2 2 0 0 0 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-1.29 1.29c-.63.63-.19 1.71.7 1.71h13.17c.89 0 1.34-1.08.71-1.71L18 16z"/></svg>
                        </div>
                    </div>
                </div>
            @endif
            <div class="saved-announce">
                <div class="header-sv-annc">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19 19H5V8h14m-3-7v2H8V1H6v2H5c-1.11 0-2 .89-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2h-1V1m-1 11h-5v5h5v-5Z"/></svg>
                    <span>nearby events</span>
                </div>
                <div class="container-sv-annc">
                    @if($campaigns->count())
                        @foreach($campaigns as $campaign)
                            <div class="card">
                                <div class="card-body">
                                    {{ $campaign->started_at }}
                                    <h6>{{ optional($campaign->user)->fname . ' | '. optional($campaign->user)->lname }}</h6>
                                    <span class="badge bg-secondary">{{ optional($campaign->wilaya_rel)->name . ' | ' . optional($campaign->daira_rel)->name  }}</span>
                                    <a href="{{  route('patient.like_article' ,['like' , $campaign->id]) }}"  @if(in_array(\Illuminate\Support\Facades\Auth::guard('patient')->id() , $campaign->likes->pluck('user_id')->toArray())) style="fill: red" @endif>
                                        <svg style="max-height: 30px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="m8 14.25l.345.666a.75.75 0 0 1-.69 0l-.008-.004l-.018-.01a7.152 7.152 0 0 1-.31-.17a22.055 22.055 0 0 1-3.434-2.414C2.045 10.731 0 8.35 0 5.5C0 2.836 2.086 1 4.25 1C5.797 1 7.153 1.802 8 3.02C8.847 1.802 10.203 1 11.75 1C13.914 1 16 2.836 16 5.5c0 2.85-2.045 5.231-3.885 6.818a22.066 22.066 0 0 1-3.744 2.584l-.018.01l-.006.003h-.002ZM4.25 2.5c-1.336 0-2.75 1.164-2.75 3c0 2.15 1.58 4.144 3.365 5.682A20.58 20.58 0 0 0 8 13.393a20.58 20.58 0 0 0 3.135-2.211C12.92 9.644 14.5 7.65 14.5 5.5c0-1.836-1.414-3-2.75-3c-1.373 0-2.609.986-3.029 2.456a.749.749 0 0 1-1.442 0C6.859 3.486 5.623 2.5 4.25 2.5Z"/></svg>
                                    </a>
                                    <a href="{{ route('patient.get_my_chat_page' , ['type' => 'patient' , 'current' => $campaign->author_id]) }}">
                                        <svg style="max-height: 30px" xmlns="http://www.w3.org/2000/svg" viewBox="2 2 22 22"><path d="m14.777 14.038l2.65-3.92c.262-.386-.235-.805-.615-.529l-2.858 2.015a.571.571 0 0 1-.652 0l-2.116-1.477c-.633-.437-1.538-.277-1.963.335l-2.65 3.92c-.262.386.235.806.615.529l2.858-2.015a.571.571 0 0 1 .652 0l2.116 1.452c.633.462 1.538.302 1.963-.31Z"/><path fill="currentColor" fill-rule="evenodd" d="M12 2.25A9.75 9.75 0 0 0 2.25 12a9.724 9.724 0 0 0 3 7.036V21.5a.75.75 0 0 0 .987.712l2.78-.927A9.745 9.745 0 0 0 12 21.75c5.385 0 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM3.75 12a8.25 8.25 0 1 1 5.516 7.787a.75.75 0 0 0-.486-.004l-2.03.676v-1.75a.75.75 0 0 0-.25-.56A8.228 8.228 0 0 1 3.75 12Z" clip-rule="evenodd"/></svg>
                                    </a>
                                    <a  href="{{  route('patient.like_article' ,['favorite' , $campaign->id]) }}"  @if(in_array(\Illuminate\Support\Facades\Auth::guard('patient')->id() , $campaign->favorites->pluck('user_id')->toArray())) style="fill: red" @endif>
                                        <svg style="max-height: 30px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M16 2H8a3 3 0 0 0-3 3v16a1 1 0 0 0 .5.87a1 1 0 0 0 1 0l5.5-3.18l5.5 3.18a1 1 0 0 0 .5.13a1 1 0 0 0 .5-.13A1 1 0 0 0 19 21V5a3 3 0 0 0-3-3Zm1 17.27l-4.5-2.6a1 1 0 0 0-1 0L7 19.27V5a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1Z"/></svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="timeline">
            @if(flash()->message)
                <div class="{{ flash()->class }}">
                    {{ flash()->message }}
                </div>
            @endif
            @if(\Illuminate\Support\Facades\Auth::guard("patient")->user())
                <form method="post" action="{{ route('patient.post_blood_article') }}">
                    @csrf
                <div class="post-announce">
                    <div class="top">
                        <div class="user-photo">
                            <img src="{{ asset('theme/img/1566153191366.jpg') }}" alt="">
                        </div>
                        <div class="announce-typing">
                            <textarea name="content" id="" cols="30" rows="10" placeholder="describe your needs" required></textarea>
                        </div>
                    </div>
                    <div class="bottom row">
                        <div class="attachments col-sm-12 mb-2 col-md-6 w-sm-100 h-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><g fill="#0f0092"><path d="M20.388 5.535a5.018 5.018 0 0 1 7.224 0l.528.548h5.19c2.573 0 4.67 2.074 4.67 4.646V15.5h-2v-4.771a2.658 2.658 0 0 0-2.67-2.646h-5.616a1 1 0 0 1-.72-.307l-.823-.855a3.018 3.018 0 0 0-4.342 0l-.823.855a1 1 0 0 1-.72.307H15c-1.663 0-3 1.338-3 2.974V28.97a68.776 68.776 0 0 1 3.7.06l.53.02c1.284.048 2.481.093 3.652.069c2.627-.056 5.042-.466 7.61-1.981c3.118-1.84 5.758-1.288 7.583-.226c.338.197.647.41.925.626V22.5h2v10.526C38 35.78 35.755 38 33 38h-3v2h-5v4h-2v-4h-5v-2h-3c-2.755 0-5-2.22-5-4.974v-21.97c0-2.752 2.245-4.973 5-4.973h4.86l.528-.548Z"/><path d="M26 15a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-3h3v3a1 1 0 1 0 2 0v-8a1 1 0 1 0-2 0v3h-3v-3Z"/><path fill-rule="evenodd" d="M15 15a1 1 0 0 1 1-1h3.125C20.773 14 22 15.405 22 17c0 1.096-.58 2.103-1.477 2.625l1.383 2.95a1 1 0 0 1-1.811.85L18.488 20H17v3a1 1 0 1 1-2 0v-8Zm5 2c0-.614-.452-1-.875-1H17v2h2.125c.423 0 .875-.386.875-1Z" clip-rule="evenodd"/><path d="M33 18a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-4Z"/></g></svg>
                            <select name="blood_group" id=""  class="form-control">
                                <option value="" selected >@lang('All')</option>
                                @foreach(\App\Models\Patient::bloud_group as $group)
                                    <option value="{{ $group }}">{{ $group }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="attachments col-sm-12 mb-2 col-md-6 w-sm-100 h-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -40 256 440"><path fill="#34A853" d="M70.585 271.865a370.712 370.712 0 0 1 28.911 42.642c7.374 13.982 10.448 23.463 15.837 40.31c3.305 9.308 6.292 12.086 12.714 12.086c6.998 0 10.173-4.726 12.626-12.035c5.094-15.91 9.091-28.052 15.397-39.525c12.374-22.15 27.75-41.833 42.858-60.75c4.09-5.354 30.534-36.545 42.439-61.156c0 0 14.632-27.035 14.632-64.792c0-35.318-14.43-59.813-14.43-59.813l-41.545 11.126l-25.23 66.451l-6.242 9.163l-1.248 1.66l-1.66 2.078l-2.914 3.319l-4.164 4.163l-22.467 18.304l-56.17 32.432l-9.344 54.337Z"/><path fill="#FBBC04" d="M12.612 188.892c13.709 31.313 40.145 58.839 58.031 82.995l95.001-112.534s-13.384 17.504-37.662 17.504c-27.043 0-48.89-21.595-48.89-48.825c0-18.673 11.234-31.501 11.234-31.501l-64.489 17.28l-13.225 75.08Z"/><path fill="#4285F4" d="M166.705 5.787c31.552 10.173 58.558 31.53 74.893 63.023l-75.925 90.478s11.234-13.06 11.234-31.617c0-27.864-23.463-48.68-48.81-48.68c-23.969 0-37.735 17.475-37.735 17.475v-57l76.343-33.68Z"/><path fill="#1A73E8" d="M30.015 45.765C48.86 23.218 82.02 0 127.736 0c22.18 0 38.89 5.823 38.89 5.823L90.29 96.516H36.205l-6.19-50.75Z"/><path fill="#EA4335" d="M12.612 188.892S0 164.194 0 128.414c0-33.817 13.146-63.377 30.015-82.649l60.318 50.759l-77.721 92.368Z"/></svg>
                            <input type="text" name="location"  placeholder="geo location" class="form-control">
                        </div>
                        <div class="attachments col-sm-12 mb-2 col-md-6 w-sm-100 h-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -40 256 440"><path fill="#34A853" d="M70.585 271.865a370.712 370.712 0 0 1 28.911 42.642c7.374 13.982 10.448 23.463 15.837 40.31c3.305 9.308 6.292 12.086 12.714 12.086c6.998 0 10.173-4.726 12.626-12.035c5.094-15.91 9.091-28.052 15.397-39.525c12.374-22.15 27.75-41.833 42.858-60.75c4.09-5.354 30.534-36.545 42.439-61.156c0 0 14.632-27.035 14.632-64.792c0-35.318-14.43-59.813-14.43-59.813l-41.545 11.126l-25.23 66.451l-6.242 9.163l-1.248 1.66l-1.66 2.078l-2.914 3.319l-4.164 4.163l-22.467 18.304l-56.17 32.432l-9.344 54.337Z"/><path fill="#FBBC04" d="M12.612 188.892c13.709 31.313 40.145 58.839 58.031 82.995l95.001-112.534s-13.384 17.504-37.662 17.504c-27.043 0-48.89-21.595-48.89-48.825c0-18.673 11.234-31.501 11.234-31.501l-64.489 17.28l-13.225 75.08Z"/><path fill="#4285F4" d="M166.705 5.787c31.552 10.173 58.558 31.53 74.893 63.023l-75.925 90.478s11.234-13.06 11.234-31.617c0-27.864-23.463-48.68-48.81-48.68c-23.969 0-37.735 17.475-37.735 17.475v-57l76.343-33.68Z"/><path fill="#1A73E8" d="M30.015 45.765C48.86 23.218 82.02 0 127.736 0c22.18 0 38.89 5.823 38.89 5.823L90.29 96.516H36.205l-6.19-50.75Z"/><path fill="#EA4335" d="M12.612 188.892S0 164.194 0 128.414c0-33.817 13.146-63.377 30.015-82.649l60.318 50.759l-77.721 92.368Z"/></svg>
                            <select name="wilaya" id="" class="form-control wilaya_select" required>
                                <option value="" disabled selected>Wilaya</option>
                                @foreach($wilayas as $wilaya)
                                    <option @if(request()->get('wilaya')  == $wilaya->id  ) selected  @endif value="{{ $wilaya->id }}"  dairas-url="{{ route('get_dairas_by_wilaya' , $wilaya->id) }}">{{ $wilaya->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="attachments col-sm-12 mb-2 col-md-6 w-sm-100 h-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -40 256 440"><path fill="#34A853" d="M70.585 271.865a370.712 370.712 0 0 1 28.911 42.642c7.374 13.982 10.448 23.463 15.837 40.31c3.305 9.308 6.292 12.086 12.714 12.086c6.998 0 10.173-4.726 12.626-12.035c5.094-15.91 9.091-28.052 15.397-39.525c12.374-22.15 27.75-41.833 42.858-60.75c4.09-5.354 30.534-36.545 42.439-61.156c0 0 14.632-27.035 14.632-64.792c0-35.318-14.43-59.813-14.43-59.813l-41.545 11.126l-25.23 66.451l-6.242 9.163l-1.248 1.66l-1.66 2.078l-2.914 3.319l-4.164 4.163l-22.467 18.304l-56.17 32.432l-9.344 54.337Z"/><path fill="#FBBC04" d="M12.612 188.892c13.709 31.313 40.145 58.839 58.031 82.995l95.001-112.534s-13.384 17.504-37.662 17.504c-27.043 0-48.89-21.595-48.89-48.825c0-18.673 11.234-31.501 11.234-31.501l-64.489 17.28l-13.225 75.08Z"/><path fill="#4285F4" d="M166.705 5.787c31.552 10.173 58.558 31.53 74.893 63.023l-75.925 90.478s11.234-13.06 11.234-31.617c0-27.864-23.463-48.68-48.81-48.68c-23.969 0-37.735 17.475-37.735 17.475v-57l76.343-33.68Z"/><path fill="#1A73E8" d="M30.015 45.765C48.86 23.218 82.02 0 127.736 0c22.18 0 38.89 5.823 38.89 5.823L90.29 96.516H36.205l-6.19-50.75Z"/><path fill="#EA4335" d="M12.612 188.892S0 164.194 0 128.414c0-33.817 13.146-63.377 30.015-82.649l60.318 50.759l-77.721 92.368Z"/></svg>
                            <select name="daira" class="select-bs4 form-control"  id="">
                                @if(request()->get('wilaya') )
                                    @php
                                        $dairas =  \App\Models\Daira::whereHas('wilaya' , function ($builder){
                                            $builder->where('wilaya' , request()->get("wilaya"));
                                        })->get()
                                    @endphp
                                    @foreach($dairas as $daira)
                                        <option @if(request()->get('daira')  == $daira->id) selected  @endif value="{{ $daira }}">{{ $daira->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="attachments col-sm-12 mb-2 col-md-6 w-sm-100 h-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="#ff3259" d="M5 20v-2h1.6l1.975-6.575q.2-.65.738-1.038T10.5 10h3q.65 0 1.188.388t.737 1.037L17.4 18H19v2H5Zm6-12V3h2v5h-2Zm5.95 2.475L15.525 9.05l3.55-3.525l1.4 1.4l-3.525 3.55ZM18 15v-2h5v2h-5ZM7.05 10.475l-3.525-3.55l1.4-1.4l3.55 3.525l-1.425 1.425ZM1 15v-2h5v2H1Z"/></svg>
                            <select name="emergency" id="" required class="form-control">
                                <option value="" disabled selected>@lang("Emergency")</option>
                                <option value="for storage">storage</option>
                                <option value="urgent">urgent</option>
                                <option value="very urgent">very urgent</option>
                                <option value="very very urgent">very very urgent</option>
                            </select>

                        </div>
                        <div class="attachments col-sm-12 mb-2 col-md-6 w-sm-100 h-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="-1 -1 36 36"><path fill="#d9d9d9" d="M28.137 30A1.854 1.854 0 0 0 30 28.168V9.454a1.854 1.854 0 0 0-1.863-1.835H9.956L17.253 30Z"/><path fill="#4352b8" d="m22.041 24.715l-4.755 5.288l-1.731-5.288h6.486z"/><path fill="#617d8b" d="M28.233 15.373v-1.094h-5.274v-1.767h-1.712v1.767h-3.366v1.094h6.7a9.7 9.7 0 0 1-1.922 3.38c-1.369-1.619-1.375-2.146-1.375-2.146h-1.422s.059.788 1.978 3.038a13.51 13.51 0 0 1-1.1 1.016l.438 1.366s.659-.567 1.487-1.445c.828.9 1.9 1.978 3.279 3.265l.9-.9c-1.481-1.344-2.567-2.41-3.364-3.265a9.929 9.929 0 0 0 2.385-4.315h2.368Z"/><path fill="#4f8bf5" d="M3.863 2A1.87 1.87 0 0 0 2 3.863v18.992a1.869 1.869 0 0 0 1.863 1.863h18.181L14.747 2Z"/><path fill="#fff" d="M16.989 7.619h11.148A1.854 1.854 0 0 1 30 9.454v11.227Z" opacity=".2"/><path fill="#f2f2f2" d="M7.055 13.808c.611-1.573 1.211-3.151 1.821-4.724h1.77c.1.242.189.487.282.73c.447 1.153.887 2.309 1.334 3.463s.879 2.286 1.319 3.429l.356.923h-1.558q-.331-1.011-.658-2.024H7.8q-.326 1.013-.658 2.024H5.588l1.469-3.822m1.181.673h3.051c-.51-1.338-1.014-2.678-1.526-4.015c-.514 1.335-1.017 2.678-1.528 4.016Z"/></svg>
                            <select name="language" id="" required class="form-control">
                                <option value="" selected disabled>@lang("Language")</option>
                                <option value="fr">@lang('french')</option>
                                <option value="ar">@lang('arabic')</option>
                                <option value="en">@lang('english')</option>
                            </select>
                        </div>
                        <div class="attachments col-sm-12 mb-2 col-md-6 w-sm-100 h-auto">
                            <label for="campaign">@lang('Donation campaign')</label>
                            <input name="campaign" class="m-2" type="checkbox" id="campaign">
                        </div>

                        <div class="attachments col-sm-12 mb-2 col-md-6 w-sm-100 h-auto campaign-started-at" style="display: none">
                            <label for="campaign">@lang('Started at')</label>
                            <input class="form-control" type="datetime-local" name="started_at">
                        </div>
                        <button type="submit" class="btn btn-info btn-sm text-white fw-bolder">Submit</button>
                    </div>
                </div>
                </form>
            @endif
                @if($articles->count())
                    @foreach($articles as $article)
                        <div class="announces">
                                @switch($article->emergency)
                                    @case("very very urgent")
                                    <div class="post-type v-v-ergent-post">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M3 14q0-2.625 1.25-4.675T7 5.875q1.5-1.4 2.75-2.138L11 3v3.3q0 .925.625 1.462t1.4.538q.425 0 .813-.175t.712-.575L15 7q1.8 1.05 2.9 2.912T19 14q0 2.2-1.075 4.013T15.1 20.874q.425-.6.663-1.313T16 18.05q0-1-.375-1.888t-1.075-1.587L11 11.1l-3.525 3.475q-.725.725-1.1 1.6T6 18.05q0 .8.238 1.513t.662 1.312q-1.75-1.05-2.825-2.863T3 14Zm8-.1l2.125 2.075q.425.425.65.95T14 18.05q0 1.225-.875 2.087T11 21q-1.25 0-2.125-.863T8 18.05q0-.575.225-1.113t.65-.962L11 13.9ZM21 11q-.425 0-.713-.288T20 10q0-.425.288-.713T21 9q.425 0 .713.288T22 10q0 .425-.288.713T21 11Zm-1-3V3h2v5h-2Z"/></svg>
                                        <span>very very urgent</span>
                                    </div>
                                    @break
                                    @case("very urgent")
                                    <div class="post-type v-ergent-post">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M5 20v-2h1.6l1.975-6.575q.2-.65.738-1.038T10.5 10h3q.65 0 1.188.388t.737 1.037L17.4 18H19v2H5Zm6-12V3h2v5h-2Zm5.95 2.475L15.525 9.05l3.55-3.525l1.4 1.4l-3.525 3.55ZM18 15v-2h5v2h-5ZM7.05 10.475l-3.525-3.55l1.4-1.4l3.55 3.525l-1.425 1.425ZM1 15v-2h5v2H1Z"/></svg>
                                        <span>very urgent</span>
                                    </div>
                                    @break
                                    @case("urgent")
                                    <div class="post-type ergent-post">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 22.025q-.4 0-.763-.15t-.662-.425L2.55 13.425q-.275-.3-.425-.663T1.975 12q0-.4.15-.775t.425-.65l8.025-8.025q.3-.3.663-.438T12 1.975q.4 0 .775.138t.65.437l8.025 8.025q.3.275.438.65t.137.775q0 .4-.137.763t-.438.662l-8.025 8.025q-.275.275-.65.425t-.775.15ZM11 13h2V7h-2v6Zm1 3q.425 0 .713-.288T13 15q0-.425-.288-.713T12 14q-.425 0-.713.288T11 15q0 .425.288.713T12 16Z"/></svg>
                                        <span>urgent</span>
                                    </div>
                                    @break
                                    @case("for storage")
                                     <div class="post-type storage-post">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M21 7c-1 0-1-1-1-1V5h-2v2h-2V6c0-1.73-1.25-5-6-5S4 4.27 4 6v13c0 .33-.1 2-2 2v2c2.93 0 4-2.39 4-4V6c0-.12.05-3 4-3c3.83 0 4 2.7 4 3v1h-2V5h-2v1s0 1-1 1s-1 1-1 1v12s0 2 5 2h4c5 0 5-2 5-2V8s0-1-1-1m-6 12.4a3 3 0 0 1-3-3c0-2 3-5.4 3-5.4s3 3.4 3 5.4a3 3 0 0 1-3 3Z"/></svg>
                                        <span>for storage</span>
                                     </div>
                                    @break

                                    @default

                                @endswitch

                            <div class="header">
                                <div class="announcer-user-photo">
                                    <img src="{{  optional($article->user)->getFirstMediaUrl('avatar' , 'thumb')  }}" alt="">
                                </div>
                                <div class="post-info">
                                    <div class="user-name">
                                        <span>{{ optional($article->user)->fname . ' | '. optional($article->user)->lname }}</span>
                                    </div>
                                    <div class="informations">
                                        <span>{{ optional($article->wilaya_rel)->name . ' | ' . optional($article->daira_rel)->name  }}</span>
                                        <span>&#9679</span>
                                        <span>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $article->created_at)->diffForHumans(\Carbon\Carbon::now()) }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="announces-container">
                                <div class="announces-description">
                        <span>
                           {{ $article->content }}
                        </span>
                                </div>
                                <div class="announces-position-type">
                                    <div class="location-blood-announce">
                                      <div id="map{{ $article->id }}" style="width: 100%;height: 100%"></div>
                                    </div>
                                    <div class="type-blood-announce-indice">
                                        @switch($article->blood)
                                            @case("O+")
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><g><path fill-rule="evenodd" d="M14 18a6 6 0 1 1 12 0a6 6 0 0 1-12 0Zm6-4a4 4 0 1 0 0 8a4 4 0 0 0 0-8Z" clip-rule="evenodd"></path><path d="M28 17a1 1 0 1 0 0 2h1.5v1.5a1 1 0 1 0 2 0V19H33a1 1 0 1 0 0-2h-1.5v-1.5a1 1 0 1 0-2 0V17H28Z"></path><path fill-rule="evenodd" d="M10 34.03c0 2.193 1.79 3.97 4 3.97h4v2h5v4h2v-4h5v-2h4c2.21 0 4-1.777 4-3.97V10.328c0-2.192-1.79-3.97-4-3.97h-6l-1.132-1.155a4.022 4.022 0 0 0-5.736 0L20 6.358h-6c-2.21 0-4 1.777-4 3.97V34.03ZM28 8.359a2 2 0 0 1-1.429-.6L25.44 6.602a2.021 2.021 0 0 0-2.878 0L21.43 7.758a2 2 0 0 1-1.429.6h-6c-1.12 0-2 .896-2 1.97V28.97a68.676 68.676 0 0 1 3.7.06l.53.02c1.284.048 2.481.093 3.652.069c2.627-.056 5.042-.466 7.61-1.981c3.118-1.84 5.758-1.288 7.583-.226c.338.197.647.41.925.626V10.327c0-1.073-.88-1.97-2-1.97h-6Z" clip-rule="evenodd"></path></g></svg>
                                            @break
                                            @case("O-")
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><g><path fill-rule="evenodd" d="M20 12a6 6 0 1 0 0 12a6 6 0 0 0 0-12Zm-4 6a4 4 0 1 1 8 0a4 4 0 0 1-8 0Z" clip-rule="evenodd"></path><path d="M27 18a1 1 0 0 1 1-1h5a1 1 0 1 1 0 2h-5a1 1 0 0 1-1-1Z"></path><path fill-rule="evenodd" d="M38 34.03c0 2.193-1.79 3.97-4 3.97h-4v2h-5v4h-2v-4h-5v-2h-4c-2.21 0-4-1.777-4-3.97V10.328c0-2.192 1.79-3.97 4-3.97h6l1.132-1.155a4.022 4.022 0 0 1 5.736 0L28 6.358h6c2.21 0 4 1.777 4 3.97V34.03ZM26.571 7.759a2 2 0 0 0 1.429.6h6c1.12 0 2 .896 2 1.97v17.21a8.441 8.441 0 0 0-.925-.625c-1.825-1.062-4.465-1.614-7.583.226c-2.568 1.515-4.983 1.925-7.61 1.98c-1.171.025-2.368-.02-3.651-.069l-.53-.02A68.676 68.676 0 0 0 12 28.972V10.327c0-1.073.88-1.97 2-1.97h6a2 2 0 0 0 1.429-.6l1.132-1.155a2.021 2.021 0 0 1 2.878 0l1.132 1.156Z" clip-rule="evenodd"></path></g></svg>
                                                @break
                                            @case("B+")
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><g><path fill-rule="evenodd" d="M15 12a1 1 0 0 1 1-1h5a4 4 0 0 1 2.646 7A4 4 0 0 1 21 25h-5a1 1 0 0 1-1-1V12Zm6 5a2 2 0 1 0 0-4h-4v4h4Zm2 4a2 2 0 0 1-2 2h-4v-4h4a2 2 0 0 1 2 2Z" clip-rule="evenodd"></path><path d="M27 17a1 1 0 1 0 0 2h1.5v1.5a1 1 0 1 0 2 0V19H32a1 1 0 1 0 0-2h-1.5v-1.5a1 1 0 1 0-2 0V17H27Z"></path><path fill-rule="evenodd" d="M10 34.03c0 2.193 1.79 3.97 4 3.97h4v2h5v4h2v-4h5v-2h4c2.21 0 4-1.777 4-3.97V10.328c0-2.192-1.79-3.97-4-3.97h-6l-1.132-1.155a4.022 4.022 0 0 0-5.736 0L20 6.358h-6c-2.21 0-4 1.777-4 3.97V34.03ZM28 8.359a2 2 0 0 1-1.429-.6L25.44 6.602a2.021 2.021 0 0 0-2.878 0L21.43 7.758a2 2 0 0 1-1.429.6h-6c-1.12 0-2 .896-2 1.97V28.97a68.676 68.676 0 0 1 3.7.06l.53.02c1.284.048 2.481.093 3.652.069c2.627-.056 5.042-.466 7.61-1.981c3.118-1.84 5.758-1.288 7.583-.226c.338.197.647.41.925.626V10.327c0-1.073-.88-1.97-2-1.97h-6Z" clip-rule="evenodd"></path></g></svg>
                                            @break
                                            @case("B-")
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><g><path fill-rule="evenodd" d="M16 11a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h5a4 4 0 0 0 2.646-7A4 4 0 0 0 21 11h-5Zm7 4a2 2 0 0 1-2 2h-4v-4h4a2 2 0 0 1 2 2Zm0 6a2 2 0 0 0-2-2h-4v4h4a2 2 0 0 0 2-2Z" clip-rule="evenodd"></path><path d="M26 18a1 1 0 0 1 1-1h5a1 1 0 1 1 0 2h-5a1 1 0 0 1-1-1Z"></path><path fill-rule="evenodd" d="M34 38c2.21 0 4-1.777 4-3.97V10.328c0-2.192-1.79-3.97-4-3.97h-6l-1.132-1.155a4.022 4.022 0 0 0-5.736 0L20 6.358h-6c-2.21 0-4 1.777-4 3.97V34.03c0 2.193 1.79 3.97 4 3.97h4v2h5v4h2v-4h5v-2h4ZM26.571 7.758a2 2 0 0 0 1.429.6h6c1.12 0 2 .896 2 1.97v17.21a8.441 8.441 0 0 0-.925-.625c-1.825-1.062-4.465-1.614-7.583.226c-2.568 1.515-4.983 1.925-7.61 1.98c-1.171.025-2.368-.02-3.651-.069l-.53-.02A68.676 68.676 0 0 0 12 28.972V10.327c0-1.073.88-1.97 2-1.97h6a2 2 0 0 0 1.429-.6l1.132-1.155a2.021 2.021 0 0 1 2.878 0l1.132 1.156Z" clip-rule="evenodd"></path></g></svg>
                                            @break
                                            @case("A+")
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><g><path fill-rule="evenodd" d="M20 10a1 1 0 0 1 .923.615l3.742 8.98l.017.042l1.241 2.978a1 1 0 0 1-1.846.77L23.083 21h-6.166l-.994 2.385a1 1 0 0 1-1.846-.77l1.241-2.978l.018-.042l3.74-8.98A1 1 0 0 1 20 10Zm2.25 9L20 13.6L17.75 19h4.5Z" clip-rule="evenodd"></path><path d="M27 16a1 1 0 1 0 0 2h2v2a1 1 0 1 0 2 0v-2h2a1 1 0 1 0 0-2h-2v-2a1 1 0 1 0-2 0v2h-2Z"></path><path fill-rule="evenodd" d="M10 34.03c0 2.193 1.79 3.97 4 3.97h4v2h5v4h2v-4h5v-2h4c2.21 0 4-1.777 4-3.97V10.328c0-2.192-1.79-3.97-4-3.97h-6l-1.132-1.155a4.022 4.022 0 0 0-5.736 0L20 6.358h-6c-2.21 0-4 1.777-4 3.97V34.03ZM28 8.359a2 2 0 0 1-1.429-.6L25.44 6.602a2.021 2.021 0 0 0-2.878 0L21.43 7.758a2 2 0 0 1-1.429.6h-6c-1.12 0-2 .896-2 1.97V28.97a68.676 68.676 0 0 1 3.7.06l.53.02c1.284.048 2.481.093 3.652.069c2.627-.056 5.042-.466 7.61-1.981c3.118-1.84 5.758-1.288 7.583-.226c.338.197.647.41.925.626V10.327c0-1.073-.88-1.97-2-1.97h-6Z" clip-rule="evenodd"></path></g></svg>
                                            @break
                                            @case("A-")
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><g><path fill-rule="evenodd" d="M20.923 10.615a1 1 0 0 0-1.846 0l-3.742 8.98a1.036 1.036 0 0 0-.017.042l-1.241 2.978a1 1 0 0 0 1.846.77L16.917 21h6.166l.994 2.385a1 1 0 0 0 1.846-.77l-1.241-2.978a1.036 1.036 0 0 0-.017-.042l-3.742-8.98ZM20 13.6l2.25 5.4h-4.5L20 13.6Z" clip-rule="evenodd"></path><path d="M26 17a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2h-6a1 1 0 0 1-1-1Z"></path><path fill-rule="evenodd" d="M38 34.03c0 2.193-1.79 3.97-4 3.97h-4v2h-5v4h-2v-4h-5v-2h-4c-2.21 0-4-1.777-4-3.97V10.328c0-2.192 1.79-3.97 4-3.97h6l1.132-1.155a4.022 4.022 0 0 1 5.736 0L28 6.358h6c2.21 0 4 1.777 4 3.97V34.03ZM26.571 7.759a2 2 0 0 0 1.429.6h6c1.12 0 2 .896 2 1.97v17.21a8.441 8.441 0 0 0-.925-.625c-1.825-1.062-4.465-1.614-7.583.226c-2.568 1.515-4.983 1.925-7.61 1.98c-1.171.025-2.368-.02-3.651-.069l-.53-.02A68.676 68.676 0 0 0 12 28.972V10.327c0-1.073.88-1.97 2-1.97h6a2 2 0 0 0 1.429-.6l1.132-1.155a2.021 2.021 0 0 1 2.878 0l1.132 1.156Z" clip-rule="evenodd"></path></g></svg>
                                            @break
                                            @case("AB-")
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><g><path d="M20.388 5.535a5.018 5.018 0 0 1 7.224 0l.528.548h5.19c2.573 0 4.67 2.074 4.67 4.646V15.5h-2v-4.771a2.658 2.658 0 0 0-2.67-2.646h-5.616a1 1 0 0 1-.72-.307l-.823-.855a3.018 3.018 0 0 0-4.342 0l-.823.855a1 1 0 0 1-.72.307H15c-1.663 0-3 1.338-3 2.974V28.97a68.776 68.776 0 0 1 3.7.06l.53.02c1.284.048 2.481.093 3.652.069c2.627-.056 5.042-.466 7.61-1.981c3.118-1.84 5.758-1.288 7.583-.226c.338.197.647.41.925.626V22.5h2v10.526C38 35.78 35.755 38 33 38h-3v2h-5v4h-2v-4h-5v-2h-3c-2.755 0-5-2.22-5-4.974v-21.97c0-2.752 2.245-4.973 5-4.973h4.86l.528-.548Z"></path><path fill-rule="evenodd" d="M19.416 14.6a1 1 0 0 0-1.832 0l-2.616 5.98a.998.998 0 0 0-.018.04l-.866 1.98a1 1 0 0 0 1.832.8l.613-1.4h3.942l.613 1.4a1 1 0 0 0 1.832-.8l-.866-1.98a.998.998 0 0 0-.018-.04l-2.616-5.98Zm-.916 2.895L19.596 20h-2.192l1.096-2.505ZM24 15a1 1 0 0 1 1-1h3.125C29.773 14 31 15.405 31 17a3.09 3.09 0 0 1-.732 2c.46.54.732 1.249.732 2c0 1.595-1.227 3-2.875 3H25a1 1 0 0 1-1-1v-8Zm4.125 3c.423 0 .875-.386.875-1s-.452-1-.875-1H26v2h2.125ZM29 21c0 .614-.452 1-.875 1H26v-2h2.125c.423 0 .875.386.875 1Z" clip-rule="evenodd"></path><path d="M34 18a1 1 0 1 0 0 2h3a1 1 0 0 0 0-2h-3Z"></path></g></svg>
                                            @break
                                            @case("AB+")
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><g><path d="M27.612 5.535a5.018 5.018 0 0 0-7.224 0l-.528.548H15c-2.755 0-5 2.22-5 4.974v21.97C10 35.778 12.245 38 15 38h3v2h5v4h2v-4h5v-2h3c2.755 0 5-2.22 5-4.974V23h-2v4.539a8.442 8.442 0 0 0-.925-.626c-1.825-1.062-4.465-1.614-7.583.226c-2.568 1.515-4.983 1.925-7.61 1.98c-1.17.025-2.368-.02-3.65-.069l-.531-.02A68.776 68.776 0 0 0 12 28.97V11.058c0-1.636 1.337-2.974 3-2.974h5.286a1 1 0 0 0 .72-.307l.823-.855a3.018 3.018 0 0 1 4.342 0l.823.855a1 1 0 0 0 .72.307h5.616c1.48 0 2.67 1.19 2.67 2.646V15h2v-4.271c0-2.572-2.097-4.646-4.67-4.646h-5.19l-.528-.548Z"></path><path fill-rule="evenodd" d="M18.5 14a1 1 0 0 1 .916.6l2.616 5.98a.998.998 0 0 1 .018.04l.866 1.98a1 1 0 0 1-1.832.8L20.47 22h-3.942l-.613 1.4a1 1 0 0 1-1.832-.8l.866-1.98l.002-.005a.887.887 0 0 1 .016-.036l2.616-5.98A1 1 0 0 1 18.5 14Zm1.096 6L18.5 17.495L17.404 20h2.192ZM25 14a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h3.125C29.773 24 31 22.595 31 21a3.09 3.09 0 0 0-.732-2A3.09 3.09 0 0 0 31 17c0-1.595-1.227-3-2.875-3H25Zm4 3c0 .614-.452 1-.875 1H26v-2h2.125c.423 0 .875.386.875 1Zm0 4c0-.614-.452-1-.875-1H26v2h2.125c.423 0 .875-.386.875-1Z" clip-rule="evenodd"></path><path d="M32 19a1 1 0 0 1 1-1h1v-1a1 1 0 1 1 2 0v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 0 1-2 0v-1h-1a1 1 0 0 1-1-1Z"></path></g></svg>
                                            @break

                                            @default
                                        @endswitch


                                    </div>
                                </div>
                            </div>
                            <div class="announces-nav-buttons">
                                <!---love icon---->
                                <div class="nav-btn-dv love-announces-dv">
                                    <a href="{{  route('patient.like_article' ,['like' , $article->id]) }}"  @if(in_array(\Illuminate\Support\Facades\Auth::guard('patient')->id() , $article->likes->pluck('user_id')->toArray())) style="fill: red" @endif>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="m8 14.25l.345.666a.75.75 0 0 1-.69 0l-.008-.004l-.018-.01a7.152 7.152 0 0 1-.31-.17a22.055 22.055 0 0 1-3.434-2.414C2.045 10.731 0 8.35 0 5.5C0 2.836 2.086 1 4.25 1C5.797 1 7.153 1.802 8 3.02C8.847 1.802 10.203 1 11.75 1C13.914 1 16 2.836 16 5.5c0 2.85-2.045 5.231-3.885 6.818a22.066 22.066 0 0 1-3.744 2.584l-.018.01l-.006.003h-.002ZM4.25 2.5c-1.336 0-2.75 1.164-2.75 3c0 2.15 1.58 4.144 3.365 5.682A20.58 20.58 0 0 0 8 13.393a20.58 20.58 0 0 0 3.135-2.211C12.92 9.644 14.5 7.65 14.5 5.5c0-1.836-1.414-3-2.75-3c-1.373 0-2.609.986-3.029 2.456a.749.749 0 0 1-1.442 0C6.859 3.486 5.623 2.5 4.25 2.5Z"/></svg>
                                    </a>
                                </div>
                                <!---messeger icon---->
                                <div class="nav-btn-dv chat-announces-dv">
                                    <a href="{{ route('patient.get_my_chat_page' , ['type' => 'patient' , 'current' => $article->author_id]) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="2 2 22 22"><path d="m14.777 14.038l2.65-3.92c.262-.386-.235-.805-.615-.529l-2.858 2.015a.571.571 0 0 1-.652 0l-2.116-1.477c-.633-.437-1.538-.277-1.963.335l-2.65 3.92c-.262.386.235.806.615.529l2.858-2.015a.571.571 0 0 1 .652 0l2.116 1.452c.633.462 1.538.302 1.963-.31Z"/><path fill="currentColor" fill-rule="evenodd" d="M12 2.25A9.75 9.75 0 0 0 2.25 12a9.724 9.724 0 0 0 3 7.036V21.5a.75.75 0 0 0 .987.712l2.78-.927A9.745 9.745 0 0 0 12 21.75c5.385 0 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM3.75 12a8.25 8.25 0 1 1 5.516 7.787a.75.75 0 0 0-.486-.004l-2.03.676v-1.75a.75.75 0 0 0-.25-.56A8.228 8.228 0 0 1 3.75 12Z" clip-rule="evenodd"/></svg>
                                    </a>
                                </div>
                                <!---save icon---->
                                <div class="nav-btn-dv save-announces-dv">
                                    <a href="{{  route('patient.like_article' ,['favorite' , $article->id]) }}"  @if(in_array(\Illuminate\Support\Facades\Auth::guard('patient')->id() , $article->favorites->pluck('user_id')->toArray())) style="fill: red" @endif>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M16 2H8a3 3 0 0 0-3 3v16a1 1 0 0 0 .5.87a1 1 0 0 0 1 0l5.5-3.18l5.5 3.18a1 1 0 0 0 .5.13a1 1 0 0 0 .5-.13A1 1 0 0 0 19 21V5a3 3 0 0 0-3-3Zm1 17.27l-4.5-2.6a1 1 0 0 0-1 0L7 19.27V5a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1Z"/></svg>
                                    </a>
                                </div>
                                <!---report icon---->
                                <div class="nav-btn-dv report-announces-dv">
                                    <a href="{{  route('patient.like_article' ,['report' , $article->id]) }}"  @if(in_array(\Illuminate\Support\Facades\Auth::guard('patient')->id() , $article->reports->pluck('user_id')->toArray())) style="fill: red" @endif>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="1 1 20 20"><path d="M15.73 3H8.27L3 8.27v7.46L8.27 21h7.46L21 15.73V8.27L15.73 3zM19 14.9L14.9 19H9.1L5 14.9V9.1L9.1 5h5.8L19 9.1v5.8z"/><path fill="currentColor" d="M11 7h2v6h-2zm0 8h2v2h-2z"/></svg>
                                    </a>
                                </div>

                            </div>
                        </div>
                    @endforeach
                        {{ $articles->links() }}
                @else
                        <div class="alert alert-warning">@lang("No Result found")</div>
                @endif
        </div>
        <div class="right-fixed-menu">
            <div class="settings">
                <div class="header-stng">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M13.875 22h-3.75q-.375 0-.65-.25t-.325-.625l-.3-2.325q-.325-.125-.613-.3t-.562-.375l-2.175.9q-.35.125-.7.025t-.55-.425L2.4 15.4q-.2-.325-.125-.7t.375-.6l1.875-1.425Q4.5 12.5 4.5 12.337v-.674q0-.163.025-.338L2.65 9.9q-.3-.225-.375-.6t.125-.7l1.85-3.225q.175-.35.537-.438t.713.038l2.175.9q.275-.2.575-.375t.6-.3l.3-2.325q.05-.375.325-.625t.65-.25h3.75q.375 0 .65.25t.325.625l.3 2.325q.325.125.613.3t.562.375l2.175-.9q.35-.125.7-.025t.55.425L21.6 8.6q.2.325.125.7t-.375.6l-1.875 1.425q.025.175.025.338v.674q0 .163-.05.338l1.875 1.425q.3.225.375.6t-.125.7l-1.85 3.2q-.2.325-.563.438t-.712-.013l-2.125-.9q-.275.2-.575.375t-.6.3l-.3 2.325q-.05.375-.325.625t-.65.25Zm-1.825-6.5q1.45 0 2.475-1.025T15.55 12q0-1.45-1.025-2.475T12.05 8.5q-1.475 0-2.488 1.025T8.55 12q0 1.45 1.012 2.475T12.05 15.5Z"/></svg>
                    <span>filtre</span>
                </div>
                <div class="container-stng">
                    <form action="{{ url()->current() }}">
                        <div class="filtre">
                            <div class="sous-header-fltr">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M8.75 17.225h1.8v-8.45h-3V10.6h1.2v6.625Zm4.45 0h1.2q.75 0 1.287-.525t.538-1.275V10.6q0-.75-.537-1.287T14.4 8.775h-1.2q-.75 0-1.275.537T11.4 10.6v4.825q0 .75.525 1.275t1.275.525Zm0-1.8V10.6h1.2v4.825h-1.2ZM9 3V1h6v2H9Zm3 19q-1.85 0-3.488-.713T5.65 19.35q-1.225-1.225-1.938-2.863T3 13q0-1.85.713-3.488T5.65 6.65q1.225-1.225 2.863-1.938T12 4q1.55 0 2.975.5t2.675 1.45l1.4-1.4l1.4 1.4l-1.4 1.4Q20 8.6 20.5 10.025T21 13q0 1.85-.713 3.488T18.35 19.35q-1.225 1.225-2.863 1.938T12 22Z"></path></svg>
                                <span>@lang('time range')</span>
                            </div>
                            <div class="sou-container-fltr">
                                <input type="text" name="created_at" value="{{ request()->get('created_at') }}" class="form-control">
                            </div>
                        </div>
                        <div class="filtre">
                            <div class="sous-header-fltr">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path  d="M8.75 10a3.25 3.25 0 1 1 6.5 0a3.25 3.25 0 0 1-6.5 0Z"/><path fill-rule="evenodd" d="M3.774 8.877a8.038 8.038 0 0 1 8.01-7.377h.432a8.038 8.038 0 0 1 8.01 7.377a8.693 8.693 0 0 1-1.933 6.217L13.5 20.956a1.937 1.937 0 0 1-3 0l-4.792-5.862a8.693 8.693 0 0 1-1.934-6.217ZM12 5.25a4.75 4.75 0 1 0 0 9.5a4.75 4.75 0 0 0 0-9.5Z" clip-rule="evenodd"/></svg>
                                <span>filtre by wilaya</span>
                            </div>
                            <div class="sou-container-fltr">
                                <select name="wilaya_id">
                                    <option value="" disabled selected>Wilaya</option>
                                    @foreach($wilayas as $wilaya)
                                        <option @if(request()->get('wilaya_id')  == $wilaya->id  ) selected  @endif value="{{ $wilaya->id }}"  dairas-url="{{ route('get_dairas_by_wilaya' , $wilaya->id) }}">{{ $wilaya->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="filtre">
                            <div class="sous-header-fltr">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path  d="M8.75 10a3.25 3.25 0 1 1 6.5 0a3.25 3.25 0 0 1-6.5 0Z"/><path fill-rule="evenodd" d="M3.774 8.877a8.038 8.038 0 0 1 8.01-7.377h.432a8.038 8.038 0 0 1 8.01 7.377a8.693 8.693 0 0 1-1.933 6.217L13.5 20.956a1.937 1.937 0 0 1-3 0l-4.792-5.862a8.693 8.693 0 0 1-1.934-6.217ZM12 5.25a4.75 4.75 0 1 0 0 9.5a4.75 4.75 0 0 0 0-9.5Z" clip-rule="evenodd"/></svg>
                                <span>filtre by daira</span>
                            </div>
                            <div class="sou-container-fltr">
                                <select name="daira_id">
                                    <option value="*"  selected>@lang("All")</option>
                                    @if(request()->get('wilaya_id') )
                                        @php
                                            $dairas =  \App\Models\Daira::whereHas('wilaya' , function ($builder){
                                                $builder->where('wilaya_id' , request()->get("wilaya_id"));
                                            })->get()
                                        @endphp
                                        @foreach($dairas as $daira)
                                            <option @if(request()->get('daira_id')  == $daira->id  ) selected  @endif value="{{ $daira->id }}">{{ $daira->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="filtre">
                            <div class="sous-header-fltr">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M8.75 17.225h1.8v-8.45h-3V10.6h1.2v6.625Zm4.45 0h1.2q.75 0 1.287-.525t.538-1.275V10.6q0-.75-.537-1.287T14.4 8.775h-1.2q-.75 0-1.275.537T11.4 10.6v4.825q0 .75.525 1.275t1.275.525Zm0-1.8V10.6h1.2v4.825h-1.2ZM9 3V1h6v2H9Zm3 19q-1.85 0-3.488-.713T5.65 19.35q-1.225-1.225-1.938-2.863T3 13q0-1.85.713-3.488T5.65 6.65q1.225-1.225 2.863-1.938T12 4q1.55 0 2.975.5t2.675 1.45l1.4-1.4l1.4 1.4l-1.4 1.4Q20 8.6 20.5 10.025T21 13q0 1.85-.713 3.488T18.35 19.35q-1.225 1.225-2.863 1.938T12 22Z"/></svg>
                                <span>filtre by umergency</span>
                            </div>
                            <div class="sou-container-fltr">
                                <select type="text" name="emergency">
                                   <option value="*">@lang("All")</option>
                                   @foreach(['for storage' , 'urgent' , 'very urgent' , 'very very urgent'] as $stat)
                                        <option @if(request()->get('emergency') == $stat) selected @endif value="{{ $stat }}">{{ $stat }}</option>
                                   @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="filtre">
                            <div class="sous-header-fltr">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><g><path d="M20.388 5.535a5.018 5.018 0 0 1 7.224 0l.528.548h5.19c2.573 0 4.67 2.074 4.67 4.646V15.5h-2v-4.771a2.658 2.658 0 0 0-2.67-2.646h-5.616a1 1 0 0 1-.72-.307l-.823-.855a3.018 3.018 0 0 0-4.342 0l-.823.855a1 1 0 0 1-.72.307H15c-1.663 0-3 1.338-3 2.974V28.97a68.776 68.776 0 0 1 3.7.06l.53.02c1.284.048 2.481.093 3.652.069c2.627-.056 5.042-.466 7.61-1.981c3.118-1.84 5.758-1.288 7.583-.226c.338.197.647.41.925.626V22.5h2v10.526C38 35.78 35.755 38 33 38h-3v2h-5v4h-2v-4h-5v-2h-3c-2.755 0-5-2.22-5-4.974v-21.97c0-2.752 2.245-4.973 5-4.973h4.86l.528-.548Z"/><path d="M26 15a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-3h3v3a1 1 0 1 0 2 0v-8a1 1 0 1 0-2 0v3h-3v-3Z"/><path fill-rule="evenodd" d="M15 15a1 1 0 0 1 1-1h3.125C20.773 14 22 15.405 22 17c0 1.096-.58 2.103-1.477 2.625l1.383 2.95a1 1 0 0 1-1.811.85L18.488 20H17v3a1 1 0 1 1-2 0v-8Zm5 2c0-.614-.452-1-.875-1H17v2h2.125c.423 0 .875-.386.875-1Z" clip-rule="evenodd"/><path d="M33 18a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-4Z"/></g></svg>
                                <span>type of blood</span>
                            </div>
                            <div class="sou-container-fltr">
                                <select type="text" name="blood">
                                    <option value="*">all</option>
                                    @foreach(\App\Models\Patient::bloud_group as $group)
                                        <option  @if(request()->get('blood') == $group) selected @endif value="{{ $group }}">{{ $group }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="filtre">
                            <div class="sous-header-fltr">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zm6.93 6h-2.95a15.65 15.65 0 0 0-1.38-3.56A8.03 8.03 0 0 1 18.92 8zM12 4.04c.83 1.2 1.48 2.53 1.91 3.96h-3.82c.43-1.43 1.08-2.76 1.91-3.96zM4.26 14C4.1 13.36 4 12.69 4 12s.1-1.36.26-2h3.38c-.08.66-.14 1.32-.14 2s.06 1.34.14 2H4.26zm.82 2h2.95c.32 1.25.78 2.45 1.38 3.56A7.987 7.987 0 0 1 5.08 16zm2.95-8H5.08a7.987 7.987 0 0 1 4.33-3.56A15.65 15.65 0 0 0 8.03 8zM12 19.96c-.83-1.2-1.48-2.53-1.91-3.96h3.82c-.43 1.43-1.08 2.76-1.91 3.96zM14.34 14H9.66c-.09-.66-.16-1.32-.16-2s.07-1.35.16-2h4.68c.09.65.16 1.32.16 2s-.07 1.34-.16 2zm.25 5.56c.6-1.11 1.06-2.31 1.38-3.56h2.95a8.03 8.03 0 0 1-4.33 3.56zM16.36 14c.08-.66.14-1.32.14-2s-.06-1.34-.14-2h3.38c.16.64.26 1.31.26 2s-.1 1.36-.26 2h-3.38z"/></svg>
                                <span>language of announces</span>
                            </div>
                            <div class="sou-container-fltr">
                                <select type="text" name="language">
                                    <option value="*">بكل اللغات</option>
                                    <option value="ar" @if(request()->get('language') == "ar") selected @endif>الترجمة الى العربية</option>
                                    <option value="fr" @if(request()->get('language') == "fr") selected @endif>traduit vers le Francais</option>
                                    <option value="en" @if(request()->get('language') == "en") selected @endif>translate to English</option>
                                </select>
                            </div>
                        </div>
                        <a href="{{ url()->current() }}" class="btn btn-secondary rounded-0 ">Reset</a>
                        <button type="submit">activate the filtre</button>
                    </form>
                </div>
            </div>
            <div class="questions-&-answer">
                <div class="header-stng">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path d="M12.5 3C6.701 3 2 7.701 2 13.5a10.479 10.479 0 0 0 1.102 4.688l-1.05 3.918a1.5 1.5 0 0 0 1.838 1.837l3.915-1.049A10.461 10.461 0 0 0 12.5 24C18.3 24 23 19.299 23 13.5S18.3 3 12.5 3Zm1.955 22.342a12.077 12.077 0 0 1-2.808.128A10.474 10.474 0 0 0 19.5 29a10.46 10.46 0 0 0 4.695-1.106l3.915 1.05a1.5 1.5 0 0 0 1.837-1.838l-1.05-3.918A10.44 10.44 0 0 0 30 18.5a10.5 10.5 0 0 0-6.451-9.69c.362.853.63 1.757.787 2.699A8.49 8.49 0 0 1 28 18.5a8.46 8.46 0 0 1-1.046 4.088a1 1 0 0 0-.09.74l.927 3.46l-3.456-.927a1 1 0 0 0-.74.09a8.457 8.457 0 0 1-4.095 1.05a8.462 8.462 0 0 1-5.045-1.66ZM11.5 15c0-1.655.884-2.662 1.6-3.478l.02-.022c.56-.64.88-1.02.88-1.5c-.01-.29-.18-1-1.5-1c-1.43 0-1.5.83-1.5 1c0 .55-.45 1-1 1s-1-.45-1-1c0-1.21.93-3 3.5-3S16 8.79 16 10s-.73 2.09-1.38 2.83l-.018.02C14.01 13.523 13.5 14.1 13.5 15c0 .55-.45 1-1 1s-1-.45-1-1Zm2.25 3.75a1.25 1.25 0 1 1-2.5 0a1.25 1.25 0 0 1 2.5 0Z"/></svg>
                    <span>questions & answer</span>
                </div>
            </div>
            <div class="how-to-post-an-announce">
                <div class="header-stng">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 36"><path d="m33 6.4l-3.7-3.7a1.71 1.71 0 0 0-2.36 0L23.65 6H6a2 2 0 0 0-2 2v22a2 2 0 0 0 2 2h22a2 2 0 0 0 2-2V11.76l3-3a1.67 1.67 0 0 0 0-2.36ZM18.83 20.13l-4.19.93l1-4.15l9.55-9.57l3.23 3.23ZM29.5 9.43L26.27 6.2l1.85-1.85l3.23 3.23Z" class="clr-i-solid clr-i-solid-path-1"/><path fill="none" d="M0 0h36v36H0z"/></svg>
                    <span>how to post an announce</span>
                </div>
            </div>
            <div class="history">
                <div class="header-stng">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M13.26 3C8.17 2.86 4 6.95 4 12H2.21c-.45 0-.67.54-.35.85l2.79 2.8c.2.2.51.2.71 0l2.79-2.8a.5.5 0 0 0-.36-.85H6c0-3.9 3.18-7.05 7.1-7c3.72.05 6.85 3.18 6.9 6.9c.05 3.91-3.1 7.1-7 7.1c-1.61 0-3.1-.55-4.28-1.48a.994.994 0 0 0-1.32.08c-.42.42-.39 1.13.08 1.49A8.858 8.858 0 0 0 13 21c5.05 0 9.14-4.17 9-9.26c-.13-4.69-4.05-8.61-8.74-8.74zm-.51 5c-.41 0-.75.34-.75.75v3.68c0 .35.19.68.49.86l3.12 1.85c.36.21.82.09 1.03-.26c.21-.36.09-.82-.26-1.03l-2.88-1.71v-3.4c0-.4-.34-.74-.75-.74z"/></svg>
                    <span>history</span>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-styles')
    <link rel="stylesheet" href="{{asset('theme/css/blood-search-timeline-styles.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="{{ asset('lte/plugins/daterangepicker/daterangepicker.css') }}">
    <style>
        /* Style for the custom select container */
        .custom-select {
            position: relative;
            display: inline-block;
        }

        /* Hide the default select dropdown arrow */
        .custom-select select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-color: transparent;
            padding: 5px 30px 5px 10px; /* Adjust padding as needed */
            border: 1px solid #ccc; /* Add a border for styling */
            cursor: pointer;
        }

        /* Style for the custom arrow or image */
        .custom-select::after {
            content: url('arrow.png'); /* Replace 'arrow.png' with the path to your image */
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
        }

        @media screen and (max-width:700px) {
                   .w-sm-100{
                       width: 100%;
                   }
        }
    </style>

@endpush
@push('after-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
    <script src="{{ asset('lte/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script>
        $('.wilaya_select').on('change' , function (event)
        {
            $.get($(event.target).find('option:selected').attr('dairas-url') , function (data)
            {
                let daira_select = $('select[name=daira]');
                daira_select.empty();
                data.forEach(function (daira){
                    daira_select.append(`<option value="${daira.id}">${daira.name}</option>`)
                })
            } , 'json')
        })

        $('select[name=wilaya_id]').on('change' , function (event)
        {
            $.get($(event.target).find('option:selected').attr('dairas-url') , function (data)
            {
                let daira_select = $('select[name=daira_id]');
                daira_select.empty();
                daira_select.append(`<option value="*">All</option>`)
                data.forEach(function (daira){
                    daira_select.append(`<option value="${daira.id}">${daira.name}</option>`)
                })
            } , 'json')
        })

        $('#campaign').on('change' , function (event)
        {
            if ($(event.target).is(':checked'))
                $('.campaign-started-at').css('display' , 'block')
            else
                $('.campaign-started-at').css('display' , 'none')

        })

        $('input[type="text"][name=created_at]').daterangepicker({
            maxDate:moment().startOf('day'),
            startDate: @if(request()->get('created_at')) {{ request()->get('created_at') }} @else moment().startOf('month').subtract(10, 'months') @endif,
            ranges: {
                'Aujourdhui': [moment(), moment()],
                'Hier': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Derniers 7 jours': [moment().subtract(6, 'days'), moment()],
                'Derniers 30 jours': [moment().subtract(29, 'days'), moment()],
                'Ce mois': [moment().startOf('month'), moment().endOf('month')],
                'Dernier mois': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            showDropdowns:true,
            alwaysShowCalendars:true,
            onClose: function() {
                $(this).removeClass("hasDatepicker");
            }
        })

        @php
            $pattern = '/^[-+]?([1-8]?\d(\.\d+)?|90(\.0+)?),\s*[-+]?(180(\.0+)?|((1[0-7]\d)|([1-9]?\d))(\.\d+)?)$/';
        @endphp


        @foreach($articles as $article)
        var coordinates{{ $article->id }} = [{{ preg_match($pattern, $article->location) === 1  ? $article->location  : "" }}];

        var map{{ $article->id }} = L.map('map{{ $article->id }}').setView(coordinates{{ $article->id }}, 6);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map{{ $article->id }});

        // Add a marker for the coordinates
        L.marker(coordinates{{ $article->id }}).addTo(map{{ $article->id }})
            .bindPopup("{{ optional($article->user)->fname . ' | ' . optional($article->user)->lname }}")
            .openPopup();

        @endforeach



    </script>
@endpush






