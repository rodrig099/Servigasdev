<div class="container">
    <div class="card">
        <div class="card-header">
            <h5>Crear Factura</h5>
        </div>
        <div class="card-body">
            <form id="invoice-form" action="{{ route('facturas.store') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="user_id" class="form-label">Seleccionar Usuario</label>
                        <select name="user_id" id="user_id" class="form-control" required>
                            <option value="">Seleccione un usuario</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" name="fecha" id="fecha" class="form-control" required />
                    </div>

                    <div class="col-md-4">
                        <label for="nota" class="form-label">Instrucciones</label>
                        <textarea name="nota" id="nota" class="form-control" placeholder="Escribe aquí las notas o instrucciones"></textarea>
                    </div>
                </div>

                <!-- Detalles Dinámicos -->
                <h5>Detalles de la Factura</h5>
                <div id="details-container">
                    <div class="row mb-3">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <input type="number" name="detalles[0][cantidad]" class="form-control" placeholder="Cantidad" value="{{ old('cantidad', $detalle?->cantidad) }}" required />
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="detalles[0][descripcion]" class="form-control" placeholder="Descripción" required />
                            </div>
                            <div class="col-md-2">
                                <input type="number" name="detalles[0][precio_unitario]" class="form-control" placeholder="Precio Unitario" required />
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="detalles[0][precio_total]" class="form-control" placeholder="Precio Total" disabled />
                            </div>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-success" id="add-details">Agregar Detalle</button>
                <div class="mt-3">
                    <strong>Total: </strong><span id="total-amount">0 COP</span>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Generar Factura</button>
            </form>
        </div>
    </div>

    <!-- Modal para nuevo usuario -->
    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Registrar Nuevo Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="modal-fullname">Nombre</label>
                            <input type="text" class="form-control" id="modal-fullname" placeholder="Nombre" />
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="modal-address">Dirección</label>
                            <input type="text" class="form-control" id="modal-address" placeholder="Dirección" />
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="modal-city">Ciudad</label>
                            <input type="text" class="form-control" id="modal-city" placeholder="Ciudad" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success" id="save-modal">Guardar</button>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    document.getElementById('add-details').addEventListener('click', function() {
        const container = document.getElementById('details-container');
        const count = container.children.length;
        if (count >= 10) {
            alert('No se pueden agregar más detalles.');
            return;
        }

        const newDetail = document.createElement('div');
        newDetail.className = 'row mb-3';
        newDetail.innerHTML = `
            <div class="col-md-3">
                <input type="number" name="detalles[${count}][cantidad]" class="form-control" placeholder="Cantidad" required />
            </div>
            <div class="col-md-4">
                <input type="text" name="detalles[${count}][descripcion]" class="form-control" placeholder="Descripción" required />
            </div>
            <div class="col-md-2">
                <input type="number" name="detalles[${count}][precio_unitario]" class="form-control" placeholder="Precio Unitario" required />
            </div>
            <div class="col-md-3">
                <input type="text" name="detalles[${count}][precio_total]" class="form-control" placeholder="Precio Total" disabled />
            </div>
        `;
        container.appendChild(newDetail);
    });

    document.getElementById('details-container').addEventListener('input', function(e) {
        if (e.target.matches('input[name*="cantidad"], input[name*="precio_unitario"]')) {
            updateTotal();
        }
    });

    function updateTotal() {
        const rows = document.querySelectorAll('#details-container .row');
        let total = 0;

        rows.forEach(row => {
            const cantidad = parseFloat(row.querySelector('input[name*="cantidad"]').value) || 0;
            const precioUnitario = parseFloat(row.querySelector('input[name*="precio_unitario"]').value) || 0;
            const precioTotalField = row.querySelector('input[name*="precio_total"]');

            const precioTotal = cantidad * precioUnitario;
            precioTotalField.value = precioTotal.toFixed(2);

            total += precioTotal;
        });

        document.getElementById('total-amount').textContent = total.toFixed(2) + ' COP';
    }
</script>
