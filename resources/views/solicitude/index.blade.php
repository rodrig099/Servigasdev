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

                    <div class="table-responsive text-nowrap flex-grow-1">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Solicitud</th>
                                    <th>Mensaje</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($solicituds as $solicitud)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <!-- Acceder al nombre del tipo de solicitud a través de la relación -->
                                        <td>{{ $solicitud->tiposolicitude->nombreTipo }}</td>
                                        <td>{{ $solicitud->descripcion }}</td>
                                        <td>
                                            <span class="badge
                                            @switch($solicitud->estatus)
                                                @case('PENDIENTE') bg-label-danger
                                                @break
                                                @case('EN PROCESO') bg-label-warning
                                                @break
                                                @case('FINALIZADA') bg-label-success
                                                @break
                                                @default bg-label-primary
                                            @endswitch me-1">
                                                {{ $solicitud->estatus}}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('solicitudes.show', $solicitud->id) }}">
                                                        <i class="bx bx-show-alt me-1"></i> Ver
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('solicitudes.edit', $solicitud->id) }}">
                                                        <i class="bx bx-edit-alt me-1"></i> Editar
                                                    </a>
                                                    <a class="dropdown-item" href="javascript:void(0);" onclick="event.preventDefault(); showDeleteModal({{ $solicitud->id }});">
                                                        <i class="bx bx-trash me-1"></i> Eliminar
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="container p-5">{!! $solicituds->withQueryString()->links() !!}</div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmación de eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que quieres eliminar este registro?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let deleteFormAction;

        function showDeleteModal(id) {
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'), {
                keyboard: false
            });
            deleteFormAction = `{{ route('solicitudes.destroy', '') }}/${id}`;
            deleteModal.show();
        }

        document.getElementById('confirmDelete').addEventListener('click', function() {
            const form = document.createElement('form');
            form.action = deleteFormAction;
            form.method = 'POST';

            const csrfField = document.createElement('input');
            csrfField.type = 'hidden';
            csrfField.name = '_token';
            csrfField.value = '{{ csrf_token() }}';
            form.appendChild(csrfField);

            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';
            form.appendChild(methodField);

            document.body.appendChild(form);
            form.submit();
        });
    </script>
</x-app-layout>
