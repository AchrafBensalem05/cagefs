<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="noindex, nofollow">
    <title>@lang("Dashboard") {{ $profile->name }} | {{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('patient/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('patient/assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('patient/assets/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('patient/assets/css/style.css') }}">
    @stack('after-styles')
</head>
<body  @if(session('locale') == 'ar') style="direction: rtl" @endif>
<div id="global-loader">
    <div class="whirly-loader"> </div>
</div>
<div class="main-wrapper">
    <div class="header">
        <div class="header-left active">
            <a href="{{ route('front.home') }}" class="logo logo-normal">
                <img src="{{ $config->getFirstMediaUrl('images') }}" alt="">
            </a>
            <a href="{{ route('front.home') }}" class="logo logo-white">
                <img src="{{ $config->getFirstMediaUrl('images') }}" alt="">
            </a>
            <a href="{{ route('front.home') }}" class="logo-small">
                <img src="{{ $config->getFirstMediaUrl('images') }}" alt="">
            </a>
            <a id="toggle_btn" href="javascript:void(0);">
                <i data-feather="chevrons-left" class="feather-16"></i>
            </a>
            <form action="{{ route('setLanguage') }}" method="post" style="margin:0 20px 0 30px;">
                @csrf
                <select class="form-control" name="locale" onchange="this.form.submit()" style="width:fit-content;">
                    <option value="en" {{ session('locale') == 'en' ? 'selected' : '' }}>@lang("English")</option>
                    <option value="fr" {{ session('locale') == 'fr' ? 'selected' : '' }}>@lang("French")</option>
                    <option value="ar" {{ session('locale') == 'ar' ? 'selected' : '' }}>@lang("Arabic")</option>
                </select>
            </form>
        </div>
        <a id="mobile_btn" class="mobile_btn" href="#sidebar">
            <span class="bar-icon">
            <span></span>
            <span></span>
            <span></span>
            </span>
        </a>
        <ul class="nav user-menu">
            <li class="nav-item nav-item-box">
                <a href="javascript:void(0);" id="btnFullscreen">
                    <i data-feather="maximize"></i>
                </a>
            </li>
            <li class="nav-item dropdown has-arrow main-drop">
                <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                  <span class="user-info">
                  <span class="user-letter">
                  <img src="{{ $profile->getFirstMediaUrl('avatar' , 'thumb') }}" alt="" class="img-fluid">
                  </span>
                  <span class="user-detail">
                  <span class="user-name">{{ $profile->name }}</span>
                  </span>
                  </span>
                </a>
                <div class="dropdown-menu menu-drop-user">
                    <div class="profilename">
                        <div class="profileset">
                           <span class="user-img"><img src="{{ $profile->getFirstMediaUrl('avatar' , 'thumb') }}" alt="">
                           <span class="status online"></span></span>
                            <div class="profilesets">
                                <h6>{{ $profile->name }}</h6>
                            </div>
                        </div>
                        <hr class="m-0">
                        <a class="dropdown-item" href="{{ route('patient.profile') }}"> <i class="me-2" data-feather="user"></i> My Profile</a>
                        <hr class="m-0">
                    </div>
                </div>
            </li>
        </ul>
        <div class="dropdown mobile-user-menu">
            <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ route('patient.profile') }}">Mon Profile</a>
                <form action="{{ route('logout_patient') }}" method="post">@csrf <button>Décoonexion</button>
                </form>
            </div>
        </div>
    </div>
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                @yield('sidebar')
            </div>
        </div>
    </div>
    <div class="page-wrapper">
        <div class="content">
            @if(flash()->message)
                <div class="{{ flash()->class }}">
                    {{ flash()->message }}
                </div>
            @endif
            @yield('content')
        </div>
    </div>
</div>
<script src="{{ asset('patient/assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('patient/assets/js/feather.min.js') }}"></script>
<script src="{{ asset('patient/assets/js/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('patient/assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('patient/assets/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('patient/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('patient/assets/plugins/apexchart/apexcharts.min.js') }}"></script>
<script src="{{ asset('patient/assets/plugins/apexchart/chart-data.js') }}"></script>
<script src="{{ asset('patient/assets/js/script.js') }}"></script>
@stack('after-scripts')
</body>
</html>
