@extends("front.healthcares.layout")

@php
    $dayes = ['monday' , 'tuesday'    , 'wednesday'  , 'thursday'   , 'friday'     , 'saturday'   , 'sunday' ];
@endphp

@section("sidebar")
    <ul>
        <li class="submenu-open">
            <h6 class="submenu-hdr">@lang("Main")</h6>
            <ul>
                <li class="">
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
                <li class="active">
                    <a href="{{ route('healthcare.get_my_opening_hours_page') }}"><i class="fa fa-calendar"></i><span class="px-2">@lang("Opening Hours")</span></a>
                </li>
                <li class="">
                    <a href="{{ route('healthcare.profile') }}"><i class="fa fa-user"></i><span class="px-2">@lang('Settings')</span></a>
                </li>
                <li class="">
                    <a href="{{ route('healthcare.get_voucher_page') }}"><i class="fa fa-money-bill"></i><span class="px-2">@lang('Billing')</span></a>
                </li>
                <li>
                    <form action="{{ route('logout_healthcare') }}" method="post">@csrf
                        <button  type="submit" style="font-weight: 500;font-size: 16px;color: #67748e;position: relative;display: flex;align-items: center;padding: 8px 15px;background: unset;border: 0;">
                            <i class="fa fa-door-open"></i>
                            <span class="px-2">@lang('Sign out')</span>
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
    <div class="card p-4">
        <form action="{{ route('healthcare.set_my_opening_hours') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 pb-2 mt-4 " >
                    <label for="">@lang("Close registrations until a specific day")</label>
                    <br>
                    <small>@lang("It must not be left empty or it will appear as closed for an unknown period of time")</small>
                    <input class="form-control" value="{{ $profile->open_registration_for_day }}" name="open_registration_for_day" type="date" min="{{ today()->format('Y-m-d') }}" placeholder="... minutes">
                </div>
                @if($profile->type != 4)
                    <div class="col-lg-4 col-md-6 col-sm-12 pb-2 mt-4 d-none">
                        <label for="">@lang("Time to open Registrations (a day before)")</label>
                        <br>
                        <small>@lang("Time to open Registrations (a day before)")</small>
                        <input value="{{ $profile->time_before_open_registration_for_day }}" name="time_before_open_registration_for_day" class="form-control" type="time"  placeholder="...">
                    </div>
                @endif
                <!--
                <div class="col-lg-4 col-md-6 col-sm-12 pb-2 mt-4">
                    <label for="">@lang("Closed for a reason of")</label>
                    <br>
                    <small>@lang("it has to be filled where there is no opening registration day")</small>
                    <input class="form-control" name="closure_reason" value="{{ $profile->closure_reason }}" type="text" placeholder="... our registrations for tommorrow is closed beceause of ">
                </div>
                -->
                <!-------------------------------------------->
                <div class="col-lg-4 col-md-6 col-sm-12 pb-2 mt-4">
                    <label for="">@lang("Closed for a reason of")</label>
                    <br>
                    <small>@lang("it has to be filled where there is no opening registration day")</small>
                    <select class="form-control" name="closure_reason">
                        <option value="Outside working hours">@lang("Outside working hours")</option>
                        <option value="Sick holiday">@lang("Sick holiday")</option>
                        <option value="Take a vacation">@lang("Take a vacation")</option>
                        <option value="The doctor is traveling">@lang("The doctor is traveling")</option>
                        <option value="Attend a forum">@lang("Attend a forum")</option>
                        <option value="Participation in a seminar">@lang("Participation in a seminar")</option>
                        <option value="Unspecified reason">@lang("Unspecified reason")</option>
                        <option value="private conditions">@lang("private conditions")</option>
                        <option value="other reasons">@lang("other reasons")</option>
                    </select>
                </div>
                <!-------------------------------------------->

                @if($profile->type != 4)
                <div class="col-lg-4 col-md-6 col-sm-12 pb-2 mt-4">
                    <label for="">@lang("Average duration allocated to the patient (minutes)")</label>
                    <br>
                    <small> @lang('will be auto-changed according to the time passed with a patient')</small>
                    <input value="{{ $profile->average_patient_time }}" name="average_patient_time" class="form-control" type="number" min="0" max="60" step="any" placeholder="... minutes">
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 pb-2 mt-4">
                    <label for="">@lang("Limit patient registrations per day")</label>
                    <br>
                    <small>@lang("leave it empty if you won't limit registrations")</small>
                    <input  name="limit_patient" value="{{ $profile->limit_patient }}" class="form-control" type="number" placeholder="... number ">
                </div>
                @else
                <div class="col-lg-4 col-md-6 col-sm-12 pb-2 mt-4">
                    <label for="">@lang("Accept payement")</label>
                    <br>
                    @if(!empty(json_decode($profile->payments)) and is_array(json_decode($profile->payments)))
                        @php
                            $selected_payments = json_decode($profile->payments);
                       @endphp
                    @else
                        @php
                            $selected_payments = [];
                        @endphp
                    @endif
                    <select  class="form-control" multiple name="payments[]" id="">
                        <option @if(in_array('cash' , $selected_payments)) selected @endif value="cash">@lang("espèce")</option>
                        <option @if(in_array('chifa' , $selected_payments)) selected @endif value="chifa">@lang("Carte Chifa")</option>
                        <option @if(in_array('dahabia' , $selected_payments)) selected @endif value="dahabia">@lang("E-lDahabia")</option>
                        <option @if(in_array('baridimob' , $selected_payments)) selected @endif value="baridimob">@lang("Baridimob")</option>
                        <option @if(in_array('cib' , $selected_payments)) selected @endif value="cib">@lang("CIB")</option>
                        <option @if(in_array('assurance-militaire' , $selected_payments)) selected @endif value="assurance-militaire">@lang('assurance-militaire')</option>
                    </select>
                </div>
                @endif
                <hr class="w-100 mt-4">
                <div class="col-lg-4 col-md-6 col-sm-12 pb-2 mt-4">
                    <label for="">@lang("Opening Hours")</label>
                    <br>
                    <small>@lang("(Opening hours to be displayed in Profile Details)")</small>
                    <input  name="opening_hours_display" value="08:00 - 12:00 / 13:00 - 16:30" class="form-control" type="text" placeholder="@lang("Example:") 08:00 - 12:00 / 13:00 - 16:30">
                </div><!--{{ $profile->opening_hours_display }}-->
                <hr class="w-100 mt-4">
            </div>

        <span class="btn btn-sm btn-info apply-to-all-days text-white fw-bolder mb-3">@lang("Apply to All dayes")</span>
        @foreach($dayes as $day)
            @php
                $day_exists = ($schedule != null and array_key_exists($day , $schedule) and count($schedule[$day]))
            @endphp
            <div class="row">
                <div class="col-4 pb-2 mt-4 text-center">
                    <div class="icheck-primary form-group">
                        <input id="{{ $day }}check" type="checkbox" @if($day_exists) checked @endif  name="opening_hours[{{$day}}][checked]">
                        <label for="{{ $day }}check">{{ __($day) }}</label>
                    </div>
                </div>
                <div class="col-4 pb-2 form-group">
                    <small>@lang("start")</small>
                    <input type="time" value="@if($day_exists){{ explode("-" , $schedule[$day][0])[0] }}@else{{ "08:00" }}@endif" required class="form-control time-start"  name="opening_hours[{{ $day }}][start]">
                </div>
                <div class="col-4 pb-2 form-group">
                    <small>@lang("ends")</small>
                    <input type="time" value="@if($day_exists){{  explode("-" , $schedule[$day][0])[1] }}@else{{ "17:00" }}@endif" required class="form-control time-end"  name="opening_hours[{{ $day }}][end]">
                </div>
            </div>
        @endforeach

        <button type="submit" class="btn btn-sm btn-success">@lang("Save changes")</button>
        </form>
    </div>

@endsection

@push('after-styles')
    <link rel="stylesheet" href="{{ asset('lte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <style>
        label
        {
            font-size:large !important;
        }
    </style>
@endpush
@push('after-scripts')
    <script>
        $('.apply-to-all-days').on('click' , function ()
        {
            $('input.time-start').each(function (key,item)
            {
                $(item).val($('input.time-start:first').val());
            });
            $('input.time-end').each(function (key,item)
            {
                $(item).val($('input.time-end:first').val());
            });
        })
    </script>
@endpush



