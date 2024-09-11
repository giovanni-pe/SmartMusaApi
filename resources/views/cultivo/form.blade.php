<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="nombre" class="form-label">{{ __('Nombre') }}</label>
            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $cultivo?->nombre) }}" id="nombre" placeholder="Nombre">
            {!! $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="descripcion" class="form-label">{{ __('Descripcion') }}</label>
            <input type="text" name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" value="{{ old('descripcion', $cultivo?->descripcion) }}" id="descripcion" placeholder="Descripcion">
            {!! $errors->first('descripcion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="limite_max_humedad_soportada" class="form-label">{{ __('Limite Max Humedad Soportada') }}</label>
            <input type="text" name="limite_max_humedad_soportada" class="form-control @error('limite_max_humedad_soportada') is-invalid @enderror" value="{{ old('limite_max_humedad_soportada', $cultivo?->limite_max_humedad_soportada) }}" id="limite_max_humedad_soportada" placeholder="Limite Max Humedad Soportada">
            {!! $errors->first('limite_max_humedad_soportada', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="limite_min_humedad_soportada" class="form-label">{{ __('Limite Min Humedad Soportada') }}</label>
            <input type="text" name="limite_min_humedad_soportada" class="form-control @error('limite_min_humedad_soportada') is-invalid @enderror" value="{{ old('limite_min_humedad_soportada', $cultivo?->limite_min_humedad_soportada) }}" id="limite_min_humedad_soportada" placeholder="Limite Min Humedad Soportada">
            {!! $errors->first('limite_min_humedad_soportada', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="limite_max_temperatura_soportada" class="form-label">{{ __('Limite Max Temperatura Soportada') }}</label>
            <input type="text" name="limite_max_temperatura_soportada" class="form-control @error('limite_max_temperatura_soportada') is-invalid @enderror" value="{{ old('limite_max_temperatura_soportada', $cultivo?->limite_max_temperatura_soportada) }}" id="limite_max_temperatura_soportada" placeholder="Limite Max Temperatura Soportada">
            {!! $errors->first('limite_max_temperatura_soportada', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="limite_min_temperatura_soportada" class="form-label">{{ __('Limite Min Temperatura Soportada') }}</label>
            <input type="text" name="limite_min_temperatura_soportada" class="form-control @error('limite_min_temperatura_soportada') is-invalid @enderror" value="{{ old('limite_min_temperatura_soportada', $cultivo?->limite_min_temperatura_soportada) }}" id="limite_min_temperatura_soportada" placeholder="Limite Min Temperatura Soportada">
            {!! $errors->first('limite_min_temperatura_soportada', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="estado" class="form-label">{{ __('Estado') }}</label>
            <input type="text" name="estado" class="form-control @error('estado') is-invalid @enderror" value="{{ old('estado', $cultivo?->estado) }}" id="estado" placeholder="Estado">
            {!! $errors->first('estado', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="vivero_id" class="form-label">{{ __('Vivero Id') }}</label>
            <input type="text" name="vivero_id" class="form-control @error('vivero_id') is-invalid @enderror" value="{{ old('vivero_id', $cultivo?->vivero_id) }}" id="vivero_id" placeholder="Vivero Id">
            {!! $errors->first('vivero_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>