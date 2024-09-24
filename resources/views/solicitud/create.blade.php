<x-app-layout>
    <section class="content">
        <div class="container-xxl flex-grow-1 container-p-y d-flex flex-column" style="min-height: 100vh;">
            <div class="row flex-grow-1">
                <div class="col-xl d-flex flex-column">
                    <div class="card flex-grow-1 d-flex flex-column">
                        <div class="card-default">
                            <div class="card-header">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <div class="float-left">
                                        <h5 class="card-title">Crear Solicitud</h5>
                                    </div>
                                    <div class="float-right">
                                        <a class="btn btn-outline-danger" href="{{ route('solicituds.index') }}"> {{ __('Back') }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body bg-white">
                                <form method="POST" action="{{ route('solicituds.store') }}" role="form" enctype="multipart/form-data">

                                    @csrf

                                    @include('solicitud.form')

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
