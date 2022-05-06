@extends('adminlte::page')

@section('title', 'Editar unidad')

@section('content_header')
    <a href="{{ route('admin.grupos.edit', $unidad->grupo) }}" class="float-right">Volver al grupo: <b> {{$unidad->grupo->pfj->nombre}}</b> <i class="fas fa-chevron-right"></i></a>
    <h1>Editar unidad</h1>
@stop

@section('content')
	@if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
	<div class="card">
		<div class="card-body">
			{!! Form::model($unidad, ['route' => ['admin.grupos.update', $unidad], 'method' => 'put']) !!}
				
				@include('admin.grupos.partials.form')
				
				<br>
				<div class="col-md-12">
					
					{!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
				</div>
			{!! Form::close() !!}
		</div>
	</div>
	
    @livewire('admin.notas-index', [ 'unidad' => $unidad])
	
	@if (session('info-clase'))
		<div class="alert alert-success">
			{{ session('info-clase') }}
		</div>
	@endif
	<div class="card">
		<div class="card-header">
			<h3>Clases</h3>
		</div>
		<div class="card-body">
			@if ($unidad->clases->count())
        		@livewire('admin.clases-index', [ 'unidad' => $unidad])
        	@else
				<div class="text-warning">Aun no se han generado las clases</div>
			@endif
		</div>
		
	</div>
@stop

@section('css')
    <link rel="stylesheet" href="">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop