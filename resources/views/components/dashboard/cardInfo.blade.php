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
                                <span class="badge bg-label-warning rounded-pill mb-2">Solicitudes pendientes:</span>
                                <small class="text-success text-nowrap fw-semibold">
                                    {{ $solicitudCount }}
                                </small>
                            </div>
                            <div class="mt-sm-auto d-flex">
                                <a href="{{ route('solicituds.create') }}"
                                    class="btn rounded-pill btn-primary me-2">Nueva solicitud</a>
                                <a href="{{ route('solicituds.index') }}" class="btn rounded-pill btn-primary">Ver
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
                                <h5 class="text-nowrap mb-2">Profile Report</h5>
                                <span class="badge bg-label-warning rounded-pill">Year 2021</span>
                            </div>
                            <div class="mt-sm-auto">
                                <small class="text-success text-nowrap fw-semibold">
                                    <i class="bx bx-chevron-up"></i> 68.2%
                                </small>
                                <h3 class="mb-0">$84,686k</h3>
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
                                <h5 class="text-nowrap mb-2">Profile Report</h5>
                                <span class="badge bg-label-warning rounded-pill">Year 2021</span>
                            </div>
                            <div class="mt-sm-auto">
                                <small class="text-success text-nowrap fw-semibold">
                                    <i class="bx bx-chevron-up"></i> 68.2%
                                </small>
                                <h3 class="mb-0">$84,686k</h3>
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
