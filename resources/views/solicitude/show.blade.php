<x-app-layout>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Solicitude</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('solicitudes.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                        <div class="form-group mb-2 mb20">
                            <strong>Tiposolicitudes Id:</strong>
                            {{ $solicitude->tiposolicitudes_id }}
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
    </section>
</x-app-layout>
