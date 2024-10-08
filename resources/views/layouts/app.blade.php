<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light-style layout-menu-fixed" dir="ltr"
    data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon"
        href="{{ asset('build/assets/dashboard/assets/img/favicon/favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('build/assets/dashboard/assets/vendor/fonts/boxicons.css') }}">

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('build/assets/dashboard/assets/vendor/css/core.css') }}"
        class="template-customizer-core-css">
    <link rel="stylesheet" href="{{ asset('build/assets/dashboard/assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css">
    <link rel="stylesheet" href="{{ asset('build/assets/dashboard/assets/css/demo.css') }}">

    <!-- Vendors CSS -->
    <link rel="stylesheet"
        href="{{ asset('build/assets/dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/dashboard/assets/vendor/libs/apex-charts/apex-charts.css') }}">

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('build/assets/dashboard/assets/vendor/js/helpers.js') }}"></script>

    <!-- Config: Mandatory theme config file contain global vars & default theme options -->
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
                        <li class="menu-item {{ request()->is('usuarios') ? 'active' : '' }}">
                            <a href="{{ url('usuarios') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-building-house"></i>
                                <div data-i18n="Analytics">Instalaciones</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('users') ? 'active' : '' }}">
                            <a href="{{ url('/users') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-group"></i>
                                <div data-i18n="Analytics">Usuarios</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('tarjetapros') ? 'active' : '' }}">
                            <a href="{{ url('/tarjetapros') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-group"></i>
                                <div data-i18n="Analytics">Tecnicos</div>
                            </a>
                        </li>
                    @endhasrole

                    @hasrole('Admin')
                        <li class="menu-item {{ request()->is('usuarios') ? 'active' : '' }}">
                            <a href="{{ url('usuarios') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-id-card"></i>
                                <div data-i18n="Analytics">Roles y Permisos</div>
                            </a>
                        </li>
                    @endhasrole

                    @hasanyrole('Admin|Usuario|Tecnico')
                        <li class="menu-item {{ request()->is('configuracion') ? 'active' : '' }}">
                            <a href="{{ url('configuracion') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-cog"></i>
                                <div data-i18n="Analytics">Configuraciones</div>
                            </a>
                        </li>
                    @endhasanyrole
                </ul>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Search -->
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item d-flex align-items-center">
                                <i class="bx bx-search fs-4 lh-0"></i>
                                <input type="text" class="form-control border-0 shadow-none"
                                    placeholder="Search..." aria-label="Search">
                            </div>
                        </div>
                        <!-- /Search -->

                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('build/assets/dashboard/assets/img/avatars/1.png') }}" alt
                                            class="w-px-40 h-auto rounded-circle">
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="{{ asset('build/assets/dashboard/assets/img/avatars/1.png') }}"
                                                            alt class="w-px-40 h-auto rounded-circle">
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                                                    <small
                                                        class="text-muted">{{ Auth::user()->roles->pluck('name')->implode(', ') }}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('profile.show') }}">
                                            <i class="bx bx-user me-2"></i>
                                            <span class="align-middle">Perfil</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="bx bx-cog me-2"></i>
                                            <span class="align-middle">Configuraciones</span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="bx bx-power-off me-2"></i>
                                            <span class="align-middle">Cerrar sesión</span>
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <!-- Your content goes here -->
                        @yield('content')
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div
                            class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                            <div class="mb-2 mb-md-0">
                                &copy;
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>, made with ❤️ by Servigas del Huila.
                            </div>
                            <div>
                                <a href="#" class="footer-link me-4">Help</a>
                                <a href="#" class="footer-link me-4">Contact</a>
                                <a href="#" class="footer-link me-4">Terms & Conditions</a>
                                <a href="#" class="footer-link me-4">Privacy Policy</a>
                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- / Content wrapper -->
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

    @livewireScripts

</body>

</html>
