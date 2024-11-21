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
                                    <a class="btn btn-sm btn-primary" href="{{ route('healthcareEntity.create' , $type) }}">
                                        <i class="fa fa-plus"></i>
                                        @lang("New") {{ HealthcareEntity::Types[$type] }}
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    {{ $healthcare_entity_datatable->table(['class' => "table table-sm table-hover table-striped"]) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="healthcare-entity-status-change"  tabindex="-1" role="dialog">
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

            <div class="modal fade" id="healthcare-expiration-change"  tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="" method="post">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Update expiration day for an account</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Update subscription for this account ? </p>
                                <input class="form-control" type="datetime-local" name="expired_at">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class=" btn btn-success">Appliquer</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
@endsection

@push('after-styles')
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">

    <style>
        tr.bg-success td {
            background: #e6f8e6;
        }

        tr.bg-warning td {
            background: #f8e6e6;
        }
    </style>
@endpush

@push('after-scripts')
    <script src="{{ asset('lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    {{ $healthcare_entity_datatable->scripts() }}
    <script>
        $('#healthcare-entity-status-change').on('show.bs.modal', function (e) {
            let btn = $(e.relatedTarget);
            let url = btn.data('url');
            $(this).find(".submit-anchor").attr('href' , url);
        })

        $('#healthcare-expiration-change').on('show.bs.modal', function (e) {
            let btn = $(e.relatedTarget);
            let min_date = btn.data("min")
            let url = btn.data('url');
            $(this).find("form").attr('action' , url);
            $(this).find("input[name=expired_at]").attr('min' , min_date);
            $(this).find("input[name=expired_at]").attr('value' , min_date);

        })
    </script>
@endpush
