<x-app-layout>
<br>
<div class="container">
    <h2>Editar Informacion del Tecnico</h2>

    <!-- Formulario de edición -->
    <form action="{{ route('tarjetapros.update', $tarjetapro->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <!-- Select para elegir usuario -->
        <div class="form-group">
            <label for="user_id">Seleccionar Usuario</label>
            <select name="user_id" id="user_id" class="form-control">
                <option value="">Seleccione un usuario</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id', $tarjetapro->user_id) == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} {{ $user->apellidos }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Campos que se rellenan automáticamente (con valores preexistentes) -->
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" id="name" name="name" class="form-control" 
                   value="{{ old('name', $tarjetapro->user->name) }}" readonly>
        </div>

        <div class="form-group">
            <label for="apellidos">Apellidos</label>
            <input type="text" id="apellidos" name="apellidos" class="form-control" 
                   value="{{ old('apellidos', $tarjetapro->user->apellidos) }}" readonly>
        </div>

        <div class="form-group">
            <label for="cedula">Cédula</label>
            <input type="text" id="cedula" name="cedula" class="form-control" 
                   value="{{ old('cedula', $tarjetapro->user->cedula) }}" readonly>
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" id="telefono" name="telefono" class="form-control" 
                   value="{{ old('telefono', $tarjetapro->user->telefono) }}" readonly>
        </div>

        <!-- Campos específicos de Tarjeta Pro (pre-cargar valores actuales) -->
        <div class="form-group">
            <label for="codigo">Código</label>
            <input type="text" id="codigo" name="codigo" class="form-control" 
                   value="{{ old('codigo', $tarjetapro->codigo) }}">
        </div>

        <div class="form-group">
            <label for="expedido">Expedido</label>
            <input type="text" id="expedido" name="expedido" class="form-control" 
                   value="{{ old('expedido', $tarjetapro->expedido) }}">
        </div>

        <div class="form-group">
            <label for="vigencia">Vigencia</label>
            <input type="date" id="vigencia" name="vigencia" class="form-control" 
                   value="{{ old('vigencia', $tarjetapro->vigencia) }}">
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
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
</x-app-layout>