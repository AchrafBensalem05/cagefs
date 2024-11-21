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
                                    <a class="btn btn-sm btn-primary" href="{{ route('diseases.create') }}">
                                        <i class="fa fa-plus"></i>
                                        New Chronic Disease
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    {{ $disease_datatable->table(['class' => "table table-sm table-striped"]) }}
                                </div>
                            </div>
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

    {{ $disease_datatable->scripts() }}

@endpush
