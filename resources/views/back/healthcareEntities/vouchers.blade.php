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

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            {{ $dataTable->table(['class' => "table table-sm table-hover table-striped"]) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="healthcare-entity-billing-change"  tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Update Status of Voucher</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <input class="btn btn-outline-warning" type="submit"  name="status" value="pending">
                        <input class="btn btn-outline-success" type="submit"  name="status" value="checked">
                        <input class="btn btn-outline-danger" type="submit"   name="status" value="refused">
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
    {{ $dataTable->scripts() }}
    <script>

        $('#healthcare-entity-billing-change').on('show.bs.modal', function (e) {
            let btn = $(e.relatedTarget);
            let url = btn.data('url');
            $(this).find("form").attr('action' , url);
        })
    </script>
@endpush
