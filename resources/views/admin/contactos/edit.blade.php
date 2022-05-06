@extends('adminlte::page')

@section('title', 'Editar contacto')

@section('content_header')
    <h1>Editar contacto</h1>
@stop

@section('content')
	@if (session('info'))
		<div class="alert alert-success">
			{{ session('info') }}
		</div>
	@endif
    <div class="card">
		<div class="card-body">
			
		</div>
	</div>
@stop

@section('css')
    <link rel="stylesheet" href="">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop