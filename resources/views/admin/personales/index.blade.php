@extends('adminlte::page')

@section('title', 'Personales')

@section('content_header')
    <a href="{{ route('admin.contactos.index') }}" class="btn btn-success btn-sm float-right">Nuevo personal</a>
    <h1>Lista de personales</h1>
@stop

@section('content')
	@if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
    @livewire('admin.personales-index')
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