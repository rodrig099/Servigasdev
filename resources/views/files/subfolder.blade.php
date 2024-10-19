<x-app-layout>
    <div class="container">
        <h1>Archivos en la Subcarpeta: {{ $subfolder_name }}</h1>

        <h2>Carpeta: {{ $folder->folder_name }}</h2>

        <!-- Formulario para subir archivos -->
        <form action="{{ route('files.upload', [$folder->folder_name, $subfolder_name]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="file" class="form-label">Subir archivo</label>
                <input type="file" name="file" id="file" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Subir Archivo</button>
        </form>

        @if ($files->isEmpty())
            <p>No hay archivos en esta subcarpeta.</p>
        @else
            <ul class="list-group">
                @foreach ($files as $file)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>{{ $file->name }}</span>
                        <div>
                            <a href="{{ route('files.download', $file->id) }}"
                                class="btn btn-sm btn-primary">Descargar</a>
                            <form action="{{ route('files.destroy', $file->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</x-app-layout>
