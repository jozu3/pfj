@extends('adminlte::page')

@section('title', 'Sesiones')

@section('content_header')
    <h1>Dashboard Participantes</h1>
@stop

@section('plugins.Chartjs', true)

@section('content')
	@if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Bienvenida de Participantes</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Estado de los participantes</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex items-center">
                                        <div style="width:20px; height: 100%; align-items: center" class="">
                                            <div class="spinner-grow text-success" style="width:20px; height: 20px;" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                        <div style="width: 80px">
                                            {{ 'En espera' }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{ $programa->participantes->where('estado', 5)->count() }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="fas fa-sign-in-alt"></i> Ingresó
                                </td>
                                <td>
                                    {{ $programa->participantes->where('estado', 1)->count() }}
                                </td>
                            </tr>
                        </tbody>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style type="text/css">

    </style>
@stop

@section('js')
   <script></script>
@stop