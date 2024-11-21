@extends("back.layout.app")


@section('content')
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a target="_blank" href="{{ route('front.home') }}">Acceuil</a></li>
                            <li class="breadcrumb-item"><a target="_blank" href="{{ route('categories.index') }}">Catégories</a></li>
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
                                <form method="post" action="{{ route("categories.store") }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 pb-2">
                                            <label for="">Titre</label>
                                            <input type="text" required class="form-control" name="title" value="{{ old('title') }}">
                                            @error('title')
                                            <small class="text-danger text-bold">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 col-sm-12 pb-2">
                                            <label for="">Afficher dans le menu dropdown</label>
                                            <br>
                                            <label class="p-2">oui</label>
                                            <input type="radio"   name="dropdown" value="yes">

                                            <label class="p-2">Non</label>
                                            <input type="radio"   name="dropdown" value="no">
                                            @error('dropdown')
                                            <small class="text-danger text-bold">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 col-sm-12 pb-2">
                                            <label for="">Afficher dans la page d'accueil</label>
                                            <br>
                                            <label class="p-2">oui</label>
                                            <input type="radio"   name="front" value="yes">

                                            <label class="p-2">Non</label>
                                            <input type="radio"   name="front" value="no">
                                            @error('dropdown')
                                            <small class="text-danger text-bold">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 pt-2">
                                            <a class="btn btn-secondary" href="{{ route("categories.index") }}">
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
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    </script>
@endpush
