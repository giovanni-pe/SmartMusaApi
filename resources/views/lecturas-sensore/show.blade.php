@extends('layouts.app')

@section('template_title')
    {{ $lecturasSensore->name ?? __('Show') . " " . __('Lecturas Sensore') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Lecturas Sensore</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('lecturas-sensores.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                        <div class="form-group mb-2 mb20">
                            <strong>Fecha Hora:</strong>
                            {{ $lecturasSensore->fecha_hora }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Humedad Relativa:</strong>
                            {{ $lecturasSensore->humedad_relativa }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Humedad Sustrato:</strong>
                            {{ $lecturasSensore->humedad_sustrato }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Temperatura Ambiente:</strong>
                            {{ $lecturasSensore->temperatura_ambiente }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Sensore Id:</strong>
                            {{ $lecturasSensore->sensore_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
