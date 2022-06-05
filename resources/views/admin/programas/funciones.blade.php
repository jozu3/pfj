@extends('adminlte::page')

@section('title', 'Sesiones')

@section('content_header')
    <h1><b class="text-pfj">Funciones</b></h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            @livewire('admin.funciones-index', ['programa' => $programa])
        </div>
    </div>
@stop