<div class="row padding-1 p-1">
    <div class="col-md-12">

        <div class="form-group mb-2 mb20">
            <label for="nombre_tipo" class="form-label">Nombre</label>
            <input type="text" name="nombreTipo" class="form-control @error('nombreTipo') is-invalid @enderror" value="{{ old('nombreTipo', $tiposolicitude?->nombreTipo) }}" id="nombre_tipo" placeholder="Nombre de solicitud">
            {!! $errors->first('nombreTipo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
