@extends("front.healthcares.layout")

@php
     function isValidCoordinates($coordinates) {
        $pattern = '/^[-+]?([1-8]?\d(\.\d+)?|90(\.0+)?),\s*[-+]?(180(\.0+)?|((1[0-7]\d)|([1-9]?\d))(\.\d+)?)$/';
        return preg_match($pattern, $coordinates) === 1;
    }
@endphp

@section("sidebar")
    <ul>
        <li class="submenu-open">
            <h6 class="submenu-hdr">Main</h6>
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
                <li class="">
                    <a href="{{ route('healthcare.get_my_opening_hours_page') }}"><i class="fa fa-calendar"></i><span class="px-2">@lang("Opening Hours")</span></a>
                </li>
                <li class="active">
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
            <h4>Profile</h4>
            <h6>{{ $title }}</h6>
        </div>
    </div>
    <div class="card">
        <form action="{{ route('healthcare.profile_post') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="profile-set">
                    <div class="profile-head"></div>
                    <div class="profile-top">
                        <div class="profile-content">
                            <div class="profile-contentimg">
                                <img src="{{ $profile->getFirstMediaUrl('avatar' , 'thumb') }}" alt="img" id="blah">
                                <div class="profileupload">
                                    <input type="file" id="imgInp" name="avatar"   accept="image/png,image/jpeg">
                                    <a href="javascript:void(0);"><img src="{{ asset('patient/assets/img/icons/edit-set.svg') }}" alt="img"></a>
                                </div>
                            </div>
                            <div class="profile-contentname">
                                <h2>{{ $profile->fname }}</h2>
                                <h4>@lang("Edit your general information here")</h4>
                                <span>
                                    @lang("Your Account is valid until")
                                    <span class="badge bg-info">{{ $profile->expired_at->format('Y-m-d') }}</span>

                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label>@lang("First Name")<span class="required">*</span></label>
                            <input type="text" name="fname"  value="{{ $profile->fname }}">
                            @error("fname")
                            <span ><small class="text-danger">{{ $message }}</small></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label>@lang("Last Name")<span class="required">*</span></label>
                            <input type="text" name="lname" value="{{ $profile->lname }}">
                            @error("lname")
                            <span ><small class="text-danger">{{ $message }}</small></span>
                            @enderror
                        </div>
                    </div>
                    @if($profile->type != 0)
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>@lang("Titulation")<span class="required">*</span></label>
                                <input type="text" name="titulation" value="{{ $profile->titulation }}">
                                @error("titulation")
                                <span ><small class="text-danger">{{ $message }}</small></span>
                                @enderror
                            </div>
                        </div>
                    @endif

                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label>@lang("UserName")<span class="required">*</span></label>
                            <input type="text" class="form-control" name="name" pattern="[a-zA-Z0-9_]+" value="{{ $profile->name }}">
                            @error("name")
                            <span ><small class="text-danger">{{ $message }}</small></span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label>@lang("Email") <span class="required">*</span></label>
                            <input name="email" type="email"  value="{{ $profile->email }}">
                            @error("email")
                            <span ><small class="text-danger">{{ $message }}</small></span>
                            @enderror
                        </div>
                    </div>
                    @if($profile->type != 4)
                        <div class="col-md-6 col-sm-12 pb-2">
                            <label for="">@lang("Services associated")</label>
                            <select class="select2bs4-services form-control"  name="services[]" multiple  id="">
                                @if($services->count())
                                    @foreach($services as $service)
                                        <option @if(in_array($service->id, array_keys($profile->services->pluck('title' , 'id')->toArray()))) selected @endif value="{{ $service->id }}">{{ $service->title }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    @endif

                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label>@lang("Phone")</label>
                            <input class="form-control" name="phones" type="tel" value="{{ $profile->phones }}">
                            @error('phone')
                            <small class="text-danger text-bold">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 pb-2">
                        <label for="">@lang("Wilaya")</label>
                        <select  id="wilaya_select" class="select2bs4 form-control">
                            @foreach($wilayas as $wilaya)
                                <option @if(optional($profile->daira)->wilaya->id == $wilaya->id) selected  @endif dairas-url="{{ route('get_dairas_by_wilaya' , $wilaya->id) }}" value="{{ $wilaya->id }}">{{ $wilaya->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 col-sm-12 pb-2">
                        <label for="">@lang("Daira")</label>
                        <select  name="daira_id" class="select2bs4 form-control">
                            <option value="{{ $profile->daira_id }}"> {{ optional($profile->daira)->name }}</option>
                        </select>
                    </div>

                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label>@lang("Password")</label>
                            <div class="pass-group">
                                <input type="password" name="password[]" class=" pass-input">
                                <span class="fas toggle-password fa-eye-slash"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label>@lang("Confirm Password")</label>
                            <div class="pass-group">
                                <input class="form-control" type="password" name="password[]" >
                                <span class="fas toggle-password fa-eye-slash"></span>
                            </div>
                        </div>
                    </div>

                    <hr>


                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="">@lang("Tags")</label>
                            <select class="multi-select form-control" name="tags[]"  multiple="multiple">
                                @if(!empty(json_decode($profile->tags)) and is_array(json_decode($profile->tags)))
                                    @foreach(json_decode($profile->tags) as $tag)
                                        <option selected value="{{ $tag }}">{{ $tag }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    @if($profile->type  == 0)
                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group">
                                <label for="">@lang("certificates & diplomas")</label>
                                <select class="multi-select form-control" name="diplomas[]"  multiple="multiple">
                                    @if(!empty(json_decode($profile->diplomas)) and is_array(json_decode($profile->diplomas)))
                                        @foreach(json_decode($profile->diplomas) as $dip)
                                            <option selected value="{{ $dip }}">{{ $dip }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group">
                                <label for="">@lang("experience & achievements")</label>
                                <select class="multi-select form-control" name="experience[]"  multiple="multiple">
                                    @if(!empty(json_decode($profile->experience)) and is_array(json_decode($profile->experience)))
                                        @foreach(json_decode($profile->experience) as $experience)
                                            <option selected value="{{ $experience }}">{{ $experience }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group">
                                <label for=""> @lang("treated diseases")</label>
                                <select class="multi-select form-control" name="languages[]"  multiple="multiple">
                                    @if(!empty(json_decode($profile->languages)) and is_array(json_decode($profile->languages)))
                                        @foreach(json_decode($profile->languages) as $language)
                                            <option selected value="{{ $language }}">{{ $language }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    @endif

                    @if($profile->type  == 3)
                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group">
                                <label for="">@lang("list of customers with ready tests results")</label>
                                <select class="multi-select form-control" name="customers_result[]"  multiple="multiple">
                                    @if(!empty(json_decode($profile->customers_result)) and is_array(json_decode($profile->customers_result)))
                                        @foreach(json_decode($profile->customers_result) as $item)
                                            <option selected value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    @endif
                                    @if($patients->count())
                                        @foreach($patients as $patient)
                                                <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    @endif



                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="">@lang("Medical equipment (preferred to be the commercial name of the equipment)")</label>
                            <select class="multi-select form-control" name="equipment[]"  multiple="multiple">
                                @if(!empty(json_decode($profile->equipment)) and is_array(json_decode($profile->equipment)))
                                    @foreach(json_decode($profile->equipment) as $equipment)
                                        <option selected value="{{ $equipment }}">{{ $equipment }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="">{{ \App\Models\HealthcareEntity::Types[$profile->type] }} @lang("Near Me")</label>
                            <select class="multi-select form-control" name="healthcares[]"  multiple="multiple">
                                @if($healthcares->count() )
                                    @foreach($healthcares as $healthcare)
                                        <option @if(in_array($healthcare->id,json_decode($profile->healthcares) ?? [])) selected @endif value="{{ $healthcare->id }}">{{ $healthcare->fname . ' ' . ' ' . $healthcare->lname }} | {{ optional(optional($healthcare->daira)->wilaya)->name }} {{ optional($healthcare->daira)->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12 pb-2">
                        <label for="">@lang("Description")</label>
                        <textarea name="description" class="form-control" id="" cols="30">{{ $profile->description }}</textarea>
                    </div>


                    <div class="col-md-6 col-sm-12 pb-2">
                        <label for="">@lang("Location (longitude, altitude)")</label>
                        <input type="text" name="maps" value="{{ $profile->maps }}" placeholder="Coordinates (Location)" class="form-control">
                    </div>

                    <div id="map" style="height: 400px; width: 100%;"></div>

                    <hr>



                    <div class="col-md-6 col-sm-12 pb-2">
                        <label for="">@lang("Background")</label>
                        <input id="background" class="form-control" type="file" name="background[]" multiple accept="image/jpeg,image/png">
                    </div>
                    <div class="col-md-3 pt-3 text-center">
                        <label for="">@lang("Photos of clinic (5 maximum)")</label>
                        <div class="col-md-12">
                            @foreach($profile->getMedia('background') as $file)
                                <img src="{{ $file->getUrl('sized') }}" style="max-width: 80px;margin: 10px;display: inline" alt="">
                            @endforeach
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12 pb-2">
                        <label for="">@lang("profile picture")</label>
                        <input  class="form-control" type="file" name="thumbnail" accept="image/jpeg,image/png">
                    </div>
                    <div class="col-md-3 pt-3 text-center">
                        <label for="">@lang("Personal photo of the doctor")</label>
                        @if($profile->getFirstMediaUrl('thumbnail', 'sized'))
                            <img src="{{ $profile->getFirstMediaUrl('thumbnail', 'sized') }}" alt="">
                        @endif
                    </div>

                    <div class="col-12">
                        <button class="btn btn-submit me-2">@lang("save")</button>
                        <a href="{{ route('patient.dashboard') }}" class="btn btn-cancel">@lang("back")</a>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

@push('after-styles')
    <link rel="stylesheet" href="{{ asset('lte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
@endpush
@push('after-scripts')
    <script src="{{ asset("lte/plugins/select2/js/select2.full.min.js") }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
    <script>
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
        $('.select2bs4-services').select2({
            theme: 'bootstrap4',
            @if($profile->type == 0)
                maximumSelectionLength: 1
            @endif
        })
        $('.multi-select').select2({
            tags: true,
            maximumSelectionLength: 30
        })

        $("#background").on("change", function(e) {
            if ($("#background")[0].files.length > @if($profile->type == 0) 5 @else 10 @endif ) {
                alert("you reach the max input file ");
               $("#background").val("");
            }
        });

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
        var coordinates = [{{ isValidCoordinates($profile->maps) ? $profile->maps  : "" }}];
        var map = L.map('map').setView(coordinates, 16);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '©'
        }).addTo(map);

        // Add a marker for the coordinates
        L.marker(coordinates).addTo(map)
            .bindPopup("{{ $profile->name }}")
            .openPopup();

    </script>
@endpush



