@extends('adminlte::page')

@section('title', 'Personale')

@section('content_header')
    <h1>Editar personale</h1>
@stop

@section('content')
	@if (session('info'))
		<div class="alert alert-success">
			{{ session('info') }}
		</div>
	@endif
    <div class="card">
        <div class="card-header">
            <h4>Código de personale: {{ $personale->codigo }}</h4>
        </div>
		<div class="card-body">
			{!! Form::model($personale->contacto, ['route' => ['admin.personales.update', $personale], 'method' => 'put']) !!}
				@include('admin.contactos.partials.form')
				<div class="row">
					<div class="col-md-12">
							{!! Form::label('estado', 'Estado') !!}
							{!! Form::select('estado', [
									'1' => 'No contactado',
									'2' => 'Contactado',
									'3' => 'Probable',
									'4' => 'Confirmado',
									'5' => 'Inscripcionedo',
								], null, ['class' => 'form-control', 'placeholder' => 'Escoge', 'disabled' => 'disabled', 'style' => 'appearance: none; ']); !!}
					</div>
				</div>
				{!! Form::submit('Guardar cambios', ['class' => 'btn btn-primary mt-2']) !!}
			{!! Form::close() !!}
		</div>
	</div>
	<div class="card">
		<div class="card-body">
			<table class="table table-striped">
    			<thead>
    				<tr>
    					<th>Fecha de matrícula</th>
                        <th>Pfj</th>
                        <th>Grupo</th>
    					<th>Estado</th>
    					<th colspan="2"></th>
    				</tr>
    			</thead>
    			<tbody>
    				@foreach($personale->inscripciones as $inscripcione)
    				  <tr>
    				  	<td>{{ $inscripcione->fecha }}</td>
    				  	<td>
                            {{ $inscripcione->grupo->pfj->nombre }}
                        </td>
                        <td>                            
                            {{ $inscripcione->grupo->fecha }}
                        </td>
                        <td>
                            @switch($inscripcione->estado)
                                @case(0)
                                    {{ 'Habilitado' }}
                                    @break
                                @case(1)
                                    {{ 'Retirado' }}
                                    @break
                                @case(2)
                                    {{ 'Suspendido' }}
                                    @break
                                @default
                            @endswitch                            
                        </td>
    				  	<td width="120px">
                            <a href="{{ route('admin.grupos.show', $inscripcione->grupo) }}" class="btn btn-sm btn-primary" >Ver grupo</a>
                        </td>
                        <td width="120px">
                            <a href="{{ route('admin.inscripciones.show', $inscripcione) }}" class="btn btn-sm btn-primary" >Ver matrícula</a>
                        </td>
    				  </tr>
    				@endforeach

    			</tbody>
    		</table>
		</div>
	</div>
@stop

@section('css')
    <link rel="stylesheet" href="">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop