@extends('layouts.app')

@section('template_title')
    Lecturas Sensore
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Lecturas Sensore') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('lecturas-sensores.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Fecha Hora</th>
										<th>Humedad Relativa</th>
										<th>Humedad Sustrato</th>
										<th>Temperatura Ambiente</th>
										<th>Sensore Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lecturasSensores as $lecturasSensore)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $lecturasSensore->fecha_hora }}</td>
											<td>{{ $lecturasSensore->humedad_relativa }}</td>
											<td>{{ $lecturasSensore->humedad_sustrato }}</td>
											<td>{{ $lecturasSensore->temperatura_ambiente }}</td>
											<td>{{ $lecturasSensore->sensore_id }}</td>

                                            <td>
                                                <form action="{{ route('lecturas-sensores.destroy',$lecturasSensore->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('lecturas-sensores.show',$lecturasSensore->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('lecturas-sensores.edit',$lecturasSensore->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $lecturasSensores->links() !!}
            </div>
        </div>
    </div>
@endsection
