@extends("front.healthcares.layout")


@section("sidebar")
    <ul>
        <li class="submenu-open">
            <h6 class="submenu-hdr">@lang("main")</h6>
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
                    <form action="{{ route('logout_healthcare') }}" method="post">@csrf
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
    <div class="dashboard"> 
      
        <div class="card-statistics"> 
            <div class="cards registrement"> 
                <a  class="card-icon"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.25em" height="1em" viewBox="0 0 640 512"><path fill="#fff" d="M192 256c61.9 0 112-50.1 112-112S253.9 32 192 32S80 82.1 80 144s50.1 112 112 112m76.8 32h-8.3c-20.8 10-43.9 16-68.5 16s-47.6-6-68.5-16h-8.3C51.6 288 0 339.6 0 403.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-28.8c0-63.6-51.6-115.2-115.2-115.2M480 256c53 0 96-43 96-96s-43-96-96-96s-96 43-96 96s43 96 96 96m48 32h-3.8c-13.9 4.8-28.6 8-44.2 8s-30.3-3.2-44.2-8H432c-20.4 0-39.2 5.9-55.7 15.4c24.4 26.3 39.7 61.2 39.7 99.8v38.4c0 2.2-.5 4.3-.6 6.4H592c26.5 0 48-21.5 48-48c0-61.9-50.1-112-112-112"/></svg>  
                </a> 
                <div class="card-ttl">@lang("registration")</div> 
                <div class="regist-calc"> 
                    <span class="sou-ttl">@lang("All") :</span> 
                    <span class="total-nbr">{{ $registrations ? $registrations->count() : 0 }}</span> 
                </div> 
                <div class="regist-calc"> 
                    <span class="sou-ttl">@lang("Done") :</span> 
                    <span class="done-nbr">{{ $registrations ? $registrations->where('status' , 'done')->count() : 0 }}</span> 
                </div> 
            </div> 
            <div class="cards appointtement"> 
                <a  class="card-icon"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 20 20"><path fill="white" d="M17 5.5A2.5 2.5 0 0 0 14.5 3h-9A2.5 2.5 0 0 0 3 5.5V6h14zm0 4.1V7H3v7.5A2.5 2.5 0 0 0 5.5 17h4.1A5.5 5.5 0 0 1 17 9.6M14.5 19a4.5 4.5 0 1 0 0-9a4.5 4.5 0 0 0 0 9m-.5-6.5a.5.5 0 0 1 1 0V14h1a.5.5 0 0 1 0 1h-1.5a.5.5 0 0 1-.5-.5z"/></svg> 
                </a> 
                <div class="card-ttl">@lang("appointtement")</div> 
                <div class="regist-calc"> 
                    <span class="sou-ttl">@lang("All") :</span> 
                    <span class="total-nbr">{{ $registrations ? $registrations->where('type' , 'appointment')->count() : 0 }}</span> 
                </div> 
                <div class="regist-calc"> 
                    <span class="sou-ttl">@lang("Done") :</span> 
                    <span class="done-nbr">0</span> 
                </div> 
            </div> 
            <div class="cards close-table"> 
                <a href="{{ route('healthcare.close_registrations_for_day') }}"  class="card-icon"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="0.88em" height="1em" viewBox="0 0 448 512"><path fill="white" d="M48 32C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48zm176.195 64c47.176 0 85.559 38.383 85.559 85.56v80.46c9.589 15.431 15.137 33.624 15.137 53.091C324.89 370.736 279.63 416 224 416c-55.627 0-100.892-45.264-100.892-100.889c0-19.728 5.698-38.15 15.526-53.715v-79.835c0-47.178 38.386-85.561 85.56-85.561m0 34.264c-28.281 0-51.295 23.011-51.295 51.297v46.59c14.998-8.848 32.467-13.932 51.102-13.932c18.796 0 36.405 5.171 51.488 14.16V181.56c0-28.286-23.013-51.297-51.295-51.297m-.193 118.22c-36.737 0-66.629 29.889-66.629 66.627c0 36.735 29.892 66.627 66.629 66.627c36.736 0 66.621-29.892 66.621-66.627c0-36.738-29.885-66.627-66.621-66.627m.328 38.657c15.613 0 28.268 12.657 28.268 28.275c0 15.61-12.655 28.264-28.268 28.264c-15.612 0-28.268-12.655-28.268-28.264c0-15.618 12.656-28.275 28.268-28.275"/></svg> 
                </a> 
                <div class="card-ttl">@lang("Finish today")</div> 
                <div class="cls-tbl-txt"> 
                    <span class="sou-ttl">@lang("close registration for today") <span class="sou-sou-ttl">@lang("and go to the next day") </span></span> 
                     
                </div> 
            </div> 
            <div class="cards opening-status"> 
                    <div class="status-dv"> 
                        @if($profile->closed_in_date != null and $profile->closed_in_date == \Carbon\Carbon::now()->toDateString())
                            <a href="{{ route("healthcare.toggle_status") }}" class="status-icon" style="background-image: linear-gradient(195deg,#ec407a,#d81b60);"> 
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="white" d="M2.998 21v-2h2V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v15h2v2zm12-10h-2v2h2z"/></svg>
                            </a> 
                            <div class="status-ttl"> 
                                <span class="status-title"> 
                                    @lang("Status") 
                                </span> 
                                <span class="status" style="color:#d81b60;">closed</span> 
                            </div>
                        @else
                            <a href="{{ route("healthcare.toggle_status") }}" class="status-icon"> 
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="white" d="M1.998 21v-2h2V4.835a1 1 0 0 1 .821-.984l9.472-1.722a.6.6 0 0 1 .707.59V4h4a1 1 0 0 1 1 1v14h2v2h-4V6h-3v15h-13Zm10-10h-2v2h2v-2Z"/></svg>
                            </a> 
                            <div class="status-ttl"> 
                                <span class="status-title"> 
                                    @lang("Status") 
                                </span> 
                                <span class="status">open</span> 
                            </div>
                        @endif
                    </div> 
                    <div class="card-clk" style="left:0; position:relative"> 
                        <iframe src="https://www.tickcounter.com/widget/clock/40970" style="top:0; left:0; width:100%; height:100%; position:absolute; border:0; overflow:hidden" title="Time In Algiers"></iframe> 
                    </div>
            </div>
        </div>
        </div> 
 
        <div class="tbl-cmnd-btns setvaluecash"> 
            <button  href="javascript:void(0);" class="paymentmethod text-danger pass-registration-btn btn done-btn"  data-id="{{ $registrations ? optional($registrations->where('current' , 'yes' )->first())->id ?? optional($registrations->first())->id : "" }}"> 
                <span class="btn-ttl">@lang("Pass")</span> 
                <span class="btn-ttl">@lang("Session")</span> 
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 48 48"><path fill="#01bfa6" fill-rule="evenodd" stroke="#01bfa6" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="m4 24l5-5l10 10L39 9l5 5l-25 25z" clip-rule="evenodd"/></svg> 
            </button> 
            <button  href="javascript:void(0);" class="paymentmethod text-danger delay-registration-btn btn delay-btn"> 
                <span class="btn-ttl">@lang("Delay")</span> 
                <span class="btn-ttl">@lang("Session")</span> 
                <svg xmlns="http://www.w3.org/2000/svg" width="0.75em" height="1em" viewBox="0 0 400 600"><path fill="#0073e6" d="M32 0C14.3 0 0 14.3 0 32s14.3 32 32 32v11c0 42.4 16.9 83.1 46.9 113.1l67.8 67.9l-67.8 67.9C48.9 353.9 32 394.6 32 437v11c-17.7 0-32 14.3-32 32s14.3 32 32 32h320c17.7 0 32-14.3 32-32s-14.3-32-32-32v-11c0-42.4-16.9-83.1-46.9-113.1L237.3 256l67.9-67.9c30-30 46.9-70.7 46.9-113.1V64c17.7 0 32-14.3 32-32s-14.3-32-32-32H64zm256 437v11H96v-11c0-25.5 10.1-49.9 28.1-67.9l67.9-67.8l67.9 67.9c18 18 28.1 42.4 28.1 67.9z"/></svg> 
            </button> 
            <button  href="javascript:void(0);" class="paymentmethod text-danger bypass-registration-btn btn bypass-btn"> 
                <span class="btn-ttl">@lang("ByPass")</span> 
                <span class="btn-ttl">@lang("Session")</span> 
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><g fill="none" stroke="#7c3c98" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"><path d="M16 12H3m13-6H3m7 12H3M21 6v10a2 2 0 0 1-2 2h-5"/><path d="m16 16l-2 2l2 2"/></g></svg> 
            </button> 
            <button  href="javascript:void(0);" class="paymentmethod text-danger cancel-registration-btn btn cancel-btn"> 
                <span class="btn-ttl">@lang("Cancel")</span> 
                <span class="btn-ttl">@lang("Session")</span> 
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="#d85459" d="M20 6.91L17.09 4L12 9.09L6.91 4L4 6.91L9.09 12L4 17.09L6.91 20L12 14.91L17.09 20L20 17.09L14.91 12z"/></svg> 
            </button> 
            <button class="btn btn2 add-appoint-btn"> 
                <a class="btn-ttl">@lang("Add appointtement")</a> 
            </button> 
            <button class="btn btn2 add-regist-btn"> 
                <a href="{{ route('healthcare.add_registration') }}" class="btn-ttl">@lang("Add registration")</a> 
            </button> 
             
        </div> 
         
        <div class="card">
                <div class="card-header  d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0" style="font-size:20px;" >@lang("Registrations List")</h4>
                    <div id="stopwatch">
                        <h6 id="display">00:00:00</h6>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-nowrap mb-0">
                        <thead>
                        <th>@lang("name")</th>
                        <th>@lang("phone")</th>
                        <th>@lang("status")</th>
                        <th>@lang("added from")</th>
                        <th>@lang("Anonyme")</th>
                        <th>@lang("started at")</th>
                        <th>@lang("service")</th>
                        </thead>
                        <tbody>
                        @if($registrations and $registrations->count())
                            @foreach($registrations as $registration)
                                <tr>
                                    <td>{{ $registration->name }} @if($registration->current == 'yes')<small class="badge bg-dark">@lang("current")</small>@endif</td>
                                    <td>{{ $registration->phone }}</td> 
                                    <td>
                                        @if($registration->status == "done")
                                            <span class="badge bg-success">@lang("Completed")</span>
                                        @elseif($registration->status == "pending")
                                            <span class="badge bg-warning">@lang("Pending")</span>
                                        @else
                                            <span class="badge bg-danger">@lang("Canceled")</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($registration->added_by)
                                            <span class="text-primary">@lang("admin")</span>
                                        @else
                                            <span class="text-success">@lang("Platform")</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($registration->patient_id)
                                            <span class="badge bg-dark">@lang("Authenticated")</span>
                                        @else
                                            <span class="badge bg-primary">@lang("Anonyme")</span>
                                        @endif
                                    </td>
                                    <td>{{ $registration->started_at }}</td>
                                    <td><span class="badge bg-info">{{ optional($registration->service)->title }}</span></td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div> 
         
        <div class="tbl-cmnd-btns btm-tbl-cmnd-btns setvaluecash"> 
            <button  href="javascript:void(0);" class="paymentmethod text-danger pass-registration-btn btn done-btn"  data-id="{{ $registrations ? optional($registrations->where('current' , 'yes' )->first())->id ?? optional($registrations->first())->id : "" }}"> 
                <span class="btn-ttl">@lang("Pass")</span> 
                <span class="btn-ttl">@lang("Session")</span> 
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 48 48"><path fill="#01bfa6" fill-rule="evenodd" stroke="#01bfa6" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="m4 24l5-5l10 10L39 9l5 5l-25 25z" clip-rule="evenodd"/></svg> 
            </button> 
            <button  href="javascript:void(0);" class="paymentmethod text-danger delay-registration-btn btn delay-btn"> 
                <span class="btn-ttl">@lang("Delay")</span> 
                <span class="btn-ttl">@lang("Session")</span> 
                <svg xmlns="http://www.w3.org/2000/svg" width="0.75em" height="1em" viewBox="0 0 400 600"><path fill="#0073e6" d="M32 0C14.3 0 0 14.3 0 32s14.3 32 32 32v11c0 42.4 16.9 83.1 46.9 113.1l67.8 67.9l-67.8 67.9C48.9 353.9 32 394.6 32 437v11c-17.7 0-32 14.3-32 32s14.3 32 32 32h320c17.7 0 32-14.3 32-32s-14.3-32-32-32v-11c0-42.4-16.9-83.1-46.9-113.1L237.3 256l67.9-67.9c30-30 46.9-70.7 46.9-113.1V64c17.7 0 32-14.3 32-32s-14.3-32-32-32H64zm256 437v11H96v-11c0-25.5 10.1-49.9 28.1-67.9l67.9-67.8l67.9 67.9c18 18 28.1 42.4 28.1 67.9z"/></svg> 
            </button> 
            <button  href="javascript:void(0);" class="paymentmethod text-danger bypass-registration-btn btn bypass-btn"> 
                <span class="btn-ttl">@lang("ByPass")</span> 
                <span class="btn-ttl">@lang("Session")</span> 
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><g fill="none" stroke="#7c3c98" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"><path d="M16 12H3m13-6H3m7 12H3M21 6v10a2 2 0 0 1-2 2h-5"/><path d="m16 16l-2 2l2 2"/></g></svg> 
            </button> 
            <button  href="javascript:void(0);" class="paymentmethod text-danger cancel-registration-btn btn cancel-btn"> 
                <span class="btn-ttl">@lang("Cancel")</span> 
                <span class="btn-ttl">@lang("Session")</span> 
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="#d85459" d="M20 6.91L17.09 4L12 9.09L6.91 4L4 6.91L9.09 12L4 17.09L6.91 20L12 14.91L17.09 20L20 17.09L14.91 12z"/></svg> 
            </button> 
            <div class="cards close-table"> 
 
                <a href="{{ route('healthcare.close_registrations_for_day') }}" class="card-icon"> 
 
                    <svg xmlns="http://www.w3.org/2000/svg" width="0.88em" height="1em" viewBox="0 0 448 512"><path fill="white" d="M48 32C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48zm176.195 64c47.176 0 85.559 38.383 85.559 85.56v80.46c9.589 15.431 15.137 33.624 15.137 53.091C324.89 370.736 279.63 416 224 416c-55.627 0-100.892-45.264-100.892-100.889c0-19.728 5.698-38.15 15.526-53.715v-79.835c0-47.178 38.386-85.561 85.56-85.561m0 34.264c-28.281 0-51.295 23.011-51.295 51.297v46.59c14.998-8.848 32.467-13.932 51.102-13.932c18.796 0 36.405 5.171 51.488 14.16V181.56c0-28.286-23.013-51.297-51.295-51.297m-.193 118.22c-36.737 0-66.629 29.889-66.629 66.627c0 36.735 29.892 66.627 66.629 66.627c36.736 0 66.621-29.892 66.621-66.627c0-36.738-29.885-66.627-66.621-66.627m.328 38.657c15.613 0 28.268 12.657 28.268 28.275c0 15.61-12.655 28.264-28.268 28.264c-15.612 0-28.268-12.655-28.268-28.264c0-15.618 12.656-28.275 28.268-28.275"/></svg> 
                </a> 
                <div class="card-ttl">@lang("Finish today")</div> 
                <div class="cls-tbl-txt"> 
                    <span class="sou-ttl">@lang("close registration for") <span class="sou-sou-ttl" style="font-weight:600;">{{ $profile->open_registration_for_day }}</span> @lang("and go to the next day")</span> 
                     
                </div> 
            </div> 
             
        </div> 
    </div>
