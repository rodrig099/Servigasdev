<br>
<div class="container">
        <h2>Crear Tarjeta Pro</h2>

        <form action="{{ route('tarjetapros.store') }}" method="POST">
            @csrf

            <!-- Select para elegir usuario -->
            <div class="form-group">
                <label for="user_id">Seleccionar Usuario</label>
                <select name="user_id" id="user_id" class="form-control">
                    <option value="">Seleccione un usuario</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} {{ $user->apellidos }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Campos que se rellenan automáticamente -->
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" id="name" name="name" class="form-control" readonly>
            </div>

            <div class="form-group">
                <label for="apellidos">Apellidos</label>
                <input type="text" id="apellidos" name="apellidos" class="form-control" readonly>
            </div>

            <div class="form-group">
                <label for="cedula">Cédula</label>
                <input type="text" id="cedula" name="cedula" class="form-control" readonly>
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" id="telefono" name="telefono" class="form-control" readonly>
            </div>

            <!-- Campos específicos de Tarjeta Pro -->
            <div class="form-group">
                <label for="codigo">Código</label>
                <input type="text" id="codigo" name="codigo" class="form-control">
            </div>

            <div class="form-group">
                <label for="expedido">Expedido</label>
                <input type="text" id="expedido" name="expedido" class="form-control">
            </div>

            <div class="form-group">
                <label for="vigencia">Vigencia</label>
                <input type="date" id="vigencia" name="vigencia" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Guardar Tarjeta Pro</button>
        </form>
    </div>

    <!-- Script para usar AJAX y traer datos del usuario -->
    <script>
        document.getElementById('user_id').addEventListener('change', function () {
            var userId = this.value;

            if (userId) {
                fetch(`/users/${userId}/details`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('name').value = data.name;
                        document.getElementById('apellidos').value = data.apellidos;
                        document.getElementById('cedula').value = data.cedula;
                        document.getElementById('telefono').value = data.telefono;
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                document.getElementById('name').value = '';
                document.getElementById('apellidos').value = '';
                document.getElementById('cedula').value = '';
                document.getElementById('telefono').value = '';
            }
        });
    </script>
