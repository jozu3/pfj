@extends('adminlte::page')

@section('title', 'Profesores')

@section('content_header')
    <a href="{{ route('admin.profesores.create') }}" class="btn btn-success btn-sm float-right">Nuevo profesor</a>
    <h1>Lista de profesores</h1>
@stop

@section('content')
	@if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
    @livewire('admin.profesores-index')
@stop

@section('css')
    <link rel="stylesheet" href="">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop