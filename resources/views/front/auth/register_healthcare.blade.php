@extends('front.layout')



@section('content')
    <div class="contant-us-container">
        <div class="contact-us h-auto">
            @if (flash()->message)
                <div class="{{ flash()->class }}">
                    {{ flash()->message }}
                </div>
            @endif
            <form action="{{ route('healthcare.post_register' , ["type" => $type]) }}" method="post">
                @csrf
                <div class="contacts-form ms-0" >
                    <div class="ms-auto w-100" style="grid-template-rows:unset">
                        <span>{{ $title }}</span>
                        <p>@lang("Already have an account ? ")<a href="{{ route('healthcare.login' , $type) }}">@lang("Login")</a></p>
                        @error('blood')
                        <small class="text-danger text-bold">{{ $message }}</small>
                        @enderror
                        <input name="fname" type="text" placeholder="@lang("Responsable First Name")" required="required" class="m-1">
                        @error('fname')
                        <small class="text-danger text-bold">{{ $message }}</small>
                        @enderror
                        <input name="lname" type="text" placeholder="@lang("Responsable Last Name")" required="required" class="m-1">
                        @error('lname')
                        <small class="text-danger text-bold">{{ $message }}</small>
                        @enderror
                        <textarea name="address" id="" cols="30" rows="10" class="form-control m-1" placeholder="@lang("Address")"></textarea>
                        @error('address')
                        <small class="text-danger text-bold">{{ $message }}</small>
                        @enderror
                        @if($type == 0)
                            <select name="sex" id="" class="form-control">
                                <option value="both" disabled selected>@lang("Sex")</option>
                                <option value="male">@lang("Male")</option>
                                <option value="female">@lang("Female")</option>
                            </select>
                            @error('sex')
                            <small class="text-danger text-bold">{{ $message }}</small>
                            @enderror
                        @endif
                        <input name="phone" type="tel" placeholder="@lang("Phone ...")" required="required" class="m-1">
                        @error('phone')
                        <small class="text-danger text-bold">{{ $message }}</small>
                        @enderror
                        <hr>
                        <input name="name" pattern="[a-zA-Z0-9_]+" type="text" placeholder="@lang("Username... /Ex:ali_ammar_57")" required="required" class="m-1">
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
                        <textarea name="description" class="form-control m-1" placeholder="@lang("Biography (Short Description About You) ...")"></textarea>
                        <hr>
                        <select  id="wilaya_select" class="select2bs4 form-control m-1">
                            <option value="" selected disabled>@lang("Wilaya") ...</option>
                            @foreach($wilayas as $wilaya)
                                <option dairas-url="{{ route('get_dairas_by_wilaya' , $wilaya->id) }}" value="{{ $wilaya->id }}">{{ $wilaya->name }}</option>
                            @endforeach
                        </select>
                        <br>

                        <select  name="daira_id" required class="select2bs4 form-control m-1">
                            <option value="" selected disabled>@lang("Daira") ... </option>
                        </select>
                        <hr>
                        <br>

                        @if($type != 4)
                            <label for="">@lang("Service") ... </label>
                            <select class="select2bs4-service form-control"  name="services[]" multiple required id="">
                                @if($services->count())
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->title }}</option>
                                    @endforeach
                                @endif
                            </select>
                        @endif
                        <button type="submit">@lang("Sign up")</button>
                    </div>
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
            theme: 'bootstrap4',
        })

        $('.select2bs4-service').select2({
            theme: 'bootstrap4',
            @if($type == 0)
                maximumSelectionLength: 1
            @endif
        })

        $('#wilaya_select').on('change' , function (event)
        {
            $.get($(event.target).find('option:selected').attr('dairas-url') , function (data)
            {
                let daira_select = $('select[name=daira_id]');
                daira_select.empty()
                data.forEach(function (daira){
                    daira_select.append(`<option value="${daira.id}">${daira.name}</option>`)
                })
            } , 'json')
        })
    </script>
@endpush
