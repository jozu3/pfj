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
                                            <div class="spinner-grow text-success" style="width:20px; height: 20px;"
                                                role="status">
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
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Compañias</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Compañias</th>
                                <th>Total</th>
                                <th>Inscritos</th>
                                <th>En espera</th>
                                <th>Ingresó</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($programa->companias() as $companerismo)
                                <tr>
                                    <td>
                                        {{ 'Compañia: ' . $companerismo->numero }}
                                    </td>
                                    <td>
                                        {{ $companerismo->participanteCompanias->count() }}
                                    </td>
                                    <td>
                                        {{ $companerismo->participantes()->where('estado', '0')->count() }}
                                    </td>
                                    <td>
                                        {{ $companerismo->participantes()->where('estado', '5')->count() }}
                                    </td>
                                    <td>
                                        {{ $companerismo->participantes()->where('estado', '1')->count() }}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Estacas</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Estaca</th>
                                <th>Total</th>
                                <th>Inscritos</th>
                                <th>En espera</th>
                                <th>Ingresó</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($estacas as $estaca)
                                @if ($estaca->participantes()->count())
                                    <tr>
                                        <td>
                                            {{ $estaca->nombre }}
                                        </td>
                                        <td>
                                            {{ $estaca->participantes()->count() }}
                                        </td>
                                        <td>
                                            {{ $estaca->participantes()->where('estado', '0')->count() }}
                                        </td>
                                        <td>
                                            {{ $estaca->participantes()->where('estado', '5')->count() }}
                                        </td>
                                        <td>
                                            {{ $estaca->participantes()->where('estado', '1')->count() }}
                                        </td>
                                    </tr>
                                @endif
                            @endforeach

                        </tbody>
                    </table>
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
