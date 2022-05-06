@extends('adminlte::page')

@section('title', 'Edtar Anuncio')

@section('content_header')
    <h1>Crear nuevo anuncio</h1>
@stop

@section('content')
	<div class="card">
		<div class="card-body">
			{!! Form::model($anuncio, ['route' => ['admin.anuncios.update', $anuncio], 'method' => 'put']) !!}
				
				@include('admin.anuncios.partials.form')

				{!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
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