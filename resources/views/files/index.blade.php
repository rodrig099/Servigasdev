<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y d-flex flex-column" style="min-height: 100vh;">
        <div class="row flex-grow-1">
            <div class="col-xl d-flex flex-column">
                <div class="card flex-grow-1 d-flex flex-column">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Lista de Archivos</h5>
                        <div>
                            <a href="{{ route('files.create') }}" class="btn btn-primary btn">
                                Subir Nuevo Archivo
                            </a>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success m-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="container mb-3">
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

                    <div class="table-responsive text-nowrap flex-grow-1">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre del Archivo</th>
                                    @hasanyrole('Admin|Tecnico')
                                        <th>Usuario</th>
                                        <th>Rol</th>
                                    @endhasanyrole
                                    <th>Fecha de Subida</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($files as $file)
                                    <tr>
                                        <td>{{ $file->name }}</td>
                                        @hasanyrole('Admin|Tecnico')
                                            <td>{{ $file->user->name . ' ' . $file->user->apellidos ?? 'Desconocido' }}</td>
                                            <td>
                                                @if ($file->user->hasRole('Admin'))
                                                    Administrador
                                                @elseif($file->user->hasRole('Tecnico'))
                                                    Técnico
                                                @else
                                                    Usuario
                                                @endif
                                            </td>
                                        @endhasanyrole
                                        <td>{{ \Carbon\Carbon::parse($file->created_at)->setTimezone('America/Bogota')->locale('es')->isoFormat('D [de] MMMM [de] YYYY, h:mm A') }}
                                        </td>
                                        <td>
                                            <a href="{{ Storage::url($file->path) }}" target="_blank"
                                                class="btn btn-secondary">Ver</a>
                                            <a href="{{ route('files.download', $file->id) }}"
                                                class="btn btn-primary">Descargar</a>
                                            <button type="button" class="btn btn-danger"
                                                onclick="showDeleteModal('{{ $file->id }}', '{{ $file->name }}')">
                                                Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {!! $files->links() !!} <!-- Paginación si se está utilizando -->

        <!-- Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirmación de eliminación</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro de que quieres eliminar el archivo "<span id="fileName"></span>"?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" id="confirmDelete">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        let deleteFormAction;

        function showDeleteModal(id, name) {
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'), {
                keyboard: false
            });
            deleteFormAction = `{{ route('files.destroy', '') }}/${id}`;
            document.getElementById('fileName').innerText = name; // Actualiza el nombre del archivo en el modal
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
