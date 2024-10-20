<x-app-layout>
    <div class="container-fluid flex-grow-1 container-p-y d-flex flex-column" style="min-height: 100vh;">
        <div class="row flex-grow-1">
            <div class="col-xl d-flex flex-column">
                <div class="card flex-grow-1 d-flex flex-column">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Usuarios</h5>
                        <div>
                            <a href="{{ route('users.create') }}" class="btn btn-primary btn">
                                Crear
                            </a>
                        </div>
                    </div>
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
                    </div>

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="table-responsive text-nowrap flex-grow-1" style="max-width: 100%;">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Telefono</th>
                                    <th>Cedula</th>
                                    <th>Ciudad</th>
                                    <th>Departamento</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->apellidos }}</td>
                                        <td>{{ $user->telefono }}</td>
                                        <td>{{ $user->cedula }}</td>
                                        <td>{{ $user->ciudad }}</td>
                                        <td>{{ $user->departamento }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('users.show', $user->id) }}">
                                                            <i class="bx bx-show-alt me-1"></i> Ver
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('users.edit', $user->id) }}">
                                                            <i class="bx bx-edit-alt me-1"></i> Editar
                                                        </a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <a class="dropdown-item" href="javascript:void(0);"
                                                            onclick="event.preventDefault(); showDeleteModal({{ $user->id }});">
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
            {!! $users->withQueryString()->links() !!}

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
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-danger" id="confirmDelete">Eliminar</button>
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
            deleteFormAction = `{{ route('users.destroy', '') }}/${id}`;
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
