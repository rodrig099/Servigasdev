<br>
<div class="container">
    <h2>Crear Tarjeta Pro</h2>

    <form action="{{ route('tarjetapros.store') }}" method="POST">
        @csrf

        <!-- Campo oculto para user_id -->
        <input type="hidden" id="user_id" name="user_id">

        <!-- Select para elegir usuario -->
        <label for="search_cedula">Cédula</label>
        <div class="input-group">
            <input type="text" name="search_cedula" id="search_cedula"
                class="form-control @error('search_cedula') is-invalid @enderror"
                placeholder="Ingrese el número de cédula" />
            <button type="button" id="search-button" class="btn btn-primary">Buscar</button>
        </div>
        {!! $errors->first(
            'search_cedula',
            '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
        ) !!}

        <!-- Campos que se rellenan automáticamente -->
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" class="form-control" readonly>
        </div>

        <div class="form-group">
            <label for="apellidos">Apellidos</label>
            <input type="text" id="apellidos" name="apellidos" class="form-control" readonly>
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
    document.getElementById('search-button').addEventListener('click', function() {
        const cedula = document.getElementById('search_cedula').value;

        if (cedula) {
            fetch(`/api/users/${cedula}`)
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        document.getElementById('nombre').value = data.nombre;
                        document.getElementById('apellidos').value = data.apellidos;
                        // Asigna el user_id al campo oculto
                        document.getElementById('user_id').value = data.id;
                    } else {
                        alert('Usuario no encontrado');
                    }
                })
                .catch(error => {
                    console.error('Error fetching user:', error);
                    alert('Error al buscar el usuario');
                });
        } else {
            alert('Por favor ingrese un número de cédula');
        }
    });
</script>
