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
                                        <h5 class="card-title">Editar Cotización</h5>
                                    </div>
                                    <div class="float-right">
                                        <a class="btn btn-outline-danger" href="{{ route('cotizaciones.index') }}"> {{ __('Back') }}</a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body bg-white">
                                <form id="invoice-form" action="{{ route('cotizaciones.update', $cotizacione->id) }}"
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
                                                            {{ $user->id == $cotizacione->user_id ? 'selected' : '' }}>
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
                                                    value="{{ old('fecha', $cotizacione->fecha) }}" required />
                                                {!! $errors->first('fecha', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mb-2 mb20">
                                                <label for="nota" class="form-label">Nota</label>
                                                <textarea name="nota" id="nota" class="form-control @error('nota') is-invalid @enderror"
                                                    placeholder="Enter notes or instructions">{{ old('nota', $cotizacione->nota) }}</textarea>
                                                {!! $errors->first('nota', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Dynamic Details -->
                                    <h5>Detalles de facura</h5>
                                    <div id="details-container">
                                        @foreach ($cotizacione->detalles as $index => $detalle)
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
                                        <strong>Total: </strong><span id="total-amount">{{ $cotizacione->total }}</span>
                                    </div>

                                    <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
                                </form>
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
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
