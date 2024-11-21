@php
    $config = \App\Models\Configuration::find(1);
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('lte/css/adminlte.min.css') }}">

    <link rel="stylesheet" href="{{ asset('lte/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/icheck-bootstrap/icheck-bootstrap.css') }}">

    @stack('after-styles')

    <style>
        .nav-link{
            padding:10px
        }
    </style>
</head>


<body class="hold-transition {{ $bodyclass ?? "sidebar-mini layout-fixed" }}">


<div class="wrapper">
    <div class="preloader flex-column justify-content-center align-items-center" >
        <img class="animation__shake" src="{{ $config->getFirstMediaUrl('images' )  }}" height="200" width="200" >
    </div>
    @if(\Illuminate\Support\Facades\Auth::user())
    @include('back.shared.header')
    @include('back.shared.sidebar')

    <div class="content-wrapper">
        <div class="content-header">
            @if (flash()->message)
                <div class="{{ flash()->class }}">
                    {{ flash()->message }}
                </div>
            @endif
            @yield('content')
        </div>
    </div>

    @else
        @yield('content')
    @endif

</div>


<!-- jQuery -->
<script src="{{ asset('lte/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('lte/js/adminlte.min.js') }}"></script>

@stack('after-scripts')

</body>
</html>
