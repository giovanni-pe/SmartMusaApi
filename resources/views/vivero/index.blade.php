@extends('layouts.app')

@section('template_title')
    Vivero
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Vivero') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('viveros.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
										<th>Lado</th>
										<th>Alto</th>
										<th>Ancho</th>
										<th>Latitud</th>
										<th>Longitud</th>
										<th>Descripcion</th>
										<th>User Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($viveros as $vivero)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $vivero->nombre }}</td>
											<td>{{ $vivero->lado }}</td>
											<td>{{ $vivero->alto }}</td>
											<td>{{ $vivero->ancho }}</td>
											<td>{{ $vivero->latitud }}</td>
											<td>{{ $vivero->longitud }}</td>
											<td>{{ $vivero->descripcion }}</td>
											<td>{{ $vivero->user_id }}</td>

                                            <td>
                                                <form action="{{ route('viveros.destroy',$vivero->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('viveros.show',$vivero->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('viveros.edit',$vivero->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $viveros->links() !!}
            </div>
        </div>
    </div>
@endsection
