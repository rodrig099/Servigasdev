<x-app-layout>
    <div class="container mt-5">
        <h1 class="text-center">ADMINISTRACION DE ARCHIVOS</h1>
        @if (session('success'))
            <div class="alert alert-success m-4">
                {{ session('success') }}
            </div>
        @endif

        <h3>Crear Carpeta</h3>
        <div class="row padding-1 p-1">
            <div class="col-md-6">
                <div class="form-group mb-2 mb20">
                    <label for="search_cedula" class="form-label">Buscar Usuario por Cédula</label>
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
                </div>
            </div>
        </div>

        <div class="row padding-1 p-1">
            <div class="col-md-6">
                <div class="form-group mb-2 mb20">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" id="nombre"
                        class="form-control @error('nombre') is-invalid @enderror" placeholder="Nombre del usuario"
                        disabled />
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

            <br><br>

            <form action="{{ route('folders.create') }}" method="POST">
                @csrf
                <div class="form-group d-flex align-items-center col-md-6">
                    <input type="text" name="name" id="folder_name" class="form-control mr-2"
                        placeholder="Nombre de la carpeta" required>
                    <button type="submit" class="btn btn-success">Crear</button>
                </div>
            </form>

            <br><br><br>
            <h3 class="text-center">Carpetas de los Usuarios</h3>
            <br><br><br>
            <div class="row mt-3">
                @foreach ($folders as $folder)
                    <div class="col-md-4 mb-5"> <!-- Aumentado el margen inferior a mb-5 -->
                        <div class="card card-folder"> <!-- Aplicación del nuevo estilo -->
                            <div class="card-body text-center">
                                <h5 class="card-title">
                                    <a href="{{ route('folders.show', $folder->id) }}"
                                        class="text-decoration-none text-light">
                                        {{ $folder->name }}
                                    </a>
                                </h5>

                                <div class="d-flex justify-content-center">
                                    <!-- Botones centrados y con el mismo tamaño -->
                                    <a href="#" class="btn btn-success mx-2" data-toggle="modal"
                                        data-target="#uploadFileModal{{ $folder->id }}">Subir Archivo</a>
                                    <a href="#" class="btn btn-warning mx-2" data-toggle="modal"
                                        data-target="#createSubFolderModal{{ $folder->id }}">Crear Subcarpeta</a>
                                </div>

                                <form action="{{ route('folders.delete', $folder->id) }}" method="POST" class="mt-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-block">Eliminar Carpeta</button>
                                </form>
                            </div>
                        </div>

                        <!-- Modal para subir archivos en la carpeta raíz -->
                        <div class="modal fade" id="uploadFileModal{{ $folder->id }}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Subir Archivo</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('files.upload', $folder->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <input type="file" name="file" class="form-control" accept=".pdf"
                                                    required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Subir</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal para crear subcarpeta -->
                        <div class="modal fade" id="createSubFolderModal{{ $folder->id }}" tabindex="-1"
                            role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Crear Subcarpeta</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('folders.create') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" name="name" class="form-control"
                                                    placeholder="Nombre de la subcarpeta" required>
                                                <input type="hidden" name="parent_id" value="{{ $folder->id }}">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Crear Subcarpeta</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
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

                                document.getElementById('folder_name').value =
                                    `${cedula} - ${data.nombre} ${data.apellidos}`;
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

        <!-- Scripts de Bootstrap -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    </div>

    <style>
        /* Estilo para que la card parezca una carpeta */
        .card-folder {
            border: none;
            background-color: #343a40;
            position: relative;
            padding-top: 15px;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            height: 200px;
            transition: transform 0.3s ease;
        }

        /* Simulación de la pestaña de la carpeta */
        .card-folder::before {
            content: '';
            position: absolute;
            top: -20px;
            left: 20px;
            width: 100px;
            height: 25px;
            background-color: #495057;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        /* Cambio de tamaño y estilo de los títulos */
        .card-folder h5.card-title {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            color: #ffffff;
        }

        /* Aumentar el tamaño de los botones */
        .btn {
            min-width: 130px;
        }
    </style>
</x-app-layout>
