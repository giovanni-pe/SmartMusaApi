<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="tipo" class="form-label">{{ __('Tipo') }}</label>
            <input type="text" name="tipo" class="form-control @error('tipo') is-invalid @enderror" value="{{ old('tipo', $sensore?->tipo) }}" id="tipo" placeholder="Tipo">
            {!! $errors->first('tipo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="estado" class="form-label">{{ __('Estado') }}</label>
            <input type="text" name="estado" class="form-control @error('estado') is-invalid @enderror" value="{{ old('estado', $sensore?->estado) }}" id="estado" placeholder="Estado">
            {!! $errors->first('estado', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="estado_riego" class="form-label">{{ __('Estado Riego') }}</label>
            <input type="text" name="estado_riego" class="form-control @error('estado_riego') is-invalid @enderror" value="{{ old('estado_riego', $sensore?->estado_riego) }}" id="estado_riego" placeholder="Estado Riego">
            {!! $errors->first('estado_riego', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="vivero_id" class="form-label">{{ __('Vivero Id') }}</label>
            <input type="text" name="vivero_id" class="form-control @error('vivero_id') is-invalid @enderror" value="{{ old('vivero_id', $sensore?->vivero_id) }}" id="vivero_id" placeholder="Vivero Id">
            {!! $errors->first('vivero_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>