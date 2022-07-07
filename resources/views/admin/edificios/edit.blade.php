@extends('adminlte::page')

@section('title', 'Editar edificio')

@section('content_header')
    <h1>Editar nuevo edificio</h1>
@stop

@section('content')
	<div class="card">
		<div class="card-body">
			{!! Form::model($edificio, ['route' => 'admin.edificios.update', $edificio, 'method' => 'put']) !!}				
				@include('admin.edificios.partials.form')
				{!! Form::submit('Editar edificio', ['class' => 'btn btn-primary']) !!}
			{!! Form::close() !!}
		</div>
	</div>
@stop

@section('css')
    <link rel="stylesheet" href="">
@stop

@section('js')
    <script> 
	 </script>
@stop