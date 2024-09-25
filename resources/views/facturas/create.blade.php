<x-app-layout>
    <section class="content">
        <div class="container-xxl flex-grow-1 container-p-y d-flex flex-column" style="min-height: 100vh;">
            <div class="row flex-grow-1">
                <div class="col-xl d-flex flex-column">
                    <div class="card flex-grow-1 d-flex flex-column">
                        <div class="card-default">
                            <div class="card-header">
                                <span class="card-title">Crear factura</span>
                            </div>
                            <div class="card-body bg-white">
                                <form id="invoice-form" action="{{ route('facturas.store') }}" method="POST">
                                    @csrf
                                    <div class="row padding-1 p-1">
                                        <div class="col-md-6">
                                            <div class="form-group mb-2 mb20">
                                                <label for="search_cedula" class="form-label">Buscar Usuario por
                                                    Cédula</label>
                                                <div class="input-group">
                                                    <input type="text" name="search_cedula" id="search_cedula"
                                                        class="form-control @error('search_cedula') is-invalid @enderror"
                                                        placeholder="Ingrese el número de cédula" />
                                                    <button type="button" id="search-button"
                                                        class="btn btn-primary">Buscar</button>
                                                </div>
                                                {!! $errors->first(
                                                    'search_cedula',
                                                    '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
                                                ) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row padding-1 p-1">
                                        <div class="col-md-6">
                                            <div class="form-group mb-2 mb20">
                                                <label for="nombre" class="form-label">Nombre</label>
                                                <input type="text" name="nombre" id="nombre"
                                                    class="form-control @error('nombre') is-invalid @enderror"
                                                    placeholder="Nombre del usuario" disabled />
                                                {!! $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                            </div>
                                        </div>

                                        <input type="hidden" name="user_id" id="user_id" />

                                        <div class="col-md-6">
                                            <div class="form-group mb-2 mb20">
                                                <label for="apellidos" class="form-label">Apellidos</label>
                                                <input type="text" name="apellidos" id="apellidos"
                                                    class="form-control @error('apellidos') is-invalid @enderror"
                                                    placeholder="Apellidos del usuario" disabled />
                                                {!! $errors->first('apellidos', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row padding-1 p-1">
                                        <div class="col-md-6">
                                            <div class="form-group mb-2 mb20">
                                                <label for="barrio" class="form-label">Barrio</label>
                                                <input type="text" name="barrio" id="barrio"
                                                    class="form-control @error('barrio') is-invalid @enderror"
                                                    placeholder="Barrio" disabled />
                                                {!! $errors->first('barrio', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-2 mb20">
                                                <label for="direccion" class="form-label">Dirección</label>
                                                <input type="text" name="direccion" id="direccion"
                                                    class="form-control @error('direccion') is-invalid @enderror"
                                                    placeholder="Dirección" disabled />
                                                {!! $errors->first('direccion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-2 mb20">
                                                <label for="ciudad" class="form-label">Ciudad</label>
                                                <input type="text" name="ciudad" id="ciudad"
                                                    class="form-control @error('ciudad') is-invalid @enderror"
                                                    placeholder="Ciudad" disabled />
                                                {!! $errors->first('ciudad', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-2 mb20">
                                                <label for="departamento" class="form-label">Departamento</label>
                                                <input type="text" name="departamento" id="departamento"
                                                    class="form-control @error('departamento') is-invalid @enderror"
                                                    placeholder="Departamento" disabled />
                                                {!! $errors->first('departamento', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row padding-1 p-1">
                                        <div class="col-md-6">
                                            <div class="form-group mb-2 mb20">
                                                <label for="fecha" class="form-label">Fecha</label>
                                                <input type="date" name="fecha" id="fecha"
                                                    class="form-control @error('fecha') is-invalid @enderror"
                                                    value="{{ old('fecha') }}" required />
                                                {!! $errors->first('fecha', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mb-2 mb20">
                                                <label for="nota" class="form-label">Nota</label>
                                                <textarea name="nota" id="nota" class="form-control @error('nota') is-invalid @enderror"
                                                    placeholder="Escribe una nota o insctrucciones">{{ old('nota') }}</textarea>
                                                {!! $errors->first('nota', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Dynamic Details -->
                                    <h5>Detalles de facura</h5>
                                    <div id="details-container">
                                        <!-- Details will be added dynamically here -->
                                        <div class="row padding-1 p-1">
                                            <div class="col-md-3">
                                                <div class="form-group mb-2 mb20">
                                                    <input type="number" name="detalles[0][cantidad]"
                                                        class="form-control @error('detalles.0.cantidad') is-invalid @enderror"
                                                        placeholder="Cantidad" required />
                                                    {!! $errors->first(
                                                        'detalles.0.cantidad',
                                                        '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
                                                    ) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group mb-2 mb20">
                                                    <input type="text" name="detalles[0][descripcion]"
                                                        class="form-control @error('detalles.0.descripcion') is-invalid @enderror"
                                                        placeholder="Descripción" required />
                                                    {!! $errors->first(
                                                        'detalles.0.descripcion',
                                                        '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
                                                    ) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group mb-2 mb20">
                                                    <input type="number" name="detalles[0][precio_unitario]"
                                                        class="form-control @error('detalles.0.precio_unitario') is-invalid @enderror"
                                                        placeholder="Precio unitario" required />
                                                    {!! $errors->first(
                                                        'detalles.0.precio_unitario',
                                                        '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
                                                    ) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mb-2 mb20">
                                                    <input type="text" name="detalles[0][precio_total]"
                                                        class="form-control" placeholder="Precio total" disabled />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-success" id="add-details">Agregar
                                        detalle</button>
                                    <div class="mt-3">
                                        <strong>Total: </strong><span id="total-amount">0 COP</span>
                                    </div>

                                    <button type="submit" class="btn btn-primary mt-3">Generar factura</button>
                                </form>
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

                        document.getElementById('invoice-form').addEventListener('input', function(e) {
                            if (e.target.name.endsWith('[cantidad]') || e.target.name.endsWith('[precio_unitario]')) {
                                const row = e.target.closest('.row');
                                const cantidad = row.querySelector('input[name*="[cantidad]"]').value;
                                const precioUnitario = row.querySelector('input[name*="[precio_unitario]"]').value.replace(/\./g,
                                    '').replace(/,/g, ''); // Eliminar puntos y comas
                                const precioTotal = row.querySelector('input[name*="[precio_total]"]');

                                const total = cantidad * parseFloat(precioUnitario); // Asegúrate de convertir a float
                                precioTotal.value = formatCurrency(total); // Formatear el precio total

                                updateTotalAmount();
                            }
                        });

                        function updateTotalAmount() {
                            const container = document.getElementById('details-container');
                            let totalAmount = 0;
                            const totalFields = container.querySelectorAll('input[name*="[precio_total]"]');
                            totalFields.forEach(field => {
                                totalAmount += parseFloat(field.value.replace(/\./g, '').replace(/,/g, '')) ||
                                0; // Eliminar puntos y comas antes de sumar
                            });

                            document.getElementById('total-amount').textContent = formatCurrency(totalAmount); // Formatear el total
                        }

                        // Función para formatear el número como moneda colombiana
                        function formatCurrency(value) {
                            return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."); // Formato de miles
                        }



                        document.getElementById('search_cedula').addEventListener('blur', function() {
                            const cedula = this.value;
                            if (cedula) {
                                fetch(`/api/users/${cedula}`)
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data) {
                                            document.getElementById('nombre').value = data.nombre;
                                            document.getElementById('apellidos').value = data.apellidos;
                                            document.getElementById('direccion').value = data.direccion;
                                            document.getElementById('barrio').value = data.barrio;
                                            document.getElementById('ciudad').value = data.ciudad;
                                            document.getElementById('departamento').value = data.departamento;
                                            // Asigna el user_id al campo oculto
                                            document.getElementById('user_id').value = data
                                                .id; // Asegúrate de que el ID esté en el objeto data
                                        } else {
                                            alert('Usuario no encontrado');
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error fetching user:', error);
                                        alert('Error al buscar el usuario');
                                    });
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
