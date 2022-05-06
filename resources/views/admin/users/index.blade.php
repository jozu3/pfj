@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    {{-- <a href="{{ route('admin.users.create') }}" class="btn btn-success btn-sm float-right">Nuevo usuario</a> --}}
    <h1>Lista de usuarios</h1>
@stop

@section('content')
	@if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
    @livewire('admin.users-index')
@stop

@section('css')
    <link rel="stylesheet" href="">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop