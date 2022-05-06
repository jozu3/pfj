@extends('adminlte::page')

@section('title', 'Crear cuenta')

@section('content_header')
    <h1>Crear nueva cuenta</h1>
@stop

@section('content')
	<div class="card">
		<div class="card-body">
			{!! Form::open(['route' => 'admin.cuentas.store']) !!}
				
				@include('admin.cuentas.partials.form')
				
				<br>
				<div class="form-group">
					
				{!! Form::submit('Crear cuenta', ['class' => 'btn btn-primary']) !!}
				</div>
			{!! Form::close() !!}
		</div>
	</div>
@stop

@section('css')
    <link rel="stylesheet" href="">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop