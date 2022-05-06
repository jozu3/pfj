@extends('adminlte::page')

@section('title', 'Editar pfj')

@section('content_header')
    <h1>Editar pfj</h1>
@stop

@section('content')
	@if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
	<div class="card">
		<div class="card-body">
			{!! Form::model($pfj, ['route' => ['admin.pfjs.update', $pfj], 'method' => 'put']) !!}
				
				@include('admin.pfjs.partials.form')
				
				<br>
				<div class="form-group">
					
				{!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
				</div>
			{!! Form::close() !!}
		</div>
	</div>
	{{-- <div class="card">
		<div class="card-header">
			Sesiones
     		<a href="{{ route('admin.programas.create', 'idprograma='.$pfj->id) }}" class="btn btn-success btn-sm float-right">Nueva sesión</a>
		</div>
		<div class="card-body">
    		<table class="table table-striped">
    			<thead>
    				<tr>
    					<th>Nobmre</th>
                        <th>Fecha de inicio</th>
                        <th>Fecha de fin</th>
    					<th>Estado</th>
    					<th colspan="2"></th>
    				</tr>
    			</thead>
    			<tbody>
    				@foreach($pfj->programas as $programa)
    				  <tr>
    				  	<td>{{ $programa->pfj->nombre }}</td>
                        <td>{{ $programa->fecha_inicio }}</td>
                        <td>{{ $programa->fecha_fin }}</td>
    				  	<td>
                            @if ($programa->estado == 0)
                                {{ 'Por iniciar' }}
                            @endif
                            @if ($programa->estado == 1)
                                {{ 'Iniciado' }}
                            @endif
                            @if ($programa->estado == 2)
                                {{ 'Terminado' }}
                            @endif
                        </td>
    				  	<td width="10px">
    				  		<a href="{{ route('admin.programas.edit', $programa) }}" class="btn btn-sm btn-primary" >Editar</a>
    				  	</td>
    				  	<td width="10px">
							<form method="POST" action="{{ route('admin.programas.destroy', $programa) }}">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
							</form>
						</td>
    				  </tr>
    				@endforeach

    			</tbody>
    		</table>
    	</div>
	</div> --}}
    <h4>Listado de sesiones del {{ $pfj->nombre }}</h4>
    @livewire('admin.programas-index', ['pfj_id' => $pfj->id, 'terminado' => false])

@stop

@section('css')
    <link rel="stylesheet" href="">
    <style>
		td{
			vertical-align: middle!important
		}
		.avatar-circle{
            width:130px;
            height: 130px;
            object-fit: cover;
            object-position: center
        }
    </style>
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop