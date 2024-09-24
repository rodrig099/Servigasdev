<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y d-flex flex-column" style="min-height: 100vh;">
        <div class="row flex-grow-1">
            <div class="col-xl d-flex flex-column">
                <div class="card flex-grow-1 d-flex flex-column">
                    <!-- Cotización Layout -->
                    <div class="row">
                        <div class="col-xl">
                            <div class="mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Cotización</h5>
                                </div>
                                <div class="card-body">
                                    <form id="main-form">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="html5-date-input" class="form-label">Fecha</label>
                                                <input class="form-control" type="date" value="2021-06-18" id="html5-date-input" />
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label for="user-search" class="form-label">Buscar Usuario</label>
                                                <input type="text" id="user-search" class="form-control" placeholder="Ingrese nombre o email del usuario" />
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">¿El usuario no está registrado?</label>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">
                                                    Usuario no registrado
                                                </button>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="fullname">Nombre</label>
                                                <input type="text" class="form-control" id="fullname" placeholder="Nombre" disabled />
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="address">Dirección</label>
                                                <input type="text" class="form-control" id="address" placeholder="Dirección" disabled />
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="city">Ciudad</label>
                                                <input type="text" class="form-control" id="city" placeholder="Ciudad" disabled />
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label" for="message">Notas</label>
                                                <textarea id="message" class="form-control" placeholder="Escribe aquí las notas o instrucciones"></textarea>
                                            </div>
                                        </div>

                                        <!-- Detalles Dinámicos -->
                                        <h5>Detalles de la Cotización</h5>
                                        <div class="row mb-2 d-none d-md-flex">
                                            <div class="col-md-3">
                                                <strong>Cantidad</strong>
                                            </div>
                                            <div class="col-md-4">
                                                <strong>Descripción</strong>
                                            </div>
                                            <div class="col-md-2">
                                                <strong>Precio Unitario</strong>
                                            </div>
                                            <div class="col-md-3">
                                                <strong>Precio Total</strong>
                                            </div>
                                        </div>

                                        <div id="dynamic-inputs">
                                            <div class="row mb-3 d-flex d-md-none flex-column">
                                                <div class="col-12 mb-2">
                                                    <input type="number" class="form-control" placeholder="Cantidad" />
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <input type="text" class="form-control" placeholder="Descripción" />
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <input type="number" class="form-control" placeholder="Precio Unitario" />
                                                </div>
                                                <div class="col-12">
                                                    <input type="text" class="form-control" placeholder="Precio Total" disabled />
                                                </div>
                                            </div>

                                            <!-- Para pantallas más grandes -->
                                            <div class="row mb-3 d-none d-md-flex">
                                                <div class="col-md-3">
                                                    <input type="number" class="form-control" placeholder="Cantidad" />
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" placeholder="Descripción" />
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="number" class="form-control" placeholder="Precio Unitario" />
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" placeholder="Precio Total" disabled />
                                                </div>
                                            </div>
                                        </div>


                                        <button type="button" class="btn btn-success" id="add-details">Agregar Detalle</button>
                                        <div class="mt-3">
                                            <strong>Total: </strong><span id="total-amount">0 COP</span>
                                        </div>

                                        <button type="submit" class="btn btn-primary mt-3">Generar Cotización</button>
                                    </form>

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
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.getElementById('save-modal').addEventListener('click', function() {
        // Transferir datos del modal al formulario principal
        document.getElementById('fullname').value = document.getElementById('modal-fullname').value;
        document.getElementById('address').value = document.getElementById('modal-address').value;
        document.getElementById('city').value = document.getElementById('modal-city').value;

        // Cerrar modal
        var modalEl = document.getElementById('modalCenter');
        var modal = bootstrap.Modal.getInstance(modalEl);
        modal.hide();
    });

    // Script para agregar dinámicamente campos de detalle
    const maxDetails = 10;
    let detailCount = 1;

    document.getElementById('add-details').addEventListener('click', function() {
        if (detailCount >= maxDetails) {
            alert('No se pueden agregar más detalles.');
            this.disabled = true; // Deshabilitar el botón
            return;
        }

        const container = document.getElementById('dynamic-inputs');
        const newDetail = document.createElement('div');
        newDetail.className = 'row mb-3';

        newDetail.innerHTML = `
            <div class="col-md-3">
                <input type="number" class="form-control" placeholder="Cantidad" />
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Descripción" />
            </div>
            <div class="col-md-2">
                <input type="number" class="form-control" placeholder="Precio Unitario" />
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" placeholder="Precio Total" disabled />
            </div>
        `;

        container.appendChild(newDetail);
        detailCount++;

        // Habilitar el botón si se eliminan detalles y hay menos de 10
        if (detailCount < maxDetails) {
            document.getElementById('add-details').disabled = false;
        }
    });

    // Actualizar precios totales y el total general
    function updateTotals() {
        let totalAmount = 0;

        document.querySelectorAll('#dynamic-inputs .row').forEach(row => {
            const quantityInput = row.querySelector('input[placeholder="Cantidad"]');
            const unitPriceInput = row.querySelector('input[placeholder="Precio Unitario"]');
            const totalPriceInput = row.querySelector('input[placeholder="Precio Total"]');

            const quantity = parseFloat(quantityInput.value) || 0;
            const unitPrice = parseFloat(unitPriceInput.value) || 0;
            const totalPrice = quantity * unitPrice;

            totalPriceInput.value = formatCurrency(totalPrice);
            totalAmount += totalPrice;
        });

        document.getElementById('total-amount').textContent = formatCurrency(totalAmount);
    }

    function formatCurrency(value) {
        return value.toLocaleString('es-CO', {
            style: 'currency',
            currency: 'COP',
            minimumFractionDigits: 0 // Quitar centavos
        });
    }

    document.getElementById('dynamic-inputs').addEventListener('input', updateTotals);
</script>
