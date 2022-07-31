
@extends('adminlte::page')

@section('title', 'PFJ')

@section('content_header')
    <h1>Asignar participante a una compañia</h1>
@stop

@section('content')
	<div class="card">
		<div class="card-body">
			{!! Form::open(['route' => 'admin.participanteCompanias.store']) !!}
				
				@include('admin.participanteCompanias.partials.form')

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