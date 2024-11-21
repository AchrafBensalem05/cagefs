@php
use App\Models\HealthcareEntity;
@endphp
@extends('back.layout.app')

@section('content')
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Acceuil</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ $title }}</h3>
                                <div class="float-right">
                                    <a class="btn btn-sm btn-primary" href="{{ route('appointment.create' , $type) }}">
                                        <i class="fa fa-plus"></i>
                                        @lang("New") {{ $type }}
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    {{ $appointment_datatable->table(['class' => "table table-sm table-hover table-striped"]) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="appointment-entity-status-change"  tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Changer le Statut</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Vous etes sur de cette action ? </p>
                        </div>
                        <div class="modal-footer">
                            <a href="" class="submit-anchor btn btn-success">Appliquer</a>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
@endsection

@push('after-styles')
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush

@push('after-scripts')
    <script src="{{ asset('lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    {{ $appointment_datatable->scripts() }}
    <script>
        $('#healthcare-entity-status-change').on('show.bs.modal', function (e) {
            let btn = $(e.relatedTarget);
            let url = btn.data('url');
            $(this).find(".submit-anchor").attr('href' , url);
        })
    </script>

@endpush
