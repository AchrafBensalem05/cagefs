@extends("back.layout.app")

@php
use App\Models\HealthcareEntity;
$dayes = ['monday' , 'tuesday'    , 'wednesday'  , 'thursday'   , 'friday'     , 'saturday'   , 'sunday' ];
@endphp

@section('content')
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a target="_blank" href="{{ route('front.home') }}">Acceuil</a></li>
                            <li class="breadcrumb-item"><a target="_blank" href="{{ route('healthcareEntity.index' , $type) }}">{{ HealthcareEntity::Types[$type] . ' Listing' }}</a></li>
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
                                <form method="post" action="{{ route("healthcareEntity.store" , $type) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 pb-2">
                                            <label for="">Username</label>
                                            <input type="text" pattern="[a-zA-Z0-9_]+" required class="form-control" name="name" value="{{ old('name') }}">
                                            @error('name')
                                            <small class="text-danger text-bold">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 col-sm-12 pb-2">
                                            <label for="">Email</label>
                                            <input type="email" required class="form-control" name="email" value="{{ old('email') }}">
                                            @error('email')
                                            <small class="text-danger text-bold">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 col-sm-12 pb-2">
                                            <label for="">Responsable First Name</label>
                                            <input type="text" required class="form-control" name="fname" value="{{ old('fname') }}">
                                            @error('fname')
                                            <small class="text-danger text-bold">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 col-sm-12 pb-2">
                                            <label for="">Responsable Last Name</label>
                                            <input type="text" required class="form-control" name="lname" value="{{ old('lname') }}">
                                            @error('lname')
                                            <small class="text-danger text-bold">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 col-sm-12 pb-2">
                                            <label for="">Address</label>
                                            <textarea name="address" class="form-control" id="" cols="30" rows="3"></textarea>
                                            @error('address')
                                            <small class="text-danger text-bold">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 col-sm-12 pb-2">
                                            <label for="">Description (resume)</label>
                                            <textarea name="description" class="form-control" id="" cols="30" rows="3"></textarea>
                                            @error('description')
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
                                        <div class="col-md-6 col-sm-12 pb-2">
                                            <label for="">Service associated</label>
                                            <select class="select2bs4 form-control"  name="services[]" multiple  id="">
                                                @if($services->count())
                                                    @foreach($services as $service)
                                                        <option value="{{ $service->id }}">{{ $service->title }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>

                                        <div class="col-md-6 col-sm-12 pb-2">
                                            <label for="">Wilaya</label>
                                            <select  id="wilaya_select" class="select2bs4 form-control">
                                                @foreach($wilayas as $wilaya)
                                                    <option dairas-url="{{ route('get_dairas_by_wilaya' , $wilaya->id) }}" value="{{ $wilaya->id }}">{{ $wilaya->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-sm-12 pb-2">
                                            <label for="">Daira</label>
                                            <select  name="daira_id" class="select2bs4 form-control">

                                            </select>
                                        </div>
                                        <div class="col-md-6 col-sm-12 pb-2">
                                            <label for="">Phones</label>
                                            <input class="form-control" name="phones" type="text" placeholder="separate with commas">
                                        </div>
                                        <div class="col-md-6 col-sm-12 pb-2">
                                            <label for="">Blocked</label>
                                            <br>
                                            <label class="p-2">YES</label>
                                            <input type="radio"   name="blocked" value="yes">

                                            <label class="p-2">NO</label>
                                            <input type="radio"   name="blocked" checked value="no">
                                            @error('blocked')
                                            <small class="text-danger text-bold">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 col-sm-12 pb-2">
                                            <label for="">Opening Hours</label>
                                            <span class="btn btn-sm btn-info apply-to-all-days">Apply to All dayes</span>
                                                @foreach($dayes as $day)
                                                    <div class="row">
                                                        <div class="col-4 pb-2 mt-4">
                                                            <div class="icheck-success d-inline">
                                                                <input id="{{ $day }}check" type="checkbox" checked name="opening_hours[{{$day}}][checked]">
                                                                <label for="{{ $day }}check">{{ $day }}</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-4 pb-2">
                                                            <small>start</small>
                                                            <input type="time" required  value="08:00" class="form-control time-start"  name="opening_hours[{{ $day }}][start]">
                                                        </div>
                                                        <div class="col-4 pb-2">
                                                            <small>ends</small>
                                                            <input type="time" required  value="17:00" class="form-control time-end"  name="opening_hours[{{ $day }}][end]">
                                                        </div>
                                                    </div>
                                                @endforeach
                                        </div>

                                        <div class="col-md-6 col-sm-12 pb-2">
                                            <label for="">Avatar</label>
                                            <input  class="form-control" type="file" name="avatar" accept="image/jpeg,image/png">
                                        </div>
                                        <div class="col-md-6 col-sm-12 pb-2">
                                            <label for="">Thubmnail</label>
                                            <input  class="form-control" type="file" name="thumbnail" accept="image/jpeg,image/png">
                                        </div>
                                        <div class="col-md-6 col-sm-12 pb-2">
                                            <label for="">Background</label>
                                            <input  class="form-control" type="file" name="background" accept="image/jpeg,image/png">
                                        </div>
                                        <div class="col-md-12 pt-2">
                                            <a class="btn btn-secondary" href="{{ route('healthcareEntity.index' , $type) }}">
                                                Retour
                                            </a>
                                            <button type="submit" class="btn btn-primary">
                                                Enregistrer
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
    </script>
@endpush
