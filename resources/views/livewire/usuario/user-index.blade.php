<div class="container-xxl flex-grow-1 container-p-y d-flex flex-column" style="min-height: 100vh;">
    <div class="row flex-grow-1">
        <div class="col-xl d-flex flex-column">
            <div class="card flex-grow-1 d-flex flex-column">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Roles y permisos</h5>
                </div>

                @if ($users->count())
                    <div class="table-responsive text-nowrap flex-grow-1">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Rol</th>
                                    <th>Email</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->apellidos }}</td>
                                        <td>
                                            @if ($user->roles->isNotEmpty())
                                                {{ $user->roles->pluck('name')->implode(', ') }}
                                            @else
                                                <span>No asignado</span>
                                            @endif

                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td width="10px">
                                            <a class="btn btn-primary"
                                                href="{{ route('usuario.user.edit', $user->id) }}">Editar</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>

            <div class="card-footer">
                {{ $users->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>No Hay Registros</strong>
            </div>

            @endif

        </div>
    </div>
</div>
