
@extends('adminlte::page')

@section('title', 'PFJ')

@section('content_header')
    <h1>Crear habitación</h1>
@stop

@section('content')
@if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
	<div class="card">
		<div class="card-body">
			{!! Form::model($habitacione, ['route' => ['admin.habitaciones.update', $habitacione], 'method' => 'put']) !!}
				
				@include('admin.habitaciones.partials.form')

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