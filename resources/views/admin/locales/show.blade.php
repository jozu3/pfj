@extends('adminlte::page')

@section('title', 'Locales')

@section('content_header')
    <a href="{{ route('admin.edificios.create') }}" class="btn btn-success btn-sm float-right">Nuevo Edificio</a>
    <h1>Administrar local</h1>
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
    @livewire('admin.locale-edificios')
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