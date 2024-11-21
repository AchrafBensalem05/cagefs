@extends('front.layout')



@section('content')
    <div class="contant-us-container">
        <div class="contact-us h-auto">
            @if (flash()->message)
                <div class="{{ flash()->class }}">
                    {{ flash()->message }}
                </div>
            @endif
            <form action="{{ route('patient.post_register') }}" method="post">
                @csrf
                <div class="contacts-form ms-0" >
                    <div class="ms-auto w-100" style="grid-template-rows:unset">
                        <span>{{ $title }}</span>
                        <p>@lang("Already have an account ? ")<a href="{{ route('patient.login') }}">@lang("Login")</a></p>
                        <input name="fname" type="text" placeholder="@lang("First Name")" required="required" class="m-1">
                        @error('fname')
                        <small class="text-danger text-bold">{{ $message }}</small>
                        @enderror
                        <input name="lname" type="text" placeholder="@lang("Last Name")" required="required" class="m-1">
                        @error('lname')
                        <small class="text-danger text-bold">{{ $message }}</small>
                        @enderror
                        <textarea name="address" id="" cols="30" rows="10" class="form-control m-1" placeholder="@lang("Address")"></textarea>
                        @error('address')
                        <small class="text-danger text-bold">{{ $message }}</small>
                        @enderror
                        <input name="phone" type="tel" placeholder="@lang("Phone ...")" required="required" class="m-1">
                        @error('phone')
                        <small class="text-danger text-bold">{{ $message }}</small>
                        @enderror
                        <hr>
                        <select name="sex" required class="m-1 form-control" id="">
                            <option value="both" disabled selected>@lang("Sex")</option>
                            <option value="male">@lang("Male")</option>
                            <option value="female">@lang("Female")</option>
                        </select>
                        @error('sex')
                        <small class="text-danger text-bold">{{ $message }}</small>
                        @enderror
                        <small>@lang("Date of Birth")</small>
                        <input type="date" required name="birth_date" class="m-1 form-control" >
                        @error('date')
                        <small class="text-danger text-bold">{{ $message }}</small>
                        @enderror
                        <select name="blood" class="form-control m-1" required id="">
                            <option value="" selected disabled>@lang("Select your Blood type ...")</option>
                            @foreach(\App\Models\Patient::bloud_group as $blood_group)
                                <option value="{{ $blood_group }}">{{ $blood_group }}</option>
                            @endforeach
                        </select>
                        @error('blood')
                        <small class="text-danger text-bold">{{ $message }}</small>
                        @enderror
                        <label for="">@lang("Chronic diseases") ? </label>
                        <select name="chronic_diseases[]" class="select2bs4 form-control m-1" multiple id="" required>
                           @if($diseases->count())
                               @foreach($diseases as $disease)
                                   <option value="{{ $disease->id }}">{{ $disease->title }}</option>
                               @endforeach
                           @endif
                        </select>
                        @error('blood')
                        <small class="text-danger text-bold">{{ $message }}</small>
                        @enderror
                        <hr>
                        <input name="name" type="text" placeholder="@lang("Username... /Ex:ali_ammar_57")" required="required" class="m-1">
                        @error('name')
                        <small class="text-danger text-bold">{{ $message }}</small>
                        @enderror
                        <input name="email" type="text" placeholder="@lang("Email ...")" required="required" class="m-1">
                        @error('email')
                        <small class="text-danger text-bold">{{ $message }}</small>
                        @enderror
                        <input type="password" name="password" placeholder="@lang("Password ...")" required="required" class="m-1">
                        @error('password')
                        <small class="text-danger text-bold">{{ $message }}</small>
                        @enderror
                        <button type="submit">@lang("Sign up")</button>
                    </div>
                    <a href="{{ route('auth0_google') }}" class="w-100 btn btn-success rounded-0"><i class="fa fa-google"></i>@lang("Sign up with Google account")</a>
                </div>
            </form>

        </div>
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

