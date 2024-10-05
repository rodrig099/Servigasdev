


<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset ('build/assets/dashboard/assets/img/favicon/favicon.ico')}}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{public_path ('build/assets/dashboard/assets/vendor/fonts/boxicons.css')}}" type="text/css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{public_path ('build/assets/dashboard/assets/vendor/css/core.css')}}" class="template-customizer-core-css" type="text/css" />
    <link rel="stylesheet" href="{{public_path ('build/assets/dashboard/assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" type="text/css" />
    <link rel="stylesheet" href="{{public_path ('build/assets/dashboard/assets/css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{public_path ('build/assets/dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" type="text/css"/>

    <link rel="stylesheet" href="{{public_path ('build/assets/dashboard/assets/vendor/libs/apex-charts/apex-charts.css')}}" type="text/css" />
</head>

<body>

    <div class="container-xxl flex-grow-1 container-p-y d-flex flex-column" style="min-height: 100vh;">
        <div class="row flex-grow-1">
            <div class="col-xl d-flex flex-column">
                <div class="card flex-grow-1 d-flex flex-column">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Facturas</h5>
                        <div>
                            <a href="{{ route('facturas.create') }}" class="btn btn-primary btn">PDF</a>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="table-responsive text-nowrap flex-grow-1">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Usuario</th>
                                    <th>Fecha</th>
                                    <th>Nota</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($facturas as $factura)
                                    <tr>
                                        <td>{{ $factura->id }}</td>
                                        <td>{{ $factura->user->name }}</td>
                                        <td>{{ $factura->fecha }}</td>
                                        <td>{{ $factura->nota }}</td>
                                        <td>{{ number_format($factura->total, 0, ',', '.') }} COP</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {!! $facturas->withQueryString()->links() !!}
            </div>
        </div>
    </div>
</body>
</html>
