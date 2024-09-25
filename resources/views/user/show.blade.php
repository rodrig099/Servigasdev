<x-app-layout>
    <section class="content">
        <div class="container-xxl flex-grow-1 container-p-y d-flex flex-column" style="min-height: 100vh;">
            <div class="row flex-grow-1">
                <div class="col-xl d-flex flex-column">
                    <div class="card flex-grow-1 d-flex flex-column">
                        <div class="card-header"
                            style="display: flex; justify-content: space-between; align-items: center;">
                            <div class="float-left">
                                <span class="card-title">Usuario</span>
                            </div>
                            <div class="float-right">
                                <a class="btn btn-outline-danger" href="{{ route('users.index') }}">
                                    {{ __('Back') }}</a>
                            </div>
                        </div>

                        <div class="card-body bg-white">

                            <div class="form-group mb-2 mb20">
                                <strong>Name:</strong>
                                {{ $user->name }}
                            </div>
                            <div class="form-group mb-2 mb20">
                                <strong>Email:</strong>
                                {{ $user->email }}
                            </div>
                            <div class="form-group mb-2 mb20">
                                <strong>Apellidos:</strong>
                                {{ $user->apellidos }}
                            </div>
                            <div class="form-group mb-2 mb20">
                                <strong>Direccion:</strong>
                                {{ $user->direccion }}
                            </div>
                            <div class="form-group mb-2 mb20">
                                <strong>Telefono:</strong>
                                {{ $user->telefono }}
                            </div>
                            <div class="form-group mb-2 mb20">
                                <strong>Barrio:</strong>
                                {{ $user->barrio }}
                            </div>
                            <div class="form-group mb-2 mb20">
                                <strong>Ciudad:</strong>
                                {{ $user->ciudad }}
                            </div>
                            <div class="form-group mb-2 mb20">
                                <strong>Departamento:</strong>
                                {{ $user->departamento }}
                            </div>
                            <div class="form-group mb-2 mb20">
                                <strong>Cedula:</strong>
                                {{ $user->cedula }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
