<x-app-layout>
    <h1>Carpeta: {{ $folder_name }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mb-3">
        <a href="{{ route('files.index') }}" class="btn btn-secondary">Volver a la Lista de Carpetas</a>
    </div>


    <!-- Formulario para subir archivo en la carpeta actual -->
    <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="file" class="form-label">Subir archivo:</label>
            <input type="file" class="form-control" id="file" name="file" required>
            @if (isset($folder))
                <input type="hidden" name="existing_folder" value="{{ $folder->id }}">
            @endif
        </div>
        <button type="submit" class="btn btn-success">Subir archivo</button>
    </form>

    @if ($archivos->isEmpty())
        <p>No hay archivos en esta carpeta.</p>
    @else
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Fecha de Subida</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($archivos as $archivo)
                    <tr>
                        <td>
                            <a class="file-link" data-file-id="{{ $archivo->id }}">{{ $archivo->name }}</a>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($archivo->created_at)->setTimezone('America/Bogota')->isoFormat('dddd, MMMM Do YYYY, h:mm a') }}
                        </td>
                        <!-- Ejemplo: "Lunes, Octubre 14th 2024, 3:45:32 pm" en hora local de Bogotá -->
                        <td>
                            <button class="btn btn-warning btn-sm preview-btn" data-file-id="{{ $archivo->id }}"
                                data-bs-toggle="modal" data-bs-target="#previewModal">Ver</button>
                            <a href="{{ route('files.download', $archivo->id) }}"
                                class="btn btn-info btn-sm">Descargar</a>
                            <form action="{{ route('files.destroy', $archivo->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Estás seguro de que deseas eliminar este archivo?');">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- Modal de vista previa -->
    <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="previewModalLabel">Vista Previa del Archivo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <embed id="file-preview" src="" width="100%" height="400px" class="rounded" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Función para mostrar la vista previa del archivo
        document.querySelectorAll('.preview-btn').forEach(button => {
            button.addEventListener('click', function() {
                const fileId = this.getAttribute('data-file-id');

                // Hacer una solicitud AJAX para obtener la URL del archivo
                fetch(`/files/${fileId}`)
                    .then(response => response.json())
                    .then(data => {
                        const fileURL = `/storage/${data.path}`; // Construir la URL del archivo
                        const filePreview = document.getElementById('file-preview');
                        filePreview.src = fileURL;
                    })
                    .catch(error => {
                        console.error('Error al obtener el archivo:', error);
                    });
            });
        });
    </script>
</x-app-layout>
