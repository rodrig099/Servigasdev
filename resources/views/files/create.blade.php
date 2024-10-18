<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y d-flex flex-column" style="min-height: 100vh;">
        <div class="row flex-grow-1">
            <div class="col-xl d-flex flex-column">
                <div class="card flex-grow-1 d-flex flex-column">

                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>crear Carpeta</h5>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success m-4">
                            {{ session('success') }}
                        </div>
                    @elseif (session('error'))
                        <div class="alert alert-danger m-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data" class="m-4">
                        @csrf

                        <div class="row padding-1 p-1">
                            <div class="col-md-6">
                                <div class="form-group mb-2 mb20">
                                    <label for="search_cedula" class="form-label">Buscar Usuario por Cédula</label>
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

                            <!-- Campo para crear nueva carpeta -->
                            <div class="form-group mt-3">
                                <label for="folder_name">Nombre de la Carpeta:</label>
                                <input type="text" name="folder_name" class="form-control" id="folder_name"
                                    placeholder="Nombre de la carpeta" readonly required>
                            </div>

                            <!-- Campo para crear subcarpeta -->
                            <div class="form-group mt-3">
                                <label for="subfolder_name">Crear Subcarpeta:</label>
                                <input type="text" name="subfolder_name" class="form-control" id="subfolder_name"
                                    placeholder="Nombre de la subcarpeta">
                            </div>

                            <!-- Campo para subir el archivo PDF -->
                            <div class="form-group mt-3">
                                <label for="file">Seleccionar Archivo PDF:</label>
                                <input type="file" name="file"
                                    class="form-control @error('file') is-invalid @enderror" id="file" required>
                                {!! $errors->first('file', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                            </div>

                            <br>
                            <div class="form-group mt-3">
                                <button type="submit" id="create_folder_btn" class="btn btn-primary">Crear Carpeta y
                                    Subir Archivo</button>
                            </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('search_cedula').addEventListener('blur', function() {
            const cedula = this.value;
            if (cedula) {
                fetch(`/api/users/${cedula}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data) {
                            document.getElementById('nombre').value = data.nombre;
                            document.getElementById('apellidos').value = data.apellidos;
                            document.getElementById('user_id').value = data.id;

                            // Concatenar cédula, nombre y apellidos para el nombre de la carpeta
                            const folderName = `${cedula} - ${data.nombre} ${data.apellidos}`;
                            document.getElementById('folder_name').value = folderName;

                            // Limpiar el nombre de la subcarpeta para permitir la entrada manual
                            document.getElementById('subfolder_name').value = '';
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
</x-app-layout>
