<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y d-flex flex-column" style="min-height: 100vh;">
        <div class="row flex-grow-1">
            <div class="col-xl d-flex flex-column">
                <div class="card flex-grow-1 d-flex flex-column">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Tecnicos Tejeta Profesional</h5>
                        <div>
                            <a href="{{ route('tarjetapros.create') }}" class="btn btn-primary btn">
                                Crear
                            </a>
                        </div>
                    </div>

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>

                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>Codigo</th>
                                        <th>Expedido</th>
                                        <th>Vigencia</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tarjetapros as $tarjetapro)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $tarjetapro->user->name }}</td>
                                            <td>{{ $tarjetapro->user->apellidos }}</td>
                                            <td>{{ $tarjetapro->codigo }}</td>
                                            <td>{{ $tarjetapro->expedido }}</td>
                                            <td>{{ $tarjetapro->vigencia }}</td>

                                            <td>
                                                <div class="dropdown">
                                                    <form action="{{ route('tarjetapros.destroy', $tarjetapro->id) }}"
                                                        method="POST">
                                                        <button type="button"
                                                            class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item"
                                                                href="{{ route('tarjetapros.show', $tarjetapro->id) }}">
                                                                <i class="bx bx-show-alt me-1"></i> Ver
                                                            </a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('tarjetapros.edit', $tarjetapro->id) }}">
                                                                <i class="bx bx-edit-alt me-1"></i> Editar
                                                            </a>
                                                            @csrf
                                                            @method('DELETE')
                                                            <a class="dropdown-item" href="javascript:void(0);"
                                                                onclick="event.preventDefault(); showDeleteModal({{ $tarjetapro->id }});">
                                                                <i class="bx bx-trash me-1"></i> Eliminar
                                                            </a>
                                                        </div>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $tarjetapros->withQueryString()->links() !!}

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

            </div>
        </div>
    </div>

    <script>
        let deleteFormAction;

        function showDeleteModal(id) {
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'), {
                keyboard: false
            });
            deleteFormAction = `{{ route('tarjetapros.destroy', '') }}/${id}`;
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
