@extends('adminlte::page')

@section('title', 'Sesiones')

@section('content_header')
    <h1>Lista de Sesiones</h1>
@stop

@section('content')
	@if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
    @livewire('admin.programas-index')
@stop

@section('css')
    <style type="text/css">
        .card-body {
            overflow: auto;
        }
        td{
            vertical-align: middle!important
        }
        .avatar-circle{
            width:130px;
            height: 130px;
            object-fit: cover;
            object-position: center
        }
    </style>
@stop

@section('js')
    <script> console.log('Hi!');
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
        })
 </script>
@stop