@extends('adminlte::page')

@section('title', 'Sesiones')

@section('content_header')
    {{-- <a href="{{ route('admin.users.create') }}" class="btn btn-success btn-sm float-right">Nuevo usuario</a> --}}
    <h1>Lista de Sesiones activas</h1>
@stop

@section('content')
	@if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
    @livewire('admin.sessions-index')
@stop

@section('css')
    <link rel="stylesheet" href="">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop