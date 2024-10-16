<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y d-flex flex-column" style="min-height: 100vh;">
        <div class="row flex-grow-1">
            <div class="col-xl d-flex flex-column">
                <div class="card flex-grow-1 d-flex flex-column">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Subir un archivo PDF</h5>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success m-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data" class="m-4">
                        @csrf

                        <!-- Campo para seleccionar carpeta existente -->
                        <div class="form-group">
                            <label for="existing_folder">Seleccionar carpeta existente:</label>
                            <select name="existing_folder" class="form-control" id="existing_folder">
                                <option value="">-- Seleccionar carpeta --</option>
                                @foreach ($carpetas as $carpeta)
                                    <option value="{{ $carpeta->id }}">{{ $carpeta->folder_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Campo para crear nueva carpeta -->
                        <div class="form-group mt-3">
                            <label for="folder_name">Crear una nueva carpeta:</label>
                            <input type="text" name="folder_name" class="form-control" id="folder_name"
                                placeholder="Nombre de la carpeta">
                        </div>

                        <div class="form-group mt-3">
                            <label for="file">Seleccionar archivo PDF:</label>
                            <input type="file" name="file" class="form-control" accept="application/pdf"
                                id="file" required>
                        </div>

                        <!-- Vista previa del archivo -->
                        <div id="preview-container" class="preview-container" style="display: none; margin-top: 20px;">
                            <h5 class="text-center">Vista Previa:</h5>
                            <div class="card shadow-sm rounded" style="max-width: 100%;">
                                <div class="card-body">
                                    <embed id="file-preview" src="" width="100%" height="400px"
                                        class="rounded" />
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row mb-3">
                            <div class="col-auto">
                                <button type="submit" class="btn btn-success">Subir Archivo</button>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('files.index') }}" class="btn btn-secondary">Volver a la Lista de
                                    Carpetas</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        // Función para mostrar la vista previa del archivo
        document.getElementById('file').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const previewContainer = document.getElementById('preview-container');
            const filePreview = document.getElementById('file-preview');

            if (file) {
                const fileURL = URL.createObjectURL(file);
                filePreview.src = fileURL;
                previewContainer.style.display = 'block';
            } else {
                previewContainer.style.display = 'none';
            }
        });
    </script>
</x-app-layout>
