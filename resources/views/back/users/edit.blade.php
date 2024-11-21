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
                        <form method="post" action="{{ route("users.update" , $user->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 col-sm-12 pb-2">
                                    <label for="">Nom d'utilisateur</label>
                                    <input type="text" required class="form-control" name="name" value="{{ $user->name }}">
                                    @error('name')
                                    <small class="text-danger text-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-sm-12 pb-2">
                                    <label for="">Email</label>
                                    <input type="email" name="email" class="form-control"  placeholder="Email ..." value="{{ $user->email }}">
                                    @error('email')
                                    <small class="text-danger text-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-sm-12 pb-2">
                                    <label for="">Mot de passe</label>
                                    <input min="5"  type="password" name="password" class="form-control"  placeholder="Mot de passe ici ...">
                                    @error('password')
                                    <small class="text-danger text-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-sm-12 pb-2">
                                    <label for="">Roles</label>
                                    <select class="form-control select2bs4" multiple name="roles[]" id="">
                                        @if($roles->count())
                                            @foreach($roles as $role)
                                                <option @if($user->hasRole($role->name)) selected @endif value="{{ $role->id }}"> {{ $role->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-6 pt-2">
                                    <a class="btn btn-secondary" href="{{ route("users.index") }}">
                                        Retour
                                    </a>
                                </div>
                                <div class="col-md-6 pt-2 text-right">
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
