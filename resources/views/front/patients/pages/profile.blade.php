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
            <h4>Profile</h4>
            <h6>{{ $title }}</h6>
        </div>
    </div>
    <div class="card">
        <form action="{{ route('patient.profile_post') }}" method="post" enctype="multipart/form-data">
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
                                    <input type="file" id="imgInp" name="avatar" type="file"  accept="image/png,image/jpeg">
                                    <a href="javascript:void(0);"><img src="{{ asset('patient/assets/img/icons/edit-set.svg') }}" alt="img"></a>
                                </div>
                            </div>
                            <div class="profile-contentname">
                                <h2>{{ $profile->fname }}</h2>
                                <h4>@lang("Edit your general information here") ... </h4>
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
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label>@lang("UserName")<span class="required">*</span></label>
                            <input type="text" class="form-control" name="name" value="{{ $profile->name }}" placeholder="@lang("preferable to add numbers without any spaces")">
                            @error("name")
                            <span ><small class="text-danger">{{ $message }}</small></span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label>@lang("Email")  <span class="required">*</span></label>
                            <input name="email" type="email"  value="{{ $profile->email }}">
                            @error("email")
                            <span ><small class="text-danger">{{ $message }}</small></span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label>@lang("Sex")</label>
                            <select name="sex" class="form-control" id="">
                                <option value="male" @if($profile->sex == "male") selected @endif>@lang('Male')</option>
                                <option value="female" @if($profile->sex == "female") selected @endif>@lang("Female")</option>
                            </select>
                            @error('sex')
                            <small class="text-danger text-bold">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label>@lang("Date of Birth")</label>
                            <input type="date" name="birth_date" class="form-control" value="{{ $profile->birth_date }}">
                            @error('birth_date')
                            <small class="text-danger text-bold">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label>@lang("Phone")</label>
                            <input class="form-control" name="phone" type="tel" value="{{ $profile->phone }}" placeholder="+1452 876 5432">
                            @error('phone')
                            <small class="text-danger text-bold">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label>@lang("Blood Group")</label>
                            <select name="blood" class="form-control" id="">
                                @foreach(\App\Models\Patient::bloud_group as $blood)
                                    <option @if($blood == $profile->blood) selected @endif value="{{ $blood }}">{{ $blood }}</option>
                                @endforeach
                            </select>
                            @error('blood')
                            <small class="text-danger text-bold">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label>@lang("Blood Donor") ? </label>
                            <select name="donor" class="form-control" id="">
                                <option value="yes" @if($profile->donor == "yes") selected @endif>@lang("I'm available to contribute in blood donation")</option>
                                <option value="no" @if($profile->donor == "no") selected @endif>@lang("No, im not")</option>
                            </select>
                            @error('sex')
                            <small class="text-danger text-bold">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label>@lang("Chronic diseases") </label>
                            <select name="chronic_diseases[]"  class="form-control select2bs4" multiple id="">
                                @php
                                    $diseases_array = $profile->chronic_diseases ? json_decode($profile->chronic_diseases) : [];
                                @endphp
                              @if($diseases->count())
                                  @foreach($diseases as $disease)
                                        <option @if(in_array($disease->id , $diseases_array)) selected @endif value="{{ $disease->id }}">{{ $disease->title }}</option>
                                  @endforeach
                              @endif
                            </select>
                            @error('chronic_diseases')
                            <small class="text-danger text-bold">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col"></div>
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
    <style>
        .contant-us-container .contacts-form span{font-size:16px}

        .contant-us-container .contacts-form input.select2-search__field{
            height:unset;
        }
    </style>
@endpush
@push('after-scripts')
    <script  src="{{ asset('lte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset("lte/plugins/select2/js/select2.full.min.js") }}"></script>
    <script>
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    </script>
@endpush



