@extends('layouts.auth.auth')

@section('content')

<!-- Content -->

<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
            <!-- Forgot Password -->
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
                    <h4 class="mb-2">¿Olvidaste tu contraseña? 🔒</h4>
                    <p class="mb-4">
                        Ingresa tu email y te enviaremos instrucciones para
                        restablecer tu contraseña
                    </p>

                    @session('status')
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ $value }}
                    </div>
                    @endsession

                    <x-validation-errors class="mb-4" />

                    <form
                        id="formAuthentication"
                        class="mb-3"
                        method="POST" action="{{ route('password.email') }}"
                    >
                    @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input
                                type="email"
                                class="form-control"
                                id="email"
                                name="email"
                                placeholder="Ingresa tu email"
                                required autofocus autocomplete="username"
                            />
                        </div>
                        <button class="btn btn-primary d-grid w-100" type="submit">
                            Enviar enlace de restablecimiento
                        </button>
                    </form>
                    <div class="text-center">
                        <a
                            href="{{route ('login')}}"
                            class="d-flex align-items-center justify-content-center"
                        >
                            <i
                                class="bx bx-chevron-left scaleX-n1-rtl bx-sm"
                            ></i>
                            Volver al inicio de sesión
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Forgot Password -->
        </div>
    </div>
</div>

<!-- / Content -->

@endsection
