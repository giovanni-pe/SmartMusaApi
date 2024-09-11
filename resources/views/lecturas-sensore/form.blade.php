<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="fecha_hora" class="form-label">{{ __('Fecha Hora') }}</label>
            <input type="text" name="fecha_hora" class="form-control @error('fecha_hora') is-invalid @enderror" value="{{ old('fecha_hora', $lecturasSensore?->fecha_hora) }}" id="fecha_hora" placeholder="Fecha Hora">
            {!! $errors->first('fecha_hora', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="humedad_relativa" class="form-label">{{ __('Humedad Relativa') }}</label>
            <input type="text" name="humedad_relativa" class="form-control @error('humedad_relativa') is-invalid @enderror" value="{{ old('humedad_relativa', $lecturasSensore?->humedad_relativa) }}" id="humedad_relativa" placeholder="Humedad Relativa">
            {!! $errors->first('humedad_relativa', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="humedad_sustrato" class="form-label">{{ __('Humedad Sustrato') }}</label>
            <input type="text" name="humedad_sustrato" class="form-control @error('humedad_sustrato') is-invalid @enderror" value="{{ old('humedad_sustrato', $lecturasSensore?->humedad_sustrato) }}" id="humedad_sustrato" placeholder="Humedad Sustrato">
            {!! $errors->first('humedad_sustrato', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="temperatura_ambiente" class="form-label">{{ __('Temperatura Ambiente') }}</label>
            <input type="text" name="temperatura_ambiente" class="form-control @error('temperatura_ambiente') is-invalid @enderror" value="{{ old('temperatura_ambiente', $lecturasSensore?->temperatura_ambiente) }}" id="temperatura_ambiente" placeholder="Temperatura Ambiente">
            {!! $errors->first('temperatura_ambiente', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="sensore_id" class="form-label">{{ __('Sensore Id') }}</label>
            <input type="text" name="sensore_id" class="form-control @error('sensore_id') is-invalid @enderror" value="{{ old('sensore_id', $lecturasSensore?->sensore_id) }}" id="sensore_id" placeholder="Sensore Id">
            {!! $errors->first('sensore_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>