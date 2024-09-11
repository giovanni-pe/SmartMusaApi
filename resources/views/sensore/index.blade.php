@extends('layouts.app')

@section('template_title')
    Sensore
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Sensore') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('sensores.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Tipo</th>
										<th>Estado</th>
										<th>Estado Riego</th>
										<th>Vivero Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sensores as $sensore)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $sensore->tipo }}</td>
											<td>{{ $sensore->estado }}</td>
											<td>{{ $sensore->estado_riego }}</td>
											<td>{{ $sensore->vivero_id }}</td>

                                            <td>
                                                <form action="{{ route('sensores.destroy',$sensore->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('sensores.show',$sensore->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('sensores.edit',$sensore->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $sensores->links() !!}
            </div>
        </div>
    </div>
@endsection
