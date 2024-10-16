<x-app-layout>
    <div class="container mt-4">
        <h1 class="mb-4 text-center">Archivos</h1>

        {{-- Mostrar el mensaje de éxito si existe --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Mostrar el mensaje de error si existe --}}
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="mb-3 text-center">
            @if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Tecnico') || Auth::user()->hasRole('Usuario'))
                <a href="{{ route('files.create') }}" class="btn btn-primary btn-lg">
                    <i class="bi bi-upload"></i> Subir Nuevo Archivo
                </a>
            @endif
        </div>

        <div class="row">
            @foreach ($carpetas as $carpeta)
                <div class="col-md-4">
                    <div class="card text-center mb-4 shadow-sm border-light">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ route('files.show', $carpeta->folder_name) }}"
                                    class="text-decoration-none text-dark">
                                    <i class="bi bi-folder" style="font-size: 3rem;"></i>
                                    <div class="mt-2">{{ $carpeta->folder_name }}</div>
                                </a>
                                @hasanyrole('Admin|Tecnico')
                                    {{-- Mostrar el nombre del creador y su rol si el rol actual es Admin o Técnico --}}
                                    @if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Tecnico'))
                                        <p class="text-muted">
                                            De: {{ $carpeta->user->name }} {{ $carpeta->user->apellidos }}
                                            ({{ $carpeta->user->roles->pluck('name')->implode(', ') }})
                                            {{-- Mostrar el rol --}}
                                        </p>
                                    @endif
                                @endhasanyrole

                            </h5>
                            @if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Tecnico') || Auth::user()->hasRole('Usuario'))
                                <button class="btn btn-secondary btn-sm mt-2" data-bs-toggle="modal"
                                    data-bs-target="#renameFolderModal{{ $carpeta->id }}">
                                    <i class="bi bi-pencil"></i> Cambiar Nombre
                                </button>

                                <!-- Modal para cambiar el nombre de la carpeta -->
                                <div class="modal fade" id="renameFolderModal{{ $carpeta->id }}" tabindex="-1"
                                    aria-labelledby="renameFolderModalLabel{{ $carpeta->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="renameFolderModalLabel{{ $carpeta->id }}">
                                                    Cambiar Nombre de Carpeta</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('folders.rename', $carpeta->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="mb-3">
                                                        <label for="folder_name" class="form-label">Nuevo Nombre</label>
                                                        <input type="text" class="form-control" id="folder_name"
                                                            name="new_folder_name" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <button type="submit" class="btn btn-primary">Actualizar
                                                            Nombre</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <form action="{{ route('folders.destroy', $carpeta->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm mt-3"
                                        onclick="return confirm('¿Estás seguro de que deseas eliminar esta carpeta y todos sus archivos?');">
                                        <i class="bi bi-trash"></i> Eliminar Carpeta
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center">
            {{ $files->links() }}
        </div>
    </div>
</x-app-layout>
