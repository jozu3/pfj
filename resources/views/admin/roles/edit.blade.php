@extends('adminlte::page')

@section('title', 'Editar rol')

@section('content_header')
    <h1>Editar rol</h1>
@stop

@section('content')
	@if (session('info'))
		<div class="alert alert-success">
			{{ session('info') }}
		</div>
	@endif
    <div class="card">
		<div class="card-body">
			{!! Form::model($role, ['route' => ['admin.roles.update', $role], 'method' => 'put']) !!}
			
				@include('admin.roles.partials.form')

				{!! Form::submit('Actualizar Rol', ['class' => 'btn btn-primary']) !!}
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