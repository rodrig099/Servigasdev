<div class="row p-1">
    <div class="col-md-12">
        <!-- Campo de selección de tipo de solicitud -->
        <div class="form-group mb-2">
            <label for="solicitud" class="form-label">{{ __('Solicitud') }}</label>
            <select class="form-select @error('solicitud') is-invalid @enderror" name="solicitud" id="solicitud">
                <option value="" disabled {{ old('solicitud', $solicitud?->solicitud) ? '' : 'selected' }}>Tipo de solicitud</option>
                <option value="Revisión" {{ old('solicitud', $solicitud?->solicitud) == 'Revisión' ? 'selected' : '' }}>Revisión</option>
                <option value="Certificación" {{ old('solicitud', $solicitud?->solicitud) == 'Certificación' ? 'selected' : '' }}>Certificación</option>
                <option value="Mantenimiento" {{ old('solicitud', $solicitud?->solicitud) == 'Mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
            </select>
            @error('solicitud')
                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
            @enderror
        </div>

        <!-- Campo de entrada de mensaje -->
        <div class="form-group mb-2">
            <label for="mensaje" class="form-label">{{ __('Mensaje') }}</label>
            <input type="text" name="mensaje" class="form-control @error('mensaje') is-invalid @enderror" value="{{ old('mensaje', $solicitud?->mensaje) }}" id="mensaje" placeholder="Mensaje">
            @error('mensaje')
                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
    </div>

    <!-- Botón de envío -->
    <div class="col-md-12 mt-2">
        <button type="submit" class="btn btn-success">{{ __('Submit') }}</button>
    </div>
</div>
