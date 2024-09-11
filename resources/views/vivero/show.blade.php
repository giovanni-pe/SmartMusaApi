@extends('layouts.app')

@section('template_title')
    {{ $vivero->name ?? __('Show') . " " . __('Vivero') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Vivero</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('viveros.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                        <div class="form-group mb-2 mb20">
                            <strong>Nombre:</strong>
                            {{ $vivero->nombre }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Lado:</strong>
                            {{ $vivero->lado }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Alto:</strong>
                            {{ $vivero->alto }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Ancho:</strong>
                            {{ $vivero->ancho }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Latitud:</strong>
                            {{ $vivero->latitud }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Longitud:</strong>
                            {{ $vivero->longitud }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Descripcion:</strong>
                            {{ $vivero->descripcion }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>User Id:</strong>
                            {{ $vivero->user_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
