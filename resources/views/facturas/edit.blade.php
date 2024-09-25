<x-app-layout>
    <section class="content">
        <div class="container-xxl flex-grow-1 container-p-y d-flex flex-column" style="min-height: 100vh;">
            <div class="row flex-grow-1">
                <div class="col-xl d-flex flex-column">
                    <div class="card flex-grow-1 d-flex flex-column">

                        <div class="card-default">

                            <div class="card-header">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <div class="float-left">
                                        <h5 class="card-title">Editar Factura</h5>
                                    </div>
                                    <div class="float-right">
                                        <a class="btn btn-outline-danger" href="{{ route('facturas.index') }}"> {{ __('Back') }}</a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body bg-white">
                                <form id="invoice-form" action="{{ route('facturas.update', $factura->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="row padding-1 p-1">
                                        <div class="col-md-12">
                                            <div class="form-group mb-2 mb20">
                                                <label for="user_id" class="form-label">Usuario</label>
                                                <select name="user_id" id="user_id"
                                                    class="form-control @error('user_id') is-invalid @enderror"
                                                    required>
                                                    <option value="">Seleccionar usuario</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}"
                                                            {{ $user->id == $factura->user_id ? 'selected' : '' }}>
                                                            {{ $user->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                {!! $errors->first('user_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row padding-1 p-1">
                                        <div class="col-md-6">
                                            <div class="form-group mb-2 mb20">
                                                <label for="fecha" class="form-label">Fecha</label>
                                                <input type="date" name="fecha" id="fecha"
                                                    class="form-control @error('fecha') is-invalid @enderror"
                                                    value="{{ old('fecha', $factura->fecha) }}" required />
                                                {!! $errors->first('fecha', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mb-2 mb20">
                                                <label for="nota" class="form-label">Nota</label>
                                                <textarea name="nota" id="nota" class="form-control @error('nota') is-invalid @enderror"
                                                    placeholder="Enter notes or instructions">{{ old('nota', $factura->nota) }}</textarea>
                                                {!! $errors->first('nota', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Dynamic Details -->
                                    <h5>Detalles de facura</h5>
                                    <div id="details-container">
                                        @foreach ($factura->detalles as $index => $detalle)
                                            <div class="row padding-1 p-1">
                                                <div class="col-md-3">
                                                    <div class="form-group mb-2 mb20">
                                                        <input type="number"
                                                            name="detalles[{{ $index }}][cantidad]"
                                                            class="form-control @error('detalles.{{ $index }}.cantidad') is-invalid @enderror"
                                                            placeholder="Quantity"
                                                            value="{{ old('detalles.' . $index . '.cantidad', $detalle->cantidad) }}"
                                                            required />
                                                        {!! $errors->first(
                                                            'detalles.' . $index . '.cantidad',
                                                            '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
                                                        ) !!}
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-2 mb20">
                                                        <input type="text"
                                                            name="detalles[{{ $index }}][descripcion]"
                                                            class="form-control @error('detalles.{{ $index }}.descripcion') is-invalid @enderror"
                                                            placeholder="Description"
                                                            value="{{ old('detalles.' . $index . '.descripcion', $detalle->descripcion) }}"
                                                            required />
                                                        {!! $errors->first(
                                                            'detalles.' . $index . '.descripcion',
                                                            '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
                                                        ) !!}
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group mb-2 mb20">
                                                        <input type="number"
                                                            name="detalles[{{ $index }}][precio_unitario]"
                                                            class="form-control @error('detalles.{{ $index }}.precio_unitario') is-invalid @enderror"
                                                            placeholder="Unit Price"
                                                            value="{{ old('detalles.' . $index . '.precio_unitario', $detalle->precio_unitario) }}"
                                                            required />
                                                        {!! $errors->first(
                                                            'detalles.' . $index . '.precio_unitario',
                                                            '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
                                                        ) !!}
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-2 mb20">
                                                        <input type="text"
                                                            name="detalles[{{ $index }}][precio_total]"
                                                            class="form-control" placeholder="Total Price"
                                                            value="{{ old('detalles.' . $index . '.precio_total', $detalle->precio_total) }}"
                                                            disabled />
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <button type="button" class="btn btn-success" id="add-details">Agregar
                                        detalle</button>
                                    <div class="mt-3">
                                        <strong>Total: </strong><span id="total-amount">{{ $factura->total }}</span>
                                    </div>

                                    <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
                                </form>
                            </div>
                        </div>

                        <!-- Modal for new user -->
                        <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalCenterTitle">Register New User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="modal-fullname">Name</label>
                                                <input type="text" class="form-control" id="modal-fullname"
                                                    placeholder="Name" />
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="modal-address">Address</label>
                                                <input type="text" class="form-control" id="modal-address"
                                                    placeholder="Address" />
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="modal-city">City</label>
                                                <input type="text" class="form-control" id="modal-city"
                                                    placeholder="City" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-danger"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-success" id="save-modal">Save</button>
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
                                alert('Cannot add more details.');
                                return;
                            }

                            const newDetail = document.createElement('div');
                            newDetail.className = 'row padding-1 p-1';
                            newDetail.innerHTML = `
                        <div class="col-md-3">
                            <div class="form-group mb-2 mb20">
                                <input type="number" name="detalles[${count}][cantidad]" class="form-control" placeholder="Quantity" required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-2 mb20">
                                <input type="text" name="detalles[${count}][descripcion]" class="form-control" placeholder="Description" required />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group mb-2 mb20">
                                <input type="number" name="detalles[${count}][precio_unitario]" class="form-control" placeholder="Unit Price" required />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-2 mb20">
                                <input type="text" name="detalles[${count}][precio_total]" class="form-control" placeholder="Total Price" disabled />
                            </div>
                        </div>
                    `;
                            container.appendChild(newDetail);
                        });

                        document.getElementById('details-container').addEventListener('input', function(e) {
                            if (e.target.name.includes('cantidad') || e.target.name.includes('precio_unitario')) {
                                const row = e.target.closest('.row');
                                const cantidad = row.querySelector('[name*="[cantidad]"]').value;
                                const precioUnitario = row.querySelector('[name*="[precio_unitario]"]').value;
                                const total = cantidad * precioUnitario;
                                row.querySelector('[name*="[precio_total]"]').value = total;
                                updateTotalAmount();
                            }
                        });

                        function updateTotalAmount() {
                            let totalAmount = 0;
                            document.querySelectorAll('[name*="[precio_total]"]').forEach(input => {
                                totalAmount += parseFloat(input.value) || 0;
                            });
                            document.getElementById('total-amount').textContent = `${totalAmount.toFixed(2)} COP`;
                        }

                        document.getElementById('save-modal').addEventListener('click', function() {
                            const fullname = document.getElementById('modal-fullname').value;
                            const address = document.getElementById('modal-address').value;
                            const city = document.getElementById('modal-city').value;

                            if (fullname && address && city) {
                                // Simulate saving user and updating select field
                                const userSelect = document.getElementById('user_id');
                                const newOption = document.createElement('option');
                                newOption.value = 'new_user_id'; // Replace with actual new user ID
                                newOption.textContent = fullname;
                                newOption.selected = true;
                                userSelect.appendChild(newOption);
                                userSelect.dispatchEvent(new Event('change'));
                                $('#modalCenter').modal('hide');
                            } else {
                                alert('Please fill all the fields in the modal.');
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
