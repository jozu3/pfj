@extends('adminlte::page')

@section('title', 'Sesiones')

@section('content_header')
    <h1>Materiales para las tareas semanal</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            @livewire('admin.materiales-index')
        </div>
    </div>
@stop
