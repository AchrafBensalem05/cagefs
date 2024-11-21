@extends("front.patients.layout")


@section("sidebar")
    <ul>
        <li class="submenu-open">
            <h6 class="submenu-hdr">Main</h6>
            <ul>
                <li class="">
                    <a href="{{ route('patient.dashboard') }}"><i class="fa fa-columns"></i><span class="px-2">@lang("Dashboard")</span></a>
                </li>
                <li class="">
                    <a href="{{ route('patient.profile') }}"><i class="fa fa-user"></i><span class="px-2">@lang("My Profile")</span></a>
                </li>
                <li class="active">
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
            <h2>{{ $title }}</h2>
        </div>
    </div>
    <div class="card">

        <div class="card-body">
            <div class="table-top">
                <div class="search-set">
                    <div class="search-path">
                        <a class="btn btn-filter" id="filter_search">
                            <img src="{{ asset('patient/assets/img/icons/filter.svg') }}" alt="img">
                            <span><img src="{{ asset('patient/assets/img/icons/closes.svg') }}" alt="img"></span>
                        </a>
                    </div>
                    <div class="search-input">
                        <a class="btn btn-searchset"><img src="{{ asset('patient/assets/img/icons/search-white.svg') }}" alt="img"></a>
                    </div>
                </div>
                <div class="wordset">

                </div>
            </div>
            <div class="card mb-0" id="filter_inputs">
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="row">
                                <div class="col-lg col-sm-6 col-12 filters">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-4 col-lg-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control filter" name="created_at">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3">
                                            <div class="form-group">
                                                <select class="form-control filter" name="status" id="" >
                                                    <option value="" selected >@lang("Status of post")</option>
                                                    <option value="active">@lang("active")</option>
                                                    <option value="canceled">@lang("canceled")</option>
                                                    <option value="done">@lang("done")</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-12">
                                    <div class="form-group">
                                        <a class="btn btn-filters ms-auto"><img src="{{ asset('patient/assets/img/icons/search-whites.svg') }}" alt="img"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                {{ $appointment_datatable->table(['class' => "table table-sm table-bordered table-striped"])  }}
            </div>
        </div>
    </div>



    <div class="modal fade" id="patient-article-status-change"  tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" method="post" id="patient-article-status-change-form">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">@lang("Change status of this post")</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <select name="status"  class="form-control" id="">
                            <option value="" selected disabled>@lang("Select the new status of your post")</option>
                            <option value="active">@lang('Still Active')</option>
                            <option value="canceled">@lang('I Want to Cancel this post ')</option>
                            <option value="done">@lang('The post is successfully done')</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button class="submit-anchor btn btn-success">@lang("Apply")</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang("Close")</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="patient-article-pin-change"  tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" method="post" id="patient-article-pin-change-form">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">@lang("Change status of this post")</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="pinned-content"></div>

                        <div class="container mt-4">
                            <div class="row">
                                <div class="form-check col text-center">
                                    <input class="form-check-input" type="radio" name="pin" value="active" id="active-radio" checked>
                                    <label class="form-check-label fw-bolder" for="active-radio">
                                        @lang("Keep it Active")
                                    </label>
                                </div>
                                <div class="form-check col text-center">
                                    <input class="form-check-input" type="radio" name="pin" value="pinned" id="pinned-radio" >
                                    <label class="form-check-label fw-bolder" for="pinned-radio">
                                        @lang("Confirm pinning")
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="submit-anchor btn btn-success">@lang("Apply")</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang("Close")</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection

@push('after-styles')
    <link rel="stylesheet" href="{{ asset('lte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/daterangepicker/daterangepicker.css') }}">
@endpush
@push('after-scripts')
    <script src="{{ asset('lte/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset("lte/plugins/select2/js/select2.full.min.js") }}"></script>
    <script>
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        $('#wilaya_select').on('change' , function (event) {
            $.get($(event.target).find('option:selected').attr('dairas-url') , function (data)
            {
                let daira_select = $('select[name=daira_id]');
                daira_select.empty()
                data.forEach(function (daira){
                    daira_select.append(`<option value="${daira.id}">${daira.name}</option>`)
                })
            } , 'json')
        })


        $('input[type="text"][name=created_at]').daterangepicker({
            maxDate:moment().startOf('day'),
            startDate: moment().startOf('month').subtract(10, 'months'),
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

        $('.filter').on('change', function (event) {
            window.LaravelDataTables["article-table"].ajax.reload();
        })

        $('#patient-article-status-change').on('show.bs.modal', function (e) {
            let btn = $(e.relatedTarget);
            let url = btn.data('url');
            $(this).find("#patient-article-status-change-form").attr('action' , url);
        })

        $('#patient-article-pin-change').on('show.bs.modal', function (e) {
            let btn = $(e.relatedTarget);
            let url = btn.data('url');
            let pin_url = btn.data('pinner');
            $('#pinned-content').empty();
            if (pin_url !== undefined)
            {
                $.ajax(
                    {
                        url: pin_url,
                        success: function(result)
                        {
                            console.log(result)
                            $("#pinned-content").append(`
                                    <span>name : ${result.fname} ${result.lname}</span>
                                    <br>
                                    <span>Phone : <span class="fw-bolder">${result.phone}</span> </span>
                                    <br>
                                    <span>region : <span class="fw-bolder">${result.daira.name} ${result.daira.wilaya.name}</span>  </span>
                            `);
                        },
                        dataType:'json'
                    });
            }
            $(this).find("#patient-article-pin-change-form").attr('action' , url);
        })
    </script>

    {{ $appointment_datatable->scripts() }}
@endpush



