<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y d-flex flex-column" style="min-height: 100vh;">
        <div class="row flex-grow-1">
            <div class="col-xl d-flex flex-column">
                <div class="card flex-grow-1 d-flex flex-column">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Solicitudes</h5>

                        @hasanyrole('Admin|Usuario')
                            <div class="float-right">
                                <a href="{{ route('solicitudes.create') }}" class="btn btn-primary btn">
                                    Crear
                                </a>
                            </div>
                        @endhasanyrole

                    </div>

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="table-responsive text-nowrap flex-grow-1">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>

                                    @hasanyrole('Admin|Tecnico')
                                        <th>Usuario</th>
                                    @endhasanyrole
                                    <th>Tiposolicitudes Id</th>
                                    <th>Descripcion</th>
                                    <th>Estatus</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($solicitudes as $solicitude)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        @hasanyrole('Admin|Tecnico')
                                            <td>{{ $solicitude->user->name }}</td>
                                        @endhasanyrole
                                        <td>{{ $solicitude->tiposolicitude->nombreTipo }}</td>
                                        <td>{{ $solicitude->descripcion }}</td>
                                        <td>{{ $solicitude->estatus }}</td>

                                        <td>
                                            <form action="{{ route('solicitudes.destroy', $solicitude->id) }}"
                                                method="POST">
                                                <a class="btn btn-sm btn-primary "
                                                    href="{{ route('solicitudes.show', $solicitude->id) }}"><i
                                                        class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success"
                                                    href="{{ route('solicitudes.edit', $solicitude->id) }}"><i
                                                        class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>

                                                @hasanyrole('Admin|Usuario')
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                @endhasanyrole
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! $solicitudes->links() !!}
    </div>
</x-app-layout>
