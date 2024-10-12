<x-app-layout>
    <br>
    <div class="container">

        <h1>Asignar Rol</h1>

        @if (session('info'))
            <div class="alert alert-success">
                <strong>{{ session('info') }}</strong>
            </div>
        @endif

        <!-- Mostrar el nombre del usuario que se está modificando -->
        <h2 class="h5">Perfil: <strong>{{ $user->name }} {{ $user->apellidos }}</strong></h2>



        <h2 class="h5">Listado de Roles</h2>
        <form action="{{ route('usuario.user.update', $user) }}" method="POST">
            @csrf
            @method('GET')

            @foreach ($roles as $role)
                <div class="flex items-center mb-2">
                    <input type="checkbox" name="roles[]" value="{{ $role->id }}" id="role-{{ $role->id }}"
                        class="mr-2 h-4 w-4 text-blue-600 border-gray-300 rounded"
                        {{ in_array($role->id, $user->roles->pluck('id')->toArray()) ? 'checked' : '' }}>
                    <label for="role-{{ $role->id }}" class="text-gray-700">{{ $role->name }}</label>
                </div>
            @endforeach

            <button type="submit" class="btn btn-primary mt-2">
                Guardar
            </button>

            <a href="{{ route('usuarios.index') }}" class="btn btn-success mt-2">
                <i class="fas fa-arrow-left"></i> Volver
            </a>

        </form>
    </div>

</x-app-layout>
