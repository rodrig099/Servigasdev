<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <!-- Tarjeta 1 -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                        <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                            <div class="card-title">
                                <h5 class="text-nowrap mb-3">Solicitudes</h5>
                                <span class="badge bg-label-warning rounded-pill mb-2">Pendientes:</span>
                                <small class="text-success text-nowrap fw-semibold">
                                    {{ $pendientesCount }}
                                </small>
                            </div>
                            <div class="mt-sm-auto d-flex">
                                <a href="{{ route('solicitudes.create') }}"
                                    class="btn rounded-pill btn-primary me-2">Nueva solicitud</a>
                                <a href="{{ route('solicitudes.index') }}" class="btn rounded-pill btn-primary">Ver
                                    solicitudes</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tarjeta 1 -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                        <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                            <div class="card-title">
                                <h5 class="text-nowrap mb-3">Facturas</h5>
                                <span class="badge bg-label-warning rounded-pill mb-2">Realizadas</span>
                                <small class="text-success text-nowrap fw-semibold">
                                    {{ $facturaCount }}
                                </small>
                            </div>
                            <div class="mt-sm-auto d-flex">
                                <a href="{{ route('solicitudes.create') }}"
                                    class="btn rounded-pill btn-primary me-2">Generar Factura</a>
                                <a href="{{ route('solicitudes.index') }}" class="btn rounded-pill btn-primary">Ver
                                    Facturas</a>
                            </div>
                        </div>
                        <div id="profileReportChart1">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tarjeta 1 -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                        <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                            <div class="card-title">
                                <h5 class="text-nowrap mb-3">Vencimiento de certificación</h5>
                                <span class="badge bg-label-success rounded-pill mb-2">Al día: 03/10/2029</span>
                                <br>
                                <span class="badge bg-label-danger rounded-pill mb-2">Vencida: 03/10/2024</span>
                            </div>
                            <div class="mt-sm-auto d-flex">
                                <a href="{{ route('solicitudes.create') }}"
                                    class="btn rounded-pill btn-primary me-2">Generar Factura</a>
                            </div>
                        </div>
                        <div id="profileReportChart1">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
