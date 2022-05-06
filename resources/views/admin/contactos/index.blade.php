@extends('adminlte::page')

@section('title', 'PFJ')

@section('content_header')
    <a href="{{ route('admin.contactos.create') }}" class="btn btn-success btn-sm float-right">Nuevo contacto</a>
    <h1>Lista de contactos</h1>
@stop

@section('content')
	@if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-success">
            {{ session('error') }}
        </div>
    @endif
    @livewire('admin.contactos-index')
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