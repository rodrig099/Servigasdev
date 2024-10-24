<x-app-layout>
    <div class="container mt-5">
        <h1 class="text-center"> CARPETA: <br>{{ $folder->name }}</h1>

        @if ($folder->parent_id)
            <a href="{{ route('folders.show', $folder->parent_id) }}" class="btn btn-secondary mb-3">Atrás</a>
        @endif
        <br>

        <div class="row mb-2">
            <div class="col-md-2">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Acciones
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><button class="dropdown-item" data-bs-toggle="modal"
                                data-bs-target="#createSubfolderModal">Crear Subcarpeta</button></li>
                        <li><button class="dropdown-item" data-bs-toggle="modal"
                                data-bs-target="#uploadFileModal">Agregar Archivo</button></li>
                        <li><a class="dropdown-item" href="{{ route('folders.index') }}">Volver a Carpetas Raíz</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <br>
        <h2>Archivos</h2>
        @if ($folder->files->isEmpty() && $folder->subFolders->isEmpty())
            <div class="alert alert-warning" role="alert">
                No hay archivos ni subcarpetas en esta carpeta.
            </div>
        @else
            <ul class="list-group mt-3">
                @foreach ($folder->files as $file)
                    <li class="list-group-item">
                        {{ $file->name }}
                        <a href="{{ route('files.download', $file->id) }}"
                            class="btn btn-info btn-sm float-right">Descargar</a>
                        <form action="{{ route('files.delete', $file->id) }}" method="POST"
                            class="d-inline float-right mr-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif

        <br>
        <h2>Subcarpetas</h2>
        <br>
        @if ($folder->subFolders->isEmpty())
            <div class="alert alert-warning" role="alert">
                No hay subcarpetas en esta carpeta.
            </div>
        @else
            <div class="row mt-3">
                @foreach ($folder->subFolders as $subFolder)
                    <div class="col-md-4 mb-5">
                        <div class="card card-folder">
                            <div class="card-body text-center">
                                <h5 class="card-title">
                                    <a href="{{ route('folders.show', $subFolder->id) }}">
                                        {{ $subFolder->name }}
                                    </a>
                                </h5>
                                <br><br><br>
                                <div class="d-flex justify-content-center mb-4">
                                    <form action="{{ route('folders.delete', $subFolder->id) }}" method="POST"
                                        class="mr-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar
                                            Subcarpeta</button>
                                    </form>

                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#renameModal-{{ $subFolder->id }}">
                                        Renombrar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="renameModal-{{ $subFolder->id }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Renombrar Subcarpeta</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('folders.rename', $subFolder->id) }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control"
                                                value="{{ $subFolder->name }}" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Renombrar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Modal para crear subcarpeta -->
        <div class="modal fade" id="createSubfolderModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Crear Subcarpeta</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
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
                            <br>
                            <button type="submit" class="btn btn-success">Crear</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="uploadFileModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document"> <!-- Modal más grande -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Subir Archivo</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('files.upload', $folder->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="file" id="fileInput" name="file" class="form-control"
                                    accept=".pdf" required>
                            </div>
                            <div class="form-group">
                                <iframe id="filePreview" style="display: none; width: 100%; height: 500px;"
                                    frameborder="0"></iframe>
                                <p id="previewText" style="display: none; color: red;">Vista previa no disponible</p>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Subir</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
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

        .card-folder h5.card-title {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            color: #ffffff;
        }

        .btn {
            min-width: 130px;
        }
    </style>
</x-app-layout>

<script>
    // Si quieres usar el previsualizador de archivos:
    document.getElementById("fileInput").addEventListener("change", function() {
        const file = this.files[0];
        const preview = document.getElementById("filePreview");
        const previewText = document.getElementById("previewText");

        if (file) {
            if (file.type === "application/pdf") {
                preview.style.display = "block";
                preview.src = URL.createObjectURL(file);
                previewText.style.display = "none";
            } else {
                preview.style.display = "none";
                previewText.style.display = "block";
            }
        } else {
            preview.style.display = "none";
            previewText.style.display = "none";
        }
    });
</script>
