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
                <li class="">
                    <a href="{{ route('healthcare.get_my_registrations_page') }}"><i class="fa fa-check"></i><span class="px-2">@lang("Registration")</span></a>
                </li>
                <li class="">
                    <a href="{{ route('healthcare.get_my_appointments_page') }}"><i class="fa fa-business-time"></i><span class="px-2">@lang("Appointment")</span></a>
                </li>
                @if($profile->type == 4)
                    <li>
                        <a href="{{ route('healthcare.get_my_medication_demandes_page') }}"><i class="fa fa-notes-medical"></i><span class="px-2"> @lang("Med-Demandes")</a>
                    </li>
                @endif
                <li class="active">
                    <a href="{{ route('healthcare.get_my_calendar_page') }}"><i class="fa fa-calendar"></i><span class="px-2">@lang("Calendar")</span></a>
                </li>
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
    <div class="row">
        <div class="col-lg-3 col-md-4">
            <h4 class="card-title">@lang("Today's events")</h4>
            <div id="calendar-events" class="mb-3">
                <div class="calendar-events" data-class="bg-info"><i class="fas fa-circle text-info"></i>@lang("My Appointments")</div>
                <div class="calendar-events" data-class="bg-success"><i class="fas fa-circle text-success"></i> @lang("My Registrations")</div>
            </div>
        </div>
        <div class="col-lg-9 col-md-8">
            <div class="card bg-white">
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('after-styles')
    <link rel="stylesheet" href="{{ asset('lte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('patient/assets/plugins/fullcalendar/fullcalendar.min.css') }}">
    <style>
        label
        {
            font-size:large !important;
        }
    </style>
