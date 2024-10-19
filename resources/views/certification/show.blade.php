<x-app-layout>

    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Certification</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('certifications.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">

                                <div class="form-group mb-2 mb20">
                                    <strong>Ciudad:</strong>
                                    {{ $certification->ciudad }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Barrio:</strong>
                                    {{ $certification->barrio }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Direccion:</strong>
                                    {{ $certification->direccion }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Fecha De Vencimiento:</strong>
                                    {{ $certification->fecha_de_vencimiento }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
