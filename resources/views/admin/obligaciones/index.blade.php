@extends('adminlte::page')

@section('title', 'Pagos')

@section('content_header')
    <h1>Lista de Obligaciones por pagar</h1>
@stop

@section('content')
	@if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
    @livewire('admin.obligaciones-index')
@stop

@section('css')
    <link rel="stylesheet" href="">

@stop

@section('js')

    <script> console.log('Hi!'); </script>
@stop