@extends("back.layout.app")


@section('content')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a target="_blank" href="{{ route('front.home') }}">Acceuil</a></li>
                    <li class="breadcrumb-item"><a target="_blank" href="{{ route('slides.index') }}">Gestion des Bannières</a></li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ $title }}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body" id="sortable">
                        @if($slides->count())
                            @foreach($slides as $slide)
                                <div id="{{ $slide->id }}"  class="callout callout-danger">
                                    <div class="row">
                                    <div class="col-md-6">
                                        <h5>{{ $slide->principal_text }}</h5>
                                        <p>{{ $slide->secondary_text }}</p>
                                        <small>{{ $slide->small_text }}</small>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <img class="" src="{{ $slide->getFirstMediaUrl('images', 'thumb') }}" alt="">
                                    </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('after-styles')
    <link rel="stylesheet" href="{{ asset('lte/plugins/jquery-ui/jquery-ui.min.css') }}">
@endpush


@push('after-scripts')
    <script src="{{ asset('lte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script>
        $(function() {

            $("#sortable").sortable({
                update: function(event, ui) {
                    updateOrder();
                }
            });
        });

        function updateOrder() {
            var item_order = new Array();
            $('#sortable .callout').each(function() {
                item_order.push($(this).attr("id"));
            });
            var order_string = 'order=' + item_order;
            $.ajax({
                type: "GET",
                url: "{{ route('slides.set_order') }}",
                data: order_string,
                cache: false,
                success: function(data) {
                    $(document).Toasts('create', {
                        class: 'bg-success',
                        title: 'Ordre a été changé',
                        subtitle: 'position de bannière sera changé dans la page d acceuil'
                    })
                }
            });
        }
    </script>
@endpush


