@extends("back.layout.app")


@section('content')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a target="_blank" href="{{ route('front.home') }}">Acceuil</a></li>
                    <li class="breadcrumb-item"><a target="_blank" href="{{ route('appointment.index' , $type) }}">{{ $type . 'listing' }}</a></li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-10 offset-1">
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
                        <form method="post" action="{{ route("appointment.update" , [$type , $appointment->id]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 col-sm-12 pb-2">
                                    <label for="">Patient</label>
                                    <div class="patient-list" @if($appointment->patient_id == null) style="display: none" @endif>
                                        <select  class="select2bs4 form-control"  name="patient_id"   id="">
                                            <option value="" disabled selected></option>
                                            @if($patients->count())
                                                @foreach($patients as $patient)
                                                    <option @if($patient->id == $appointment->patient_id) selected @endif get-patient-info="{{ route('patients.get_patient_info', $patient->id) }}" value="{{ $patient->id }}">{{ $patient->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <input type="text" class="form-control patient-name" placeholder="patient name ..." name="name" value="{{ $appointment->name }}" @if($appointment->patient_id != null) style="display: none" @endif>
                                    <small for="">Anonyme ?</small>
                                    <input type="checkbox" @if($appointment->patient_id == null) checked  @endif name="anonym" >
                                </div>
                                <div class="col-md-6 col-sm-12 pb-2">
                                    <label for="">Phone number</label>
                                    <input type="tel" class="form-control" placeholder="phone number ..." name="phone" value="{{ $appointment->phone }}" style="">
                                </div>
                                <div class="col-md-6 col-sm-12 pb-2">
                                    <label for="">Healthcate Entity</label>
                                    <select required class="select2bs4 form-control"  name="healthcare_entity_id"  id="">
                                        @if($healthcare_entities->count())
                                            <option value="" selected disabled></option>
                                            @foreach($healthcare_entities as $entity)
                                                <option @if($entity->id == $appointment->healthcare_entity_id) selected @endif get-services-url="{{ route('healthcareEntity.get_services_of_healthcare_entity' , $entity->id) }}" value="{{ $entity->id }}">{{ $entity->name }} | {{ \App\Models\HealthcareEntity::Types[$entity->type] }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-12 pb-2">
                                    <label for="">Appointment Date</label>
                                    <input type="datetime-local"  name="started_at" value="{{ $appointment->started_at }}" class="form-control">
                                    @error('started_at')
                                    <small class="text-danger text-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-sm-12 pb-2">
                                    <label for="">Service associated</label>
                                    <select required  class="select2bs4 form-control"  name="service_id"   id="">
                                        @if($services->count())
                                            @foreach($services as $service)
                                                <option value="{{$service->id}}"> {{ $service->title }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-12 pb-2">
                                    <label for="">Stauts</label>
                                    <select name="status" id="" class="form-control">
                                        <option value="pending" @if($appointment->status == 'pending')  selected @endif>pending</option>
                                        <option value="canceled" @if($appointment->status == 'canceled')  selected @endif>canceled</option>
                                        <option value="done" @if($appointment->status == 'done' )  selected @endif>done</option>
                                    </select>
                                </div>
                                <div class="col-md-12 pt-2">
                                    <a class="btn btn-secondary" href="{{ route('appointment.index' , $type) }}">
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
        $('input[name=anonym]').on('change' , function ()
        {
            if($(this)[0].checked)
            {
                $('.patient-name').css('display' , 'block')
                $('.patient-list').css('display' , 'none')
                $('input[name=phone]').val("");
            }else
            {
                $('.patient-name').css('display' , 'none')
                $('.patient-list').css('display' , 'block')
            }
        })
        $('select[name=healthcare_entity_id]').on('change' , function ()
        {
            let url = $(this).find('option:selected').attr('get-services-url');
            let service_select = $('select[name=service_id]');
            $.get(
                url,
                function (data) {
                    service_select.empty();
                    service_select.removeAttr('disabled');
                    service_select.append(`<option selected disabled value="">Select Service</option>` );
                    if(data.length > 0 ){
                        data.forEach(function (item)
                        {
                            service_select.append(`<option value="${item.id}">${item.title} </option>`)
                        })
                    }
                }, "json");
        })

        $('select[name=patient_id]').on('change' , function ()
        {
            let url = $(this).find('option:selected').attr('get-patient-info');
            $.get(
                url,
                function (data) {
                    $('input[name=phone]').val(data.phone)
                }, "json");
        })
    </script>
@endpush
