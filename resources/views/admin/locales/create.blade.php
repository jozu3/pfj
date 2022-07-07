@extends('adminlte::page')

@section('title', 'Crear local')

@section('content_header')
    <h1>Crear nuevo local</h1>
@stop

@section('content')
	<div class="card">
		<div class="card-body">
			{!! Form::open(['route' => 'admin.locales.store']) !!}
				
				@include('admin.locales.partials.form')

				{!! Form::submit('Crear locale', ['class' => 'btn btn-primary']) !!}
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