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
    <link rel="icon" type="image/x-icon" href="{{ asset('build/assets/dashboard/assets/img/favicon/favicon.ico') }}" />

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
    <link rel="stylesheet" href="{{ asset('build/assets/dashboard/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('build/assets/dashboard/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('build/assets/dashboard/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('build/assets/dashboard/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('build/assets/dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('build/assets/dashboard/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('build/assets/dashboard/assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('build/assets/dashboard/assets/js/config.js') }}"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="#" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <img src="{{ asset('build/assets/dashboard/assets/img/favicon/logo.png') }}" alt="Logo"
                                style="width: 22px; height: 30px;">
                        </span>
                        <span class="app-brand-text demo menu-text fw-bolder ms-2">Servigas del Huila</span>
                    </a>
                    <a href="javascript:void(0);"
                        class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    @hasanyrole('Admin|Usuario')
    <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                                    <a href="{{ route('dashboard') }}" class="menu-link">
                                                        <i class="menu-icon tf-icons bx bx-home-circle"></i>
                                                        <div data-i18n="Analytics">Dashboard</div>
                                                    </a>
                                                </li>
@endhasanyrole

                    <li
                        class="menu-item {{ request()->is('solicitudes') ? 'active' : '' }} {{ request()->is('solicitudes/create') ? 'active' : '' }}">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-edit"></i>
                            <div data-i18n="Layouts">Solicitudes</div>
                        </a>
                        <ul class="menu-sub">
                            @hasrole('Admin')
    <li class="menu-item {{ request()->is('tiposolicitudes') ? 'active' : '' }}">
                                                            <a href="{{ url('tiposolicitudes') }}" class="menu-link">
                                                                <div data-i18n="Without menu">Tipo de Solicitud</div>
                                                            </a>
                                                        </li>
@endhasrole
                            @hasanyrole('Admin|Usuario')
    <li class="menu-item {{ request()->is('solicitudes/create') ? 'active' : '' }}">
                                                            <a href="{{ url('solicitudes/create') }}" class="menu-link">
                                                                <div data-i18n="Without menu">Nueva solicitud</div>
                                                            </a>
                                                        </li>
@endhasanyrole
                            @hasanyrole('Admin|Usuario|Tecnico')
    <li class="menu-item {{ request()->is('solicitudes') ? 'active' : '' }}">
                                                            <a href="{{ url('solicitudes') }}" class="menu-link">
                                                                <div data-i18n="Without navbar">Mis solicitudes</div>
                                                            </a>
                                                        </li>
@endhasanyrole
                        </ul>
                    </li>

                    @hasrole('Admin')
    <li
                                                class="menu-item {{ request()->is('facturas') ? 'active' : '' }} {{ request()->is('cotizaciones') ? 'active' : '' }}">
                                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                                    <i class="menu-icon tf-icons bx bx-archive"></i>
                                                    <div data-i18n="Layouts">Facturación</div>
                                                </a>
                                                <ul class="menu-sub">
                                                    <li class="menu-item {{ request()->is('facturas') ? 'active' : '' }}">
                                                        <a href="{{ url('facturas') }}" class="menu-link">
                                                            <div data-i18n="Without menu">Facturas</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item {{ request()->is('cotizaciones') ? 'active' : '' }}">
                                                        <a href="{{ url('cotizaciones') }}" class="menu-link">
                                                            <div data-i18n="Without navbar">Cotizaciones</div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="menu-item {{ request()->is('users') ? 'active' : '' }}">
                                                <a href="{{ url('/users') }}" class="menu-link">
                                                    <i class="menu-icon tf-icons bx bx-group"></i>
                                                    <div data-i18n="Analytics">Usuarios</div>
                                                </a>
                                            </li>
                                            <li class="menu-item {{ request()->is('usuarios') ? 'active' : '' }}">
                                                <a href="{{ url('usuarios') }}" class="menu-link">
                                                    <i class="menu-icon tf-icons bx bx-building-house"></i>
                                                    <div data-i18n="Analytics">Roles y Permisos</div>
                                                </a>
                                            </li>
                                            <li class="menu-item {{ request()->is('tarjetapros') ? 'active' : '' }}">
                                                <a href="{{ url('/tarjetapros') }}" class="menu-link">
                                                    <i class="menu-icon tf-icons bx bx-id-card"></i>
                                                    <div data-i18n="Analytics">Tarjeta Profesional</div>
                                                </a>
                                            </li>
@endhasrole

                    @hasrole('Admin|Tecnico|Usuario')
    <li class="menu-item {{ request()->is('usuarios') ? 'active' : '' }}">
                                                            </li>
                                                                                        <li class="menu-item {{ request()->is('files') ? 'active' : '' }}">
                                                                                            <a href="{{ url('files') }}" class="menu-link">
                                                                                            <i class="menu-icon tf-icons bx bx-archive"></i>
                                                                                                <div data-i18n="Analytics">Archivos</div>
                                                                                            </a>
                                                                                        </li>
@endhasrole

                    @hasanyrole('Admin|Usuario|Tecnico')
    <li class="menu-item {{ request()->is('user/profile') ? 'active' : '' }}">
                                                                                            <a href="{{ url('user/profile') }}" class="menu-link">
                                                                                                <i class="menu-icon tf-icons bx bx-user"></i>
                                                                                                <div data-i18n="Analytics">Perfil</div>
                                                                                            </a>
                                                                                        </li>
@endhasanyrole
                </ul>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">

                @livewire('navigation-menu')

                <!-- Content wrapper -->
                <div class="content-wrapper">

                    <!-- Page Content -->
                    <main>
                        {{ $slot }}
                    </main>

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('build/assets/dashboard/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('build/assets/dashboard/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('build/assets/dashboard/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('build/assets/dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('build/assets/dashboard/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('build/assets/dashboard/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('build/assets/dashboard/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('build/assets/dashboard/assets/js/dashboards-analytics.js') }}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
