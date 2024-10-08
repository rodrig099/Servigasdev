<br>
<div class="container">
    <h2>Crear Tarjeta Pro</h2>

    <form action="{{ route('tarjetapros.store') }}" method="POST">
        @csrf

        <!-- Select para elegir usuario -->
        Cédula</label>
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
    document.getElementById('user_id').addEventListener('change', function() {
        var userId = this.value;

        if (userId) {
            fetch(`/users/${userId}/details`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('nombre').value = data.name;
                    document.getElementById('apellidos').value = data.apellidos;
                })
                .catch(error => console.error('Error:', error));
        } else {
            document.getElementById('nombre').value = '';
            document.getElementById('apellidos').value = '';
        }
    });

    document.getElementById('search_cedula').addEventListener('blur', function() {
        const cedula = this.value;
        if (cedula) {
            fetch(`/api/users/${cedula}`)
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        document.getElementById('nombre').value = data.nombre;
                        document.getElementById('apellidos').value = data.apellidos;
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
