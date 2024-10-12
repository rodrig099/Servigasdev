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
                        <div class="form-group">
                            <label for="file">Seleccionar archivo PDF:</label>
                            <input type="file" name="file" class="form-control" accept="application/pdf"
                                id="file" required>
                        </div>

                        <!-- Contenedor para la vista previa -->
                        <div id="preview-container" style="display: none; margin-top: 20px;">
                            <h5>Vista Previa:</h5>
                            <embed id="file-preview" src="" width="100%" height="400px" />
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Subir Archivo</button>
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
                previewContainer.style.display = 'block'; // Mostrar el contenedor de vista previa
            } else {
                previewContainer.style.display = 'none'; // Ocultar si no hay archivo seleccionado
            }
        });
    </script>
</x-app-layout>
