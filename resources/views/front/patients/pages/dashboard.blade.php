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


@endsection
