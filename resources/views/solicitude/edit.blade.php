<x-app-layout>
    <section class="content">
        <div class="container-xxl flex-grow-1 container-p-y d-flex flex-column" style="min-height: 100vh;">
            <div class="row flex-grow-1">
                <div class="col-xl d-flex flex-column">
                    <div class="card flex-grow-1 d-flex flex-column">

                        <div class="card-header">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <div class="float-left">
                                    <h5 class="card-title">Editar Solicitud</h5>
                                </div>
                                <div class="float-right">
                                    <a class="btn btn-outline-danger" href="{{ route('solicitudes.index') }}"> {{ __('Back') }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body bg-white">
                            <form method="POST" action="{{ route('solicitudes.update', $solicitude->id) }}"
                                role="form" enctype="multipart/form-data">
                                {{ method_field('PATCH') }}
                                @csrf

                                @include('solicitude.form-edit')

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
