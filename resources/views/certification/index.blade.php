<x-app-layout>

    <div class="container-xxl flex-grow-1 container-p-y d-flex flex-column" style="min-height: 100vh;">
        <div class="row flex-grow-1">
            <div class="col-xl d-flex flex-column">
                <div class="card flex-grow-1 d-flex flex-column">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Certificaciones</h5>
                        <div>
                            <a href="{{ route('certifications.create') }}" class="btn btn-primary btn">Crear</a>
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
                                        <th>Ciudad</th>
                                        <th>Barrio</th>
                                        <th>Direccion</th>
                                        <th>Fecha De Vencimiento</th>
                                        <th>Días Restantes</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($certifications as $certification)
                                        <tr>
                                            <td>{{ $certification->id }}</td>
                                            @hasanyrole('Admin|Tecnico')
                                                <td>{{ $solicitude->user->name }}</td>
                                            @endhasanyrole
                                            <td>{{ $certification->ciudad }}</td>
                                            <td>{{ $certification->barrio }}</td>
                                            <td>{{ $certification->direccion }}</td>
                                            <td>
                                                <span
                                                    class="expiration-date">{{ $certification->fecha_de_vencimiento }}</span>
                                            </td>
                                            <td>
                                                <span class="days-remaining"
                                                    data-expiration="{{ $certification->fecha_de_vencimiento }}"></span>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{ route('certifications.show', $certification->id) }}">
                                                            <i class="bx bx-show-alt me-1"></i> Ver
                                                        </a>
                                                        <a class="dropdown-item" href="{{ route('certifications.edit', $certification->id) }}">
                                                            <i class="bx bx-edit-alt me-1"></i> Editar
                                                        </a>
                                                        <a class="dropdown-item" href="javascript:void(0);" onclick="event.preventDefault(); showDeleteModal({{ $certification->id }});">
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
                </div>
            </div>
        </div>
        {!! $certifications->links() !!}
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
        function showDeleteModal(certificationId) {
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'), {});
            document.getElementById('confirmDelete').setAttribute('data-certification-id', certificationId);
            deleteModal.show();
        }

        document.getElementById('confirmDelete').addEventListener('click', function() {
            const certificationId = this.getAttribute('data-certification-id');
            const form = document.createElement('form');
            form.setAttribute('method', 'POST');
            form.setAttribute('action', `/certifications/${certificationId}`);
            form.innerHTML = `
                @csrf
                @method('DELETE')
            `;
            document.body.appendChild(form);
            form.submit();
        });

        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.days-remaining');
            elements.forEach(function(element) {
                const expirationDate = new Date(element.getAttribute('data-expiration'));
                const today = new Date();
                const timeDiff = expirationDate - today;
                const daysRemaining = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));

                let color = 'green';
                if (daysRemaining <= 5) {
                    color = 'red';
                } else if (daysRemaining <= 30) {
                    color = 'orange';
                }

                element.style.color = color;
                element.textContent = daysRemaining + ' días';
            });
        });
    </script>
</x-app-layout>
