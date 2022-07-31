@extends('adminlte::page')

@section('title', 'Personales')

@section('content_header')
    <a href="{{ route('admin.habitaciones.create') }}" class="btn btn-success btn-sm float-right">Nuevo habitación</a>
    <h1>Lista de habitaciones</h1>
@stop

@section('content')
	@if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
    @livewire('admin.habitaciones-index')
@stop

@section('css')
    <style type="text/css">
        .card-body {
            overflow: auto;
        }
    </style>
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop