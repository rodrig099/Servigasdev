@extends('layouts.auth.auth')

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-innere">
                <!-- Register Card -->
                <div class="card" style="max-width: 500px; margin: auto;">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="/" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <a class="app-brand-link">
                                        <span class="app-brand-logo demo m-2">
                                            <img src="{{ asset('build/assets/dashboard/assets/img/favicon/logo.png') }}" alt="Logo" style="width: 32px; height: 38px;">
                                        </span>
                                        <span class="app-brand-text demo text-body fw-bolder">Servigas del Huila</span>
                                    </a>
                                </span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">Haz parte de Servigas del Huila</h4>
                        <p class="mb-4">¡Gestiona tus proyectos desde nuestro centro de experiencia virtual!</p>
                        <x-validation-errors class="mb-4" />

                        <form method="POST" id="formAuthentication" class="mb-3" action="{{ route('register') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Nombre" required autofocus autocomplete="name" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="apellidos" class="form-label">Apellidos</label>
                                    <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos" required autocomplete="family-name" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="direccion" class="form-label">Dirección</label>
                                    <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección" required autocomplete="address-line1" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="telefono" class="form-label">Teléfono</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono" required autocomplete="tel" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="barrio" class="form-label">Barrio</label>
                                    <input type="text" class="form-control" id="barrio" name="barrio" placeholder="barrio" required autocomplete="barrio-level2" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="ciudad" class="form-label">Ciudad</label>
                                    <input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="Ciudad" required autocomplete="address-level2" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="departamento" class="form-label">Departamento</label>
                                    <input type="text" class="form-control" id="departamento" name="departamento" placeholder="Departamento" required autocomplete="address-level1" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="cedula" class="form-label">Número de Cédula</label>
                                    <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Número de Cédula" required autocomplete="off" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required autocomplete="username" />
                                </div>
                                <div class="col-md-6 mb-3 form-password-toggle">
                                    <label class="form-label" for="password">Contraseña</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" required autocomplete="new-password" />
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 form-password-toggle">
                                    <label class="form-label" for="password_confirmation">Confirmar Contraseña</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" required autocomplete="new-password" />
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                </div>
                            </div>

                            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="terms" id="terms" required />
                                        <div class="ms-2">
                                            {!! __('Estoy de acuerdo con los :terms_of_service y las :privacy_policy', [
                                                'terms_of_service' => '<a target="_blank" href="' . route('terms.show') . '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' . __('Terminos y Condiciones') . '</a>',
                                                'privacy_policy' => '<a target="_blank" href="' . route('policy.show') . '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' . __('Seguridad y Privacidad') . '</a>',
                                            ]) !!}
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <button class="btn btn-primary d-grid w-100" type="submit">{{ __('Register') }}</button>
                        </form>

                        <p class="text-center">
                            <span>¿Ya tienes una cuenta?</span>
                            <a href="{{ route('login') }}">
                                <span>Iniciar sesión</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- Register Card -->
            </div>
        </div>
    </div>

    <!-- / Content -->
@endsection