@endpush
@push('after-scripts')
    <script src="{{ asset('patient/assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('patient/assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('patient/assets/plugins/fullcalendar/fullcalendar.min.js') }}"></script>
    <script>
        ! function($) {
            "use strict";
            var CalendarApp = function() {
                this.$body = $("body")
                this.$calendar = $('#calendar'), this.$event = ('#calendar-events div.calendar-events'), this.$categoryForm = $('#add_new_event form'), this.$extEvents = $('#calendar-events'), this.$modal = $('#my_event'), this.$saveCategoryBtn = $('.save-category'), this.$calendarObj = null
            };
            CalendarApp.prototype.onDrop = function(eventObj, date) {
                var $this = this;
                var originalEventObject = eventObj.data('eventObject');
                var $categoryClass = eventObj.attr('data-class');
                var copiedEventObject = $.extend({}, originalEventObject);
                copiedEventObject.start = date;
                if ($categoryClass)
                    copiedEventObject['className'] = [$categoryClass];
                $this.$calendar.fullCalendar('renderEvent', copiedEventObject, true);
                if ($('#drop-remove').is(':checked')) {
                    eventObj.remove();
                }
            }, CalendarApp.prototype.onEventClick = function(calEvent, jsEvent, view) {
                var $this = this;
                var form = $("<form></form>");
                form.append("<label>Change event name</label>");
                form.append("<div class='input-group'><input class='form-control' type=text value='" + calEvent.title + "' /><span class='input-group-append'><button type='submit' class='btn btn-success'><i class='fas fa-check'></i> Save</button></span></div>");
                $this.$modal.modal({
                    backdrop: 'static'
                });
                $this.$modal.find('.delete-event').show().end().find('.save-event').hide().end().find('.modal-body').empty().prepend(form).end().find('.delete-event').unbind('click').click(function() {
                    $this.$calendarObj.fullCalendar('removeEvents', function(ev) {
                        return (ev._id == calEvent._id);
                    });
                    $this.$modal.modal('hide');
                });
                $this.$modal.find('form').on('submit', function() {
                    calEvent.title = form.find("input[type=text]").val();
                    $this.$calendarObj.fullCalendar('updateEvent', calEvent);
                    $this.$modal.modal('hide');
                    return false;
                });
            }, CalendarApp.prototype.onSelect = function(start, end, allDay) {
                var $this = this;
                $this.$modal.modal({
                    backdrop: 'static'
                });
                var form = $("<form></form>");
                form.append("<div class='event-inputs'></div>");
                form.find(".event-inputs").append("<div class='form-group'><label class='control-label'>Event Name</label><input class='form-control' placeholder='Insert Event Name' type='text' name='title'/></div>").append("<div class='form-group'><label class='control-label'>Category</label><select class='form-control' name='category'></select></div>").find("select[name='category']").append("<option value='bg-danger'>Danger</option>").append("<option value='bg-success'>Success</option>").append("<option value='bg-purple'>Purple</option>").append("<option value='bg-primary'>Primary</option>").append("<option value='bg-info'>Info</option>").append("<option value='bg-warning'>Warning</option></div></div>");
                $this.$modal.find('.delete-event').hide().end().find('.save-event').show().end().find('.modal-body').empty().prepend(form).end().find('.save-event').unbind('click').click(function() {
                    form.submit();
                });
                $this.$modal.find('form').on('submit', function() {
                    var title = form.find("input[name='title']").val();
                    var beginning = form.find("input[name='beginning']").val();
                    var ending = form.find("input[name='ending']").val();
                    var categoryClass = form.find("select[name='category'] option:checked").val();
                    if (title !== null && title.length != 0) {
                        $this.$calendarObj.fullCalendar('renderEvent', {
                            title: title,
                            start: start,
                            end: end,
                            allDay: false,
                            className: categoryClass
                        }, true);
                        $this.$modal.modal('hide');
                    } else {
                        alert('You have to give a title to your event');
                    }
                    return false;
                });
                $this.$calendarObj.fullCalendar('unselect');
            }, CalendarApp.prototype.enableDrag = function() {
                $(this.$event).each(function() {
                    var eventObject = {
                        title: $.trim($(this).text())
                    };
                    $(this).data('eventObject', eventObject);
                    $(this).draggable({
                        zIndex: 999,
                        revert: true,
                        revertDuration: 0
                    });
                });
            }
            CalendarApp.prototype.init = function() {
                this.enableDrag();
                var date = new Date();
                var d = date.getDate();
                var m = date.getMonth();
                var y = date.getFullYear();
                var form = '';
                var today = new Date($.now());
                var defaultEvents = [
                        @if($registrations->count())
                        @foreach($registrations as $registration)
                    {
                        title: '{{ $registration->name }} | {{ $registration->phone }}',
                        start: new Date("{{ $registration->started_at }}"),
                        className: 'bg-success'
                    },
                        @endforeach
                        @endif
                @if($appoints->count())
                @foreach($appoints as $appoint)
                {
                    title: '{{ $appoint->name }} | {{ $appoint->phone }}',
                    start: new Date("{{ $appoint->started_at }}"),
                    className: 'bg-info'
                },
                @endforeach
                @endif

                ];
                var $this = this;
                $this.$calendarObj = $this.$calendar.fullCalendar({
                    slotDuration: '00:15:00',
                    minTime: '08:00:00',
                    maxTime: '19:00:00',
                    defaultView: 'month',
                    handleWindowResize: true,
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    events: defaultEvents,
                    editable: true,
                    droppable: true,
                    eventLimit: true,
                    selectable: true,
                    drop: function(date) {
                        $this.onDrop($(this), date);
                    },
                    select: function(start, end, allDay) {
                        $this.onSelect(start, end, allDay);
                    },
                    eventClick: function(calEvent, jsEvent, view) {
                        $this.onEventClick(calEvent, jsEvent, view);
                    }
                });
                this.$saveCategoryBtn.on('click', function() {
                    var categoryName = $this.$categoryForm.find("input[name='category-name']").val();
                    var categoryColor = $this.$categoryForm.find("select[name='category-color']").val();
                    if (categoryName !== null && categoryName.length != 0) {
                        $this.$extEvents.append('<div class="calendar-events" data-class="bg-' + categoryColor + '" style="position: relative;"><i class="fas fa-circle text-' + categoryColor + '"></i>' + categoryName + '</div>')
                        $this.enableDrag();
                    }
                });
            }, $.CalendarApp = new CalendarApp, $.CalendarApp.Constructor = CalendarApp
        }(window.jQuery),
            function($) {
                "use strict";
                $.CalendarApp.init()
            }(window.jQuery);
    </script>
@endpush



