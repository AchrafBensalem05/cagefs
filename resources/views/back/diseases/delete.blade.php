@extends("back.layout.app")


@section('content')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a target="_blank" href="{{ route('front.home') }}">Acceuil</a></li>
                    <li class="breadcrumb-item"><a target="_blank" href="{{ route('diseases.index') }}">Chronic Diseases Listing</a></li>
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
                    <div class="card-body">
                        <form  method="post"  action="{{ route("diseases.destroy" , $disease->id) }}">
                            @csrf
                            @method("DELETE")
                            <span>@lang("Are you sure from deleting") <strong>{{ $disease->title }}</strong> ?</span>
                            <hr>
                            <a class=" btn btn-success" href="{{ route("diseases.index") }}"><i class="fa fa-arrow-left"></i>  @lang("Cancel")</a>
                            <button type="submit" style="float: right" class="btn btn-danger">@lang('Confirm')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




