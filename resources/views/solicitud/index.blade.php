<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y d-flex flex-column" style="min-height: 100vh;">
        <div class="row flex-grow-1">
            <div class="col-xl d-flex flex-column">
                <div class="card flex-grow-1 d-flex flex-column">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Solicitudes</h5>
                        <div>
                            <a href="{{ route('solicituds.create') }}" class="btn btn-primary btn">
                                Crear
                            </a>
                        </div>
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
                                    <th>Solicitud</th>
                                    <th>Mensaje</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($solicituds as $solicitud)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $solicitud->solicitud }}</td>
                                        <td>{{ $solicitud->mensaje }}</td>
                                        <td>
                                            <span class="badge
                                            @switch($solicitud->estado)
                                                @case('Pendiente') bg-label-danger
                                            @break
                                                @case('En proceso') bg-label-warning
                                            @break
                                                @case('Finalizada') bg-label-success
                                            @break
                                            @default bg-label-primary
                                            @endswitch me-1">
                                                {{ $solicitud->estado }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <form action="{{ route('solicituds.destroy', $solicitud->id) }}"
                                                    method="POST">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('solicituds.show', $solicitud->id) }}"><i
                                                                class="bx bx-show-alt me-1"></i> Ver</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('solicituds.edit', $solicitud->id) }}"><i
                                                                class="bx bx-edit-alt me-1"></i> Editar</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <a class="dropdown-item" type="submit"
                                                            onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i
                                                                class="bx bx-trash me-1"></i> Eliminar</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="container p-5">{!! $solicituds->withQueryString()->links() !!}</div>
            </div>
        </div>
    </div>
</x-app-layout>
