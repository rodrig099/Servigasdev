<x-app-layout>
    <section class="content">
        <div class="container-xxl flex-grow-1 container-p-y d-flex flex-column" style="min-height: 100vh;">
            <div class="row flex-grow-1">
                <div class="col-xl d-flex flex-column">
                    <div class="card flex-grow-1 d-flex flex-column">
                        <div class="card-header">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <div class="float-left">
                                    <h5 class="card-title">Editar Factura</h5>
                                </div>
                                <div class="float-right">
                                    <a class="btn btn-outline-danger" href="{{ route('facturas.index') }}">
                                        {{ __('Back') }}</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body bg-white">

                            <form id="invoice-form" action="{{ route('facturas.update', $factura->id) }}"
                                method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row padding-1 p-1">
                                    <div class="col-md-12">
                                        <div class="form-group mb-2 mb20">
                                            <label for="user_id" class="form-label">User</label>
                                            <select name="user_id" id="user_id"
                                                class="form-control @error('user_id') is-invalid @enderror" disabled>
                                                <option value="">Select a user</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}"
                                                        {{ $user->id == $factura->user_id ? 'selected' : '' }}>
                                                        {{ $user->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            {!! $errors->first('user_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row padding-1 p-1">
                                    <div class="col-md-6">
                                        <div class="form-group mb-2 mb20">
                                            <label for="fecha" class="form-label">Date</label>
                                            <input type="date" name="fecha" id="fecha"
                                                class="form-control @error('fecha') is-invalid @enderror"
                                                value="{{ old('fecha', $factura->fecha) }}" disabled />
                                            {!! $errors->first('fecha', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-2 mb20">
                                            <label for="nota" class="form-label">Note</label>
                                            <textarea name="nota" id="nota" class="form-control @error('nota') is-invalid @enderror"
                                                placeholder="Enter notes or instructions"disabled>{{ old('nota', $factura->nota) }}</textarea>
                                            {!! $errors->first('nota', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                        </div>
                                    </div>
                                </div>

                                <!-- Dynamic Details -->
                                <h5>Invoice Details</h5>
                                <div id="details-container">
                                    @foreach ($factura->detalles as $index => $detalle)
                                        <div class="row padding-1 p-1">
                                            <div class="col-md-3">
                                                <div class="form-group mb-2 mb20">
                                                    <input type="number" name="detalles[{{ $index }}][cantidad]"
                                                        class="form-control @error('detalles.{{ $index }}.cantidad') is-invalid @enderror"
                                                        placeholder="Quantity"
                                                        value="{{ old('detalles.' . $index . '.cantidad', $detalle->cantidad) }}"
                                                        disabled />
                                                    {!! $errors->first(
                                                        'detalles.' . $index . '.cantidad',
                                                        '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
                                                    ) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group mb-2 mb20">
                                                    <input type="text"
                                                        name="detalles[{{ $index }}][descripcion]"
                                                        class="form-control @error('detalles.{{ $index }}.descripcion') is-invalid @enderror"
                                                        placeholder="Description"
                                                        value="{{ old('detalles.' . $index . '.descripcion', $detalle->descripcion) }}"
                                                        disabled />
                                                    {!! $errors->first(
                                                        'detalles.' . $index . '.descripcion',
                                                        '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
                                                    ) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group mb-2 mb20">
                                                    <input type="number"
                                                        name="detalles[{{ $index }}][precio_unitario]"
                                                        class="form-control @error('detalles.{{ $index }}.precio_unitario') is-invalid @enderror"
                                                        placeholder="Unit Price"
                                                        value="{{ old('detalles.' . $index . '.precio_unitario', $detalle->precio_unitario) }}"
                                                        disabled />
                                                    {!! $errors->first(
                                                        'detalles.' . $index . '.precio_unitario',
                                                        '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
                                                    ) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mb-2 mb20">
                                                    <input type="text"
                                                        name="detalles[{{ $index }}][precio_total]"
                                                        class="form-control" placeholder="Total Price"
                                                        value="{{ old('detalles.' . $index . '.precio_total', $detalle->precio_total) }}"
                                                        disabled />
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-3">
                                    <strong>Total: </strong><span id="total-amount">{{ $factura->total }}</span>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
    </section>
</x-app-layout>
