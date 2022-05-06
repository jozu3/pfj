@extends('adminlte::page')

@section('title', 'Seguimiento')

@section('content_header')
    <h1>Seguimiento a contactos</h1>
@stop

@section('content')
	@if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
    
    @livewire('admin.seguimientos-index')
@stop

@section('css')
    <link rel="stylesheet" href="">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop