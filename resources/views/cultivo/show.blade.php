@extends('layouts.app')

@section('template_title')
    {{ $cultivo->name ?? __('Show') . " " . __('Cultivo') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Cultivo</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('cultivos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                        <div class="form-group mb-2 mb20">
                            <strong>Nombre:</strong>
                            {{ $cultivo->nombre }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Descripcion:</strong>
                            {{ $cultivo->descripcion }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Limite Max Humedad Soportada:</strong>
                            {{ $cultivo->limite_max_humedad_soportada }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Limite Min Humedad Soportada:</strong>
                            {{ $cultivo->limite_min_humedad_soportada }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Limite Max Temperatura Soportada:</strong>
                            {{ $cultivo->limite_max_temperatura_soportada }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Limite Min Temperatura Soportada:</strong>
                            {{ $cultivo->limite_min_temperatura_soportada }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Estado:</strong>
                            {{ $cultivo->estado }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Vivero Id:</strong>
                            {{ $cultivo->vivero_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
