<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y d-flex flex-column" style="min-height: 100vh;">
        <div class="row flex-grow-1">
            <div class="col-xl d-flex flex-column">
                <div class="card flex-grow-1 d-flex flex-column">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <h5 class="card-title">Ver Solicitud</h5>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-outline-danger" href="{{ route('solicituds.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>


                    <div class="card-body bg-white">

                        <div class="form-group mb-2 mb20">
                            <strong>Solicitud:</strong>
                            {{ $solicitud->solicitud }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Mensaje:</strong>
                            {{ $solicitud->mensaje }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
