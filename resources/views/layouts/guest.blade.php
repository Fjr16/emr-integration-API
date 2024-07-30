<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('/assets/vendor/fonts/boxicons.css') }}" />

    {{-- core css --}}
    <link rel="stylesheet" href="{{ asset('/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    

    <!-- Scripts Core -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <script src="{{ asset('/assets/vendor/js/bootstrap.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('/assets/js/main.js') }}"></script>

    <style>
        .btn-primary {
            background-color: #36BA98 !important;
            border-color: #36BA98 !important;
        }
        .btn-primary:hover {
            background-color: #249579 !important;
        }
        .text-success {
            color: #36BA98 !important;
        }
    </style>

</head>

<body>
    <div class="container-fluid" style="background: #b3dacd;">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header text-center">
                        <a href="/" class="fw-bolder text-success fs-1">E Medical Record</a>
                    </div>
                    <div class="card-body">
                        @yield('login-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
