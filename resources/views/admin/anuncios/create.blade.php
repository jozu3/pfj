@extends('adminlte::page')

@section('title', 'Crear Anuncio')

@section('content_header')
    <h1>Crear nuevo anuncio</h1>
@stop

@section('content')
	<div class="card">
		<div class="card-body">
			{!! Form::open(['route' => 'admin.anuncios.store']) !!}
				
				@include('admin.anuncios.partials.form')

				{!! Form::submit('Crear Anuncio', ['class' => 'btn btn-primary']) !!}
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