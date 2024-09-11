@extends('layouts.app')

@section('template_title')
    Cultivo
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Cultivo') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('cultivos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Nombre</th>
										<th>Descripcion</th>
										<th>Limite Max Humedad Soportada</th>
										<th>Limite Min Humedad Soportada</th>
										<th>Limite Max Temperatura Soportada</th>
										<th>Limite Min Temperatura Soportada</th>
										<th>Estado</th>
										<th>Vivero Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cultivos as $cultivo)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $cultivo->nombre }}</td>
											<td>{{ $cultivo->descripcion }}</td>
											<td>{{ $cultivo->limite_max_humedad_soportada }}</td>
											<td>{{ $cultivo->limite_min_humedad_soportada }}</td>
											<td>{{ $cultivo->limite_max_temperatura_soportada }}</td>
											<td>{{ $cultivo->limite_min_temperatura_soportada }}</td>
											<td>{{ $cultivo->estado }}</td>
											<td>{{ $cultivo->vivero_id }}</td>

                                            <td>
                                                <form action="{{ route('cultivos.destroy',$cultivo->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('cultivos.show',$cultivo->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('cultivos.edit',$cultivo->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $cultivos->links() !!}
            </div>
        </div>
    </div>
@endsection