@endsection

@push('after-styles')
    <link rel="stylesheet" href="{{ asset('lte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('patient/assets/plugins/toastr/toatr.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/dashboard-d.css') }}">
    <style>
        #stopwatch {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        #display {
            font-size: 20px;
            margin-bottom: 5px;
        }
    </style>
@endpush
@push('after-scripts')
    <script src="{{ asset('patient/assets/plugins/toastr/toastr.min.js') }}"></script>
    <script>
        (function(d, s, id) { var js, pjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = "//www.tickcounter.com/static/js/loader.js"; pjs.parentNode.insertBefore(js, pjs); }(document, "script", "tickcounter-sdk"));

        $(document).ready(function () {
            var timer;
            var isRunning = false;
            var seconds = 0;

            function displayTime() {
                var hours = Math.floor(seconds / 3600);
                var minutes = Math.floor((seconds % 3600) / 60);
                var secs = seconds % 60;

                $('#display').text(
                    (hours < 10 ? '0' : '') + hours + ':' + (minutes < 10 ? '0' : '') + minutes + ':' + (secs < 10 ? '0' : '') + secs
                );
            }

            function startStopwatch() {
                timer = setInterval(function () {
                    seconds++;
                    displayTime();
                }, 1000);
            }

            function stopStopwatch() {
                clearInterval(timer);
            }

            function resetStopwatch() {
                stopStopwatch();
                seconds = 0;
                displayTime();
            }


            $(document).ready(function (){
                resetStopwatch();
                startStopwatch();
            })

            $('.pass-registration-btn').on('click' , function (e)
            {
                $.ajax({
                    type:'POST',
                    headers:{'X-CSRF-Token': '{{ csrf_token() }}'},
                    contentType: "application/json",
                    dataType: "json",
                    data:JSON.stringify(
                        {
                            time: $('#display').text(),
                            id: $(".pass-registration-btn").data('id')
                        }),
                    url:"{{ route('healthcare.pass_registration') }}",
                    success:function (data)
                    {
                        if (data == true)
                        {
                            toastr.success('@lang("patient session is done !")')
                            setTimeout(function (){
                                location.reload()
                            } , 1000);

                        }
                        else
                        {
                            toastr.warning('lang("patient session is note done !")')
                        }
                    }

                })
            })

            $('.bypass-registration-btn').on('click' , function (e)
            {
                if(confirm('do you confirm this action ? '))
                {
                    $.ajax({
                        type:'POST',
                        headers:{'X-CSRF-Token': '{{ csrf_token() }}'},
                        contentType: "application/json",
                        dataType: "json",
                        url:"{{ route('healthcare.bypass_registration') }}",
                        success:function (data)
                        {
                            if (data == true)
                            {
                                toastr.success('patient session is bypassed !')
                                setTimeout(function ()
                                {
                                    location.reload();
                                },1000 );

                            }
                            else
                            {
                                toastr.warning('patient session is failed to bypass')
                            }
                        }

                    })
                }
            })

            $('.delay-registration-btn').on('click' , function (e)
            {
                if(confirm('do you confirm this action ? '))
                {
                    $.ajax({
                        type:'POST',
                        headers:{'X-CSRF-Token': '{{ csrf_token() }}'},
                        contentType: "application/json",
                        dataType: "json",
                        url:"{{ route('healthcare.delay_registration') }}",
                        success:function (data)
                        {
                            if (data == true)
                            {
                                toastr.success('patient session is delayed !')
                                setTimeout(function ()
                                {
                                    location.reload();
                                },1000 );

                            }
                            else
                            {
                                toastr.warning('patient session is failed to delayed')
                            }
                        }

                    })
                }
            })


            $('.cancel-registration-btn').on('click' , function (e)
            {
                if(confirm('do you confirm this action ? '))
                {
                    $.ajax({
                        type:'POST',
                        headers:{'X-CSRF-Token': '{{ csrf_token() }}'},
                        contentType: "application/json",
                        dataType: "json",
                        url:"{{ route('healthcare.cancel_registration') }}",
                        success:function (data)
                        {
                            if (data == true)
                            {
                                toastr.success('patient session is canceled !')
                                setTimeout(function ()
                                {
                                    location.reload();
                                },1000);

                            }
                            else
                            {
                                toastr.warning('patient session is failed to cancel')
                            }
                        }

                    })
                }
            })
        });
    </script>



@endpush


