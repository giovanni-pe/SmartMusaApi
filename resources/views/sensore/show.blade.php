@extends('layouts.app')

@section('template_title')
    {{ $sensore->name ?? __('Show') . " " . __('Sensore') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Sensore</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('sensores.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                        <div class="form-group mb-2 mb20">
                            <strong>Tipo:</strong>
                            {{ $sensore->tipo }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Estado:</strong>
                            {{ $sensore->estado }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Estado Riego:</strong>
                            {{ $sensore->estado_riego }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Vivero Id:</strong>
                            {{ $sensore->vivero_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
