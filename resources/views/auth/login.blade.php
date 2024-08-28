@extends('layouts.auth.auth')

@section('content')

<!-- Content -->

<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Register -->
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center">
                        <a href="/" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                <a class="app-brand-link">
                                    <span class="app-brand-logo demo m-2">
                                    <img src="{{asset('build/assets/dashboard/assets/img/favicon/logo.png')}}" alt="Logo" style="width: 32px; height: 38px;">
                                    </span>
                                    <span class="app-brand-text demo text-body fw-bolder">Servigas del Huila</span>
                                </a>
                            </span>

                        </a>
                    </div>
                    <!-- /Logo -->
                    <h4 class="mb-2">Bienvenido 👋</h4>
                    <p class="mb-4">Ingresa al Centro de Experiencia Virtual</p>

                    <x-validation-errors class="mb-4" />

                    <form id="formAuthentication" class="mb-3" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input
                                type="email"
                                class="form-control"
                                id="email"
                                name="email"
                                placeholder="Enter your email or username"
                                autofocus />
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">Contraseña</label>
                                @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">
                                    <small>¿Has olvidado tu contraseña?</small>
                                </a>
                                @endif
                            </div>
                            <div class="input-group input-group-merge">
                                <input
                                    type="password"
                                    id="password"
                                    class="form-control"
                                    name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember_me" name="remember" />
                                <label class="form-check-label" for="remember_me"> Recordarme </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                        </div>
                    </form>

                    <p class="text-center">
                        <span>Eres nuevo?</span>
                        <a href="{{ route('register') }}">
                            <span>Crear una cuenta</span>
                        </a>
                    </p>
                </div>
            </div>
            <!-- /Register -->
        </div>
    </div>
</div>

<!-- / Content -->

@endsection
