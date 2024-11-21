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
                <li class="active">
                    <a href="{{ route('healthcare.get_voucher_page') }}"><i class="fa fa-money-bill"></i><span class="px-2">@lang('Billing')</span></a>
                </li>
                <li>
                    <form action="{{ route('logout_healthcare') }}" method="post">@csrf
                        <button  type="submit" style="font-weight: 500;font-size: 16px;color: #67748e;position: relative;display: flex;align-items: center;padding: 8px 15px;background: unset;border: 0;">
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
                <h3 class="page-title">@lang("Add Voucher")</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('healthcare.get_voucher_page') }}">@lang("Billing")</a></li>
                    <li class="breadcrumb-item active">@lang("Add Voucher")</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('healthcare.add_voucher_post') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">@lang("Remark or comment")</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control form-control-lg" placeholder="@lang("Write Something ...")" name="title">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">@lang("Pricing")</label>
                            <div class="col-md-10">
                                <select name="pricing_id" class="form-control" id="">
                                    @if($pricings->count())
                                        @foreach($pricings as $pricing)
                                            <option value="{{ $pricing->id }}">{{ $pricing->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">@lang("Your CCP Billing Voucher") ( @lang("Pdf file from BardiMob") )</label>
                            <div class="col-md-10">
                                <input type="file"  class="form-control" placeholder="Your CCP Billing Voucher" name="file">
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <a  class="btn btn-secondary btn-sm" href="{{ route('healthcare.get_voucher_page') }}">@lang("Cancel")</a>
                            <button type="submit" class="btn btn-sm btn-success">@lang("Send") </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
