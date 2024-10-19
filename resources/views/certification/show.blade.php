<x-app-layout>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Certification</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('certifications.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <div class="form-group mb-2 mb20">
                            <strong>Ciudad:</strong>
                            {{ $certification->ciudad }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Barrio:</strong>
                            {{ $certification->barrio }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Direccion:</strong>
                            {{ $certification->direccion }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Fecha De Vencimiento:</strong>
                            <span id="expiration-date">{{ $certification->fecha_de_vencimiento }}</span>
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Días Restantes:</strong>
                            <span id="days-remaining" style="font-weight: bold;"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Obtener la fecha de vencimiento desde el HTML
        const expirationDateString = document.getElementById('expiration-date').textContent;
        const expirationDate = new Date(expirationDateString + 'T00:00:00'); // Asegurarse de que esté en formato válido

        // Calcular los días restantes
        const now = new Date();
        const timeDifference = expirationDate - now; // Diferencia en milisegundos
        const daysRemaining = Math.ceil(timeDifference / (1000 * 3600 * 24)); // Convertir a días

        // Mostrar los días restantes en la vista
        const daysRemainingElement = document.getElementById('days-remaining');
        daysRemainingElement.textContent = daysRemaining + ' días';

        // Cambiar el color del texto basado en los días restantes
        if (daysRemaining <= 5) {
            daysRemainingElement.style.color = 'red';
        } else if (daysRemaining <= 30) {
            daysRemainingElement.style.color = 'orange';
        } else {
            daysRemainingElement.style.color = 'green';
        }
    </script>
</x-app-layout>
