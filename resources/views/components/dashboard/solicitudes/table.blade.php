<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xl">
            <div class="card">
                <h5 class="card-header">Solicitudes</h5>

                <div style="display: flex; justify-content: space-between; align-items: center;">

                    <span id="card_title">
                        {{ __('Solicituds') }}
                    </span>

                    <div class="float-right">
                        <a href="{{ route('solicituds.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                            {{ __('Create New') }}
                        </a>
                    </div>
                </div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success m-4">
                    <p>{{ $message }}</p>
                </div>
                @endif
                <div class="table-responsive text-nowrap">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Solicitud</th>
                                <th>Mensaje</th>
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
                                    <div class="dropdown">
                                        <form action="{{ route('solicituds.destroy', $solicitud->id) }}" method="POST">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('solicituds.show', $solicitud->id) }}"><i class="bx bx-show-alt me-1"></i> Ver</a>
                                                <a class="dropdown-item" href="{{ route('solicituds.edit', $solicitud->id) }}"><i class="bx bx-edit-alt me-1"></i> Editar</a>
                                                @csrf
                                                @method('DELETE')
                                                <a class="dropdown-item" type="submit" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i class="bx bx-trash me-1"></i> Eliminar</a>
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
            {!! $solicituds->withQueryString()->links() !!}
        </div>
    </div>
</div>
