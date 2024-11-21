@extends("back.layout.app")


@section('content')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a target="_blank" href="{{ route('front.home') }}">Acceuil</a></li>
                    <li class="breadcrumb-item"><a target="_blank" href="{{ route('users.index') }}">Gestion des utilisateurs</a></li>
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
                        <form  method="post"  action="{{ route("users.destroy" , $user->id) }}">
                            @csrf
                            @method("DELETE")
                            <span>@lang("Voulez vous Confirmer la suppression de ") <strong>{{ $user->name }}</strong> ?</span>
                            <hr>
                            <a class=" btn btn-success" href="{{ route("users.index") }}"><i class="fa fa-arrow-left"></i>  @lang("Annuler")</a>
                            <button type="submit" style="float: right" class="btn btn-danger">@lang('Supprimer')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




