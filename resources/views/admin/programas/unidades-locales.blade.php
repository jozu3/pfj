@extends('adminlte::page')

@section('title', 'Unidades locales')

@section('content_header')
    <h1>Estacas Participantes - {{ $programa->pfj->nombre . ' ' . $programa->nombre }}</h1>
@stop

@section('content')
	@if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
    @livewire('admin.programa.unidades-locales', ['programa' => $programa])
@stop

@section('css')
    <style type="text/css">
        .card-body {
            overflow: auto;
        }
        td{
            vertical-align: middle!important
        }
    </style>
@stop

@section('js')
    <script> 
        console.log('Hi!'); 
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@stop