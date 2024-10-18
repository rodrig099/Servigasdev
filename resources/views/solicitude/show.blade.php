<x-app-layout>
    <section class="content">
        <div class="container-xxl flex-grow-1 container-p-y d-flex flex-column" style="min-height: 100vh;">
            <div class="row flex-grow-1">
                <div class="col-xl d-flex flex-column">
                    <div class="card flex-grow-1 d-flex flex-column">

                        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                            <div class="float-left">
                                <h5 class="card-title">Ver Solicitud</h5>
                            </div>
                            <div class="float-right">
                                <a class="btn btn-outline-danger" href="{{ route('solicitudes.index') }}"> {{ __('Back') }}</a>
                            </div>
                        </div>

                        <div class="card-body bg-white">

                            <div class="form-group mb-2 mb20">
                                <strong>Número de solicitud:</strong>
                                {{ $solicitude->id }}
                            </div>
                            <div class="form-group mb-2 mb20">
                                <strong>Descripcion:</strong>
                                {{ $solicitude->descripcion }}
                            </div>
                            <div class="form-group mb-2 mb20">
                                <strong>Estatus:</strong>
                                {{ $solicitude->estatus }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
