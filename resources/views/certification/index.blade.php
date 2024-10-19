<x-app-layout>

    <div class="container-xxl flex-grow-1 container-p-y d-flex flex-column" style="min-height: 100vh;">
        <div class="row flex-grow-1">
            <div class="col-xl d-flex flex-column">
                <div class="card flex-grow-1 d-flex flex-column">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Certificaciones</h5>
                        <div>
                            <a href="{{ route('certifications.create') }}" class="btn btn-primary btn">Crear</a>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="container mb-3 flex-grow-1 d-flex flex-column">
                        <!-- Search -->
                        <div class="navbar-nav">
                            <div class="nav-item d-flex align-items-center">
                                <i class="bx bx-search fs-4 lh-0"></i>
                                <input type="text" class="form-control border-0 shadow-none" placeholder="Buscar..."
                                    aria-label="Search..." />
                            </div>
                        </div>
                        <!-- /Search -->

                        <div class="table-responsive text-nowrap flex-grow-1">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Ciudad</th>
                                        <th>Barrio</th>
                                        <th>Direccion</th>
                                        <th>Fecha De Vencimiento</th>
                                        <th>Días Restantes</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($certifications as $certification)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $certification->ciudad }}</td>
                                            <td>{{ $certification->barrio }}</td>
                                            <td>{{ $certification->direccion }}</td>
                                            <td>
                                                <span
                                                    class="expiration-date">{{ $certification->fecha_de_vencimiento }}</span>
                                            </td>
                                            <td>
                                                <span class="days-remaining"
                                                    data-expiration="{{ $certification->fecha_de_vencimiento }}"></span>
                                            </td>
                                            <td>
                                                <form action="{{ route('certifications.destroy', $certification->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary"
                                                        href="{{ route('certifications.show', $certification->id) }}">
                                                        <i class="fa fa-fw fa-eye"></i> {{ __('Show') }}
                                                    </a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('certifications.edit', $certification->id) }}">
                                                        <i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}
                                                    </a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure to delete?');">
                                                        <i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}
                                                    </button>
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
        {!! $certifications->links() !!}
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.days-remaining');
            elements.forEach(function(element) {
                const expirationDate = new Date(element.getAttribute('data-expiration'));
                const today = new Date();
                const timeDiff = expirationDate - today;
                const daysRemaining = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));

                let color = 'green';
                if (daysRemaining <= 5) {
                    color = 'red';
                } else if (daysRemaining <= 30) {
                    color = 'orange';
                }

                element.style.color = color;
                element.textContent = daysRemaining + ' días';
            });
        });
    </script>
</x-app-layout>
