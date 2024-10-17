<x-app-layout>
    <script src="https://checkout.epayco.co/checkout.js"></script>

    <div class="container-xxl flex-grow-1 container-p-y d-flex flex-column" style="min-height: 100vh;">
        <div class="row flex-grow-1">
            <div class="col-xl d-flex flex-column">
                <div class="card flex-grow-1 d-flex flex-column">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Facturas</h5>
                        <div>
                            <a href="{{ route('facturas.create') }}" class="btn btn-primary btn">Crear</a>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="container mb-3">
                        <!-- Search -->
                    <div class="navbar-nav">
                        <div class="nav-item d-flex align-items-center">
                            <i class="bx bx-search fs-4 lh-0"></i>
                            <input
                                type="text"
                                class="form-control border-0 shadow-none"
                                placeholder="Buscar..."
                                aria-label="Search..." />
                        </div>
                    </div>
                    <!-- /Search -->

                    <div class="table-responsive text-nowrap flex-grow-1">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Usuario</th>
                                    <th>Fecha</th>
                                    <th>Nota</th>
                                    <th>Total</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($facturas as $factura)
                                    <tr>
                                        <td>{{ $factura->id }}</td>
                                        <td>{{ $factura->user->name }}</td>
                                        <td>{{ $factura->fecha }}</td>
                                        <td>{{ $factura->nota }}</td>
                                        <td>{{ number_format($factura->total, 0, ',', '.') }} COP</td>
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
                                                    <a class="dropdown-item" href="javascript:void(0);" onclick="event.preventDefault(); payInvoice({{ $factura->id }}, {{ str_replace('.', '', $factura->total) }});">
                                                        <i class="bx bx-money me-1"></i> Pagar
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

        function payInvoice(facturaId, total) {
            var handler = ePayco.checkout.configure({
                key: '4fedd7f52621ba75db369876657c8a88', // Cambia a tu clave pública de Epayco desde el archivo de configuración
                test: false // Cambia a false cuando estés en producción
            });

            var data = {
                name: $factura->user->name, // Nombre del cliente (de la factura)
                description: 'Pago de factura ' + facturaId,
                invoice: facturaId,
                currency: 'COP',
                amount: total, // Total de la factura
                tax_base: 0, // Si no hay impuestos, puedes dejarlo en 0
                tax: 0, // Si no hay impuestos, puedes dejarlo en 0
                country: 'CO',
                lang: 'es',
                response: 'http://127.0.0.1:8000/payment-success', // URL de respuesta
                confirmation: 'http://127.0.0.1:8000/payment-confirmation', // URL de confirmación
                email_billing: $factura->user->email , // Email del cliente (de la factura)
                mobilephone_billing: $factura->user->telefono, // Teléfono del cliente (de la factura)
                address_billing:  $factura->user->direccion , // Dirección del cliente (de la factura)
                number_doc_billing: $factura->user->cedula, // Número de documento (de la factura)
            };

            handler.open(data);
        }
    </script>
</x-app-layout>
