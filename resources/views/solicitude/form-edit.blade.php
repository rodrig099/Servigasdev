<div class="row padding-1 p-1">
    <div class="col-md-12">

       <div class="row padding-1 p-1">
    <div class="col-md-12">
    <div class="form-group mb-2 mb20">
        <label for="tiposolicitudes_id" class="form-label">{{ __('Tipo solicitudes') }}</label>
        <select name="tiposolicitudes_id" class="form-control @error('tiposolicitudes_id') is-invalid @enderror" id="tiposolicitudes_id">
            <option value="" selected disabled>Seleccione una opción</option>
            @foreach ($tiposolicitude as $tiposolicitude)
                <option value={{ $tiposolicitude->id }} {{ old('tiposolicitudes_id', $solicitude?->tiposolicitudes_id) == $tiposolicitude->id ? 'selected' : '' }}>
                    {{ $tiposolicitude->nombreTipo }}
                </option>
            @endforeach
        </select>
        @error('tiposolicitudes_id')
            <div class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>

        <div class="form-group mb-2 mb20">
            <label for="descripcion" class="form-label">{{ __('Descripcion') }}</label>
            <input type="text" name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" value="{{ old('descripcion', $solicitude?->descripcion) }}" id="descripcion" placeholder="Descripcion">
            {!! $errors->first('descripcion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
       <div class="form-group mb-2">
            <label for="estatus" class="form-label">{{ __('Estatus') }}</label>
            <select class="form-select @error('estatus') is-invalid @enderror" name="estatus" id="estatus">
                <option value="{{ $solicitude->estatus }}" selected>{{ $solicitude->estatus }}</option>
                <option value="PENDIENTE" {{ old('estatus', $solicitude?->solicitude) == 'PENDIENTE' ? 'selected' : '' }}>PENDIENTE</option>
                <option value="EN PROCESO" {{ old('estatus', $solicitude?->solicitude) == 'EN PROCESO' ? 'selected' : '' }}>EN PROCESO</option>
                <option value="FINALIZADA" {{ old('estatus', $solicitude?->solicitude) == 'FINALIZADA' ? 'selected' : '' }}>FINALIZADA</option>
            </select>
            @error('solicitud')
                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
        <input type="hidden" name="users_id" value="{{ auth()->user()->id }}">


    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
