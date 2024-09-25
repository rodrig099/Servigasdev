<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y d-flex flex-column" style="min-height: 100vh;">
        <div class="row flex-grow-1">
            <div class="col-xl d-flex flex-column">
                <div class="card flex-grow-1 d-flex flex-column">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Facturas</h5>
                        <div>
                            <a href="{{ route('facturas.create') }}" class="btn btn-primary btn">
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
                                <thead >
                                    <tr>
                                        <th>No</th>
                                        <th>Usuario</th>
                                        <th>Fecha</th>
                                        <th>Nota</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($facturas as $factura)
                                        <tr>
                                            <td>{{ $factura->id }}</td>
                                            <td>{{ $factura->user->name }}</td>
                                            <td>{{ $factura->fecha }}</td>
                                            <td>{{ $factura->nota }}</td>
                                            <td>{{ $factura->total }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{ route('facturas.show', $factura->id) }}">
                                                            <i class="bx bx-show-alt me-1"></i> Ver
                                                        </a>
                                                        <a class="dropdown-item" href="{{ route('facturas.edit', $factura->id) }}">
                                                            <i class="bx bx-edit-alt me-1"></i> Editar
                                                        </a>
                                                        <a class="dropdown-item" href="javascript:void(0);" onclick="event.preventDefault(); showDeleteModal({{ $factura->id }});">
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
                {!! $facturas->withQueryString()->links() !!}
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
        function showDeleteModal(facturaId) {
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'), {});
            document.getElementById('confirmDelete').setAttribute('data-factura-id', facturaId);
            deleteModal.show();
        }

        document.getElementById('confirmDelete').addEventListener('click', function() {
            const facturaId = this.getAttribute('data-factura-id');
            const form = document.createElement('form');
            form.setAttribute('method', 'POST');
            form.setAttribute('action', `/facturas/${facturaId}`);
            form.innerHTML = `
                @csrf
                @method('DELETE')
            `;
            document.body.appendChild(form);
            form.submit();
        });
    </script>
</x-app-layout>
