<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y d-flex flex-column" style="min-height: 100vh;">
        <div class="row flex-grow-1">
            <div class="col-xl d-flex flex-column">
                <div class="card flex-grow-1 d-flex flex-column">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Solicitudes</h5>
                        <div>
                            <a href="{{ route('solicitudes.create') }}" class="btn btn-primary btn">
                                Crear
                            </a>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="container mb-3 flex-grow-1 d-flex flex-column">
                        <!-- Search -->
                        <div class="navbar-nav">
                            <div class="nav-item d-flex align-items-center">
                                <i class="bx bx-search fs-4 lh-0"></i>
                                <input type="text" class="form-control border-0 shadow-none" placeholder="Buscar..."
                                    aria-label="Search..." />
                            </div>
                        </div>
                        <!-- /Search -->

                        <div class="table-responsive text-nowrap flex-grow-1">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        @hasanyrole('Admin|Tecnico')
                                            <th>Usuario</th>
                                        @endhasanyrole
                                        <th>Tiposolicitudes Id</th>
                                        <th>Descripcion</th>
                                        <th>Estado</th>
                                        <th>Técnico Asignado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($solicitudes as $solicitude)
                                        <tr>
                                            <td>{{ $solicitude->id }}</td>
                                            @hasanyrole('Admin|Tecnico')
                                                <td>{{ $solicitude->user->name }}</td>
                                            @endhasanyrole
                                            <td>{{ $solicitude->tiposolicitude->nombreTipo }}</td>
                                            <td>{{ $solicitude->descripcion }}</td>
                                            <td>
                                                <span
                                                    class="badge
                                                @switch($solicitude->estatus)
                                                    @case('PENDIENTE') bg-label-danger
                                                    @break
                                                    @case('EN PROCESO') bg-label-warning
                                                    @break
                                                    @case('FINALIZADA') bg-label-success
                                                    @break
                                                    @default bg-label-primary
                                                @endswitch me-1">
                                                    {{ $solicitude->estatus }}
                                                </span>
                                            </td>

                                            <td>
                                                @if ($solicitude->tecnico)
                                                    {{ $solicitude->tecnico->name }}
                                                    {{ $solicitude->tecnico->apellidos }}
                                                @else
                                                    No asignado
                                                @endif
                                            </td>

                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('solicitudes.show', $solicitude->id) }}">
                                                            <i class="bx bx-show-alt me-1"></i> Ver
                                                        </a>
                                                        @hasanyrole('Admin|Tecnico')
                                                            <a class="dropdown-item"
                                                                href="{{ route('solicitudes.edit', $solicitude->id) }}">
                                                                <i class="bx bx-edit-alt me-1"></i> Editar
                                                            </a>
                                                        @endhasanyrole
                                                        @hasanyrole('Admin|Usuario')
                                                            @csrf
                                                            @method('DELETE')
                                                            <a class="dropdown-item" href="javascript:void(0);"
                                                                onclick="event.preventDefault(); showDeleteModal({{ $solicitude->id }});">
                                                                <i class="bx bx-trash me-1"></i> Eliminar
                                                            </a>
                                                        @endhasanyrole
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Modal de Error -->
                <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="errorModalLabel">¡Ups!</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="errorModalBody">
                                <!-- Mensaje de error se llenará aquí -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Confirmación de eliminación</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ¿Estás seguro de que quieres eliminar este registro?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-danger" id="confirmDelete">Eliminar</button>
                            </div>
                        </div>
                    </div>
                </div>


                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        @if (Session::has('error'))
                            // Mostrar el mensaje de error en el modal
                            const errorModal = new bootstrap.Modal(document.getElementById('errorModal'), {});
                            document.getElementById('errorModalBody').innerText = "{{ Session::get('error') }}";
                            errorModal.show();
                        @endif
                    });

                    function showDeleteModal(solicitudeId) {
                        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'), {});
                        document.getElementById('confirmDelete').setAttribute('data-solicitude-id', solicitudeId);
                        deleteModal.show();
                    }

                    document.getElementById('confirmDelete').addEventListener('click', function() {
                        const solicitudeId = this.getAttribute('data-solicitude-id');
                        const form = document.createElement('form');
                        form.setAttribute('method', 'POST');
                        form.setAttribute('action', `/solicitudes/${solicitudeId}`);
                        form.innerHTML = `
                            @csrf
                            @method('DELETE')
                        `;
                        document.body.appendChild(form);
                        form.submit();
                    });
                </script>
            </div>
        </div>
        {!! $solicitudes->links() !!}
    </div>
</x-app-layout>
