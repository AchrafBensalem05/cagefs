@extends("back.layout.app")


@section('content')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a target="_blank" href="{{ route('front.home') }}">Acceuil</a></li>
                    <li class="breadcrumb-item"><a target="_blank" href="{{ route('patients.index') }}">Patients Listing</a></li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-8 offset-2">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ $title }}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route("patients.update" , $patient->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 col-sm-12 pb-2">
                                    <label for="">Username</label>
                                    <input type="text" required class="form-control" name="name" value="{{ $patient->name }}">
                                    @error('name')
                                    <small class="text-danger text-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-sm-12 pb-2">
                                    <label for="">Email</label>
                                    <input type="email" required class="form-control" name="email" value="{{ $patient->email }}">
                                    @error('email')
                                    <small class="text-danger text-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-sm-12 pb-2">
                                    <label for="">First Name</label>
                                    <input type="text" required class="form-control" name="fname" value="{{ $patient->fname }}">
                                    @error('fname')
                                    <small class="text-danger text-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-sm-12 pb-2">
                                    <label for="">Last Name</label>
                                    <input type="text" required class="form-control" name="lname" value="{{ $patient->lname }}">
                                    @error('lname')
                                    <small class="text-danger text-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-sm-12 pb-2">
                                    <label for="">Birth date</label>
                                    <input type="date" name="birth_date" value="{{ $patient->birth_date }}" class="form-control" >
                                    @error('birth_date')
                                    <small class="text-danger text-bold">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-sm-12 pb-2">
                                    <label for="">Phone number</label>
                                    <input type="tel" required name="phone" class="form-control" value="{{ $patient->phone }}">
                                    @error('phone')
                                    <small class="text-danger text-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-sm-12 pb-2">
                                    <label for="">Wilaya</label>
                                    <select  id="wilaya_select" class="select2bs4 form-control">
                                        @foreach($wilayas as $wilaya)
                                            <option @if(optional(optional($patient->daira)->wilaya)->id == $wilaya->id) selected  @endif dairas-url="{{ route('get_dairas_by_wilaya' , $wilaya->id) }}" value="{{ $wilaya->id }}">{{ $wilaya->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-12 pb-2">
                                    <label for="">Daira</label>
                                    <select  name="daira_id" class="select2bs4 form-control">
                                        <option value="{{ $patient->daira_id }}"> {{ optional($patient->daira)->name }}</option>
                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-12 pb-2">
                                    <label for="">Address</label>
                                    <input type="text" name="address" value="{{ $patient->address }}" class="form-control" >
                                    @error('address')
                                    <small class="text-danger text-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-sm-12 pb-2">
                                    <label for="">Password</label>
                                    <input min="5"  type="password" name="password" class="form-control"  placeholder="Entity Password here ...">
                                    @error('password')
                                    <small class="text-danger text-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-sm-12 pb-2">
                                    <div class="form-group">
                                        <label>Blood Donor ? </label>
                                        <select name="donor" class="form-control" id="">
                                            <option value="yes" @if($patient->donor == "yes") selected @endif>im available to contribute in blood donation</option>
                                            <option value="no" @if($patient->donor == "no") selected @endif>No, im not</option>
                                        </select>
                                        @error('sex')
                                        <small class="text-danger text-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 pb-2">
                                    <label for="">Blood Group</label>
                                    <select class="form-control" name="blood" id="">
                                        @foreach(\App\Models\Patient::bloud_group as $blood)
                                            <option value="{{ $blood }}" @if($blood == $patient->blood) selected @endif>{{ $blood }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-12 pb-2">
                                    <label for="">SEX</label>
                                    <br>
                                    <label class="p-2">MALE</label>
                                    <input type="radio" @if($patient->sex == 'male') checked @endif  name="sex" value="male">

                                    <label class="p-2">FEMALE</label>
                                    <input type="radio" @if($patient->sex == 'female') checked @endif  name="sex"  value="female">
                                    @error('sex')
                                    <small class="text-danger text-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-sm-12 pb-2">
                                    <label for="">Blocked</label>
                                    <br>
                                    <label class="p-2">YES</label>
                                    <input type="radio" @if($patient->blocked == 'yes') checked @endif  name="blocked" value="yes">

                                    <label class="p-2">NO</label>
                                    <input type="radio" name="blocked" @if($patient->blocked == 'no') checked @endif value="no">
                                    @error('blocked')
                                    <small class="text-danger text-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-12 pt-2">
                                    <a class="btn btn-secondary" href="{{ route('patients.index') }}">
                                        Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-styles')
    <link rel="stylesheet" href="{{ asset('lte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush
@push('after-scripts')
    <script src="{{ asset("lte/plugins/select2/js/select2.full.min.js") }}"></script>
    <script>
        $('.select2bs4').select2({
            theme: 'bootstrap4'
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
