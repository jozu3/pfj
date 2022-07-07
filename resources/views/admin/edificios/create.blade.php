@extends('adminlte::page')

@section('title', 'Crear edificio')

@section('content_header')
    <h1>Crear nuevo edificio</h1>
@stop

@section('content')
	<div class="card">
		<div class="card-body">
			{!! Form::open(['route' => 'admin.edificios.store']) !!}
				
				@include('admin.edificios.partials.form')

				{!! Form::submit('Crear edificio', ['class' => 'btn btn-primary']) !!}
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