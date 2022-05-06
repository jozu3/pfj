@extends('adminlte::page')

@section('title', 'Mis sesiones inscritas')

@section('content_header')
    <h1>Lista de Sesiones</h1>
@stop

@section('content')
	@if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
    @livewire('admin.programas-index', ['mis_programas' => true])
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