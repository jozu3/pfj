@extends('adminlte::page')

@section('title', 'Crear pfj')

@section('content_header')
    <h1>Crear nuevo pfj</h1>
@stop

@section('content')
	<div class="card">
		<div class="card-body">
			{!! Form::open(['route' => 'admin.pfjs.store']) !!}
				
				@include('admin.pfjs.partials.form')
				
				<br>
				<div class="form-group">
					
				{!! Form::submit('Crear pfj', ['class' => 'btn btn-primary']) !!}
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