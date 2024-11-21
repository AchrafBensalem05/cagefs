@extends("front.patients.layout")


@section("sidebar")
    <ul>
        <li class="submenu-open">
            <h6 class="submenu-hdr">Main</h6>
            <ul>
                <li class="">
                    <a href="{{ route('patient.dashboard') }}"><i class="fa fa-columns"></i><span class="px-2">@lang("Dashboard")</span></a>
                </li>
                <li class="active">
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
    <div class="page-header">
        <div class="page-title">
            <h4>{{ $title }}</h4>
        </div>
    </div>
    <div class="card">
            <div class="card-body">
                <div class="profile-set">
                    <div class="profile-head" style="background: url({{ $entity->getFirstMediaUrl('background' , 'sized')  }})"></div>
                    <div class="profile-top">
                        <div class="profile-content">
                            <div class="profile-contentimg">
                                <img src="{{ $entity->getFirstMediaUrl('avatar' , 'thumb') }}" alt="img" id="blah">
                            </div>
                            <div class="profile-contentname">
                                <h2>{{ $title }}</h2>
                                <h4>
                                    @if($entity->services->count())
                                        @foreach($entity->services as $service)
                                          {{ $service->title }} ,
                                        @endforeach
                                    @endif
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                  <div class="col-md-6 col-sm-12">
                        <p class="fw-bold">{{ $entity->description }}</p>
                  </div>
                    <div class="col-md-6 col-sm-12">
                        @if($entity->is_open_now == "closed")
                            <h3 class="badge bg-danger">Currently Closed</h3>
                            <br>
                            <span class="text-dark">reopening date :</span>
                            <span class="badge bg-success">{{$entity->next_open}}</span>
                        @else
                            <h3 class="badge bg-success">Open</h3>
                        @endif
                    </div>
                </div>
            </div>
    </div>

@endsection



