<x-app-layout>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <h3>Tecnico</h3>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('tarjetapros.index') }}"> {{ __('Regresar') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Nombres:</strong>
                                    {{ $tarjetapro->user->name }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Apellidos:</strong>
                                    {{ $tarjetapro->user->apellidos }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Cedula:</strong>
                                    {{ $tarjetapro->user->cedula }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Telefono:</strong>
                                    {{ $tarjetapro->user->telefono }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Codigo:</strong>
                                    {{ $tarjetapro->codigo }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Expedido Por:</strong>
                                    {{ $tarjetapro->expedido }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Vigencia:</strong>
                                    {{ $tarjetapro->vigencia }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
