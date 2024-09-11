<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="nombre" class="form-label">{{ __('Nombre') }}</label>
            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $vivero?->nombre) }}" id="nombre" placeholder="Nombre">
            {!! $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="lado" class="form-label">{{ __('Lado') }}</label>
            <input type="text" name="lado" class="form-control @error('lado') is-invalid @enderror" value="{{ old('lado', $vivero?->lado) }}" id="lado" placeholder="Lado">
            {!! $errors->first('lado', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="alto" class="form-label">{{ __('Alto') }}</label>
            <input type="text" name="alto" class="form-control @error('alto') is-invalid @enderror" value="{{ old('alto', $vivero?->alto) }}" id="alto" placeholder="Alto">
            {!! $errors->first('alto', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="ancho" class="form-label">{{ __('Ancho') }}</label>
            <input type="text" name="ancho" class="form-control @error('ancho') is-invalid @enderror" value="{{ old('ancho', $vivero?->ancho) }}" id="ancho" placeholder="Ancho">
            {!! $errors->first('ancho', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="latitud" class="form-label">{{ __('Latitud') }}</label>
            <input type="text" name="latitud" class="form-control @error('latitud') is-invalid @enderror" value="{{ old('latitud', $vivero?->latitud) }}" id="latitud" placeholder="Latitud">
            {!! $errors->first('latitud', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="longitud" class="form-label">{{ __('Longitud') }}</label>
            <input type="text" name="longitud" class="form-control @error('longitud') is-invalid @enderror" value="{{ old('longitud', $vivero?->longitud) }}" id="longitud" placeholder="Longitud">
            {!! $errors->first('longitud', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="descripcion" class="form-label">{{ __('Descripcion') }}</label>
            <input type="text" name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" value="{{ old('descripcion', $vivero?->descripcion) }}" id="descripcion" placeholder="Descripcion">
            {!! $errors->first('descripcion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="user_id" class="form-label">{{ __('User Id') }}</label>
            <input type="text" name="user_id" class="form-control @error('user_id') is-invalid @enderror" value="{{ old('user_id', $vivero?->user_id) }}" id="user_id" placeholder="User Id">
            {!! $errors->first('user_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>