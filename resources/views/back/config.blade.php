@extends('back.layout.app')

@section('content')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Acceuil</a></li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
                </ol>
            </div>
        </div>

        <div class="row">
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
                    <form method="post" action="{{ route('post_config') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 col-sm-12 pb-2">
                                <label for="">Titre Site-web</label>
                                <input type="text" placeholder="Titre Site-web ..." required class="form-control" name="site_title" value="{{ $config->site_title }}">
                                @error('site_title')
                                <small class="text-danger text-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 col-sm-12 pb-2">
                                <label for="">Slogan Site-web</label>
                                <input type="text" placeholder="Slogan ..." required class="form-control" name="site_slogan" value="{{ $config->site_slogan }}">
                                @error('site_slogan')
                                <small class="text-danger text-bold">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 col-sm-12 pb-2">
                                <label for="">Email affiché dans le Site-web (et qui recoit les messages ) </label>
                                <input type="email" placeholder="Email ..." required class="form-control" name="site_email" value="{{ $config->site_email }}">
                                @error('site_email')
                                <small class="text-danger text-bold">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 col-sm-12 pb-2">
                                <label for="">Téléphones (séparez par  virgule ',' si ya plusieurs )</label>
                                <input type="text" placeholder="Email ..." required class="form-control" name="site_phones" value="{{ $config->site_phones }}">
                                @error('site_phones')
                                <small class="text-danger text-bold">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-3 col-sm-12 pb-2 mt-4">
                                <label for="">LOGO SITE-WEB</label>
                                <input class="form-control" type="file" accept="image/jpeg,image/png" name="site_logo">
                            </div>
                            <div class="col-md-3 text-center">
                                    <img class="" src="{{ $config->getFirstMediaUrl('images', 'thumb') }}" alt="">
                            </div>

                                <div class="col-md-6 pt-2 mt-4 pt-2">
                                    <button class="mt-4 btn btn-primary float-right">Enregistrer</button>
                                </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
