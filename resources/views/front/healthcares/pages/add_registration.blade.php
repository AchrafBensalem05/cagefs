@extends("front.healthcares.layout")


@section("sidebar")
    <ul>
        <li class="submenu-open">
            <h6 class="submenu-hdr">@lang("Main")</h6>
            <ul>
                <li class="active">
                    <a href="{{ route('healthcare.dashboard') }}"><i class="fa fa-columns"></i><span class="px-2">@lang("Dashboard")</span></a>
                </li>
                @if($profile->type != 4)
                    <li class="">
                        <a href="{{ route('healthcare.get_my_registrations_page') }}"><i class="fa fa-check"></i><span class="px-2">@lang("Registration")</span></a>
                    </li>
                    <li class="">
                        <a href="{{ route('healthcare.get_my_appointments_page') }}"><i class="fa fa-business-time"></i><span class="px-2">@lang("Appointment")</span></a>
                    </li>

                    <li class="">
                        <a href="{{ route('healthcare.get_my_calendar_page') }}"><i class="fa fa-calendar"></i><span class="px-2">@lang("Calendar")</span></a>
                    </li>
                @endif
                <li class="">
                    <a  target="_blank" href="{{ route('healthcare-chat') }}"><i class="fa fa-mail-bulk"></i><span class="px-2">@lang("Healthcare Chat")</span></a>
                </li>
                <li class="">
                    <a href="{{ route('healthcare.get_my_chat_page') }}"><i class="fa fa-envelope"></i><span class="px-2">@lang("Patients Chat")</span></a>
                </li>
                <li class="">
                    <a href="{{ route('healthcare.get_my_opening_hours_page') }}"><i class="fa fa-calendar"></i><span class="px-2">@lang("Opening Hours")</span></a>
                </li>
                <li class="">
                    <a href="{{ route('healthcare.profile') }}"><i class="fa fa-user"></i><span class="px-2">@lang('Settings')</span></a>
                </li>
                <li class="">
                    <a href="{{ route('healthcare.get_voucher_page') }}"><i class="fa fa-money-bill"></i><span class="px-2">@lang('Billing')</span></a>
                </li>
                <li>
                    <form action="{{ route('logout_healthcare') }}" method="post">
                        @csrf
                        <button style="font-weight: 500;font-size: 16px;color: #67748e;position: relative;display: flex;align-items: center;padding: 8px 15px;background: unset;border: 0;" type="submit">
                            <i class="fa fa-door-open"></i>
                            <span class="px-2">@lang("Sign Out")</span>
                        </button>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
@endsection
@section('content')

    <div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">@lang("Add Registration")</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">@lang("Passing registrations")</a></li>
                    <li class="breadcrumb-item active">@lang("Add Registration")</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('healthcare.add_registration_post') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">@lang("Full name")</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control form-control-lg" placeholder="@lang("Full name")" name="name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">@lang("Phone number")</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="@lang("Phone number")" name="phone" required>
                            </div>
                        </div>
                        <div class="form-group mb-0 row">
                            <label class="col-form-label col-md-2">@lang("Service")</label>
                            <div class="col-md-10">
                                <select name="service_id" class="form-control" id="">
                                    @if($services->count())
                                        @foreach($services as $serivce)
                                            <option value="{{ $serivce->id }}">{{ $serivce->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <a  class="btn btn-secondary btn-sm" href="{{ route('healthcare.dashboard') }}">@lang("Cancel")</a>
                                <button type="submit" class="btn btn-sm btn-success">@lang("Save Registration")</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
