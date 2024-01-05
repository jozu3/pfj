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
                    <table class="table table-sm table-striped">
                        <thead>
                            <tr>
                                <th>Estado de los participantes</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <i class="fas fa-check-circle"></i> Inscritos
                                </td>
                                <td>
                                    {{ $programa->participantes->where('estado', 0)->count() }}
                                </td>
                            </tr>
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
                    <table class="table table-sm table-striped">
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
                                        <br>
                                        {{ 'H:' .$companerismo->participantes()->where('genero', 1)->count() }}
                                        {{ 'M:' .$companerismo->participantes()->where('genero', 0)->count() }}

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
                    <table class="table table-sm table-striped">
                        <thead>
                            <tr>
                                <th>Estaca</th>
                                <th>Total</th>
                                <th>Inscritos</th>
                                <th>En espera</th>
                                <th>Ingresó</th>
                                <th>Terminado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $estacas_count = 0;
                                $participantes = 0;
                                $participantes_h = 0;
                                $participantes_m = 0;
                                $participantes_0 = 0;
                                $participantes_5 = 0;
                                $participantes_1 = 0;
                                $participantes_3 = 0;
                            @endphp
                            @foreach ($estacas as $estaca)
                                @if ($estaca->participantesPrograma($programa)->count())
                                    <tr>
                                        @php
                                            $estacas_count++;
                                            $participantes = $participantes + $estaca->participantesPrograma($programa)->whereIn('estado', [0,5,1,3])->count() ;
                                            $participantes_h = $participantes_h + $estaca->participantesPrograma($programa)->where('genero', 1)->count();
                                            $participantes_m = $participantes_m + $estaca->participantesPrograma($programa)->where('genero', 0)->count();
                                            $participantes_0 = $participantes_0 + $estaca->participantesPrograma($programa)->where('estado', '0')->count();
                                            $participantes_5 = $participantes_5 + $estaca->participantesPrograma($programa)->where('estado', '5')->count();
                                            $participantes_1 = $participantes_1 + $estaca->participantesPrograma($programa)->where('estado', '1')->count();
                                            $participantes_3 = $participantes_3 + $estaca->participantesPrograma($programa)->where('estado', '3')->count();
                                        @endphp
                                        <td>
                                            {{ $estaca->nombre }}
                                        </td>
                                        <td>
                                            {{ $estaca->participantesPrograma($programa)->whereIn('estado', [0,5,1,3])->count() }}
                                            <br>
                                            {{ 'H:' .$estaca->participantesPrograma($programa)->where('genero', 1)->count() }}
                                            {{ 'M:' .$estaca->participantesPrograma($programa)->where('genero', 0)->count() }}
                                        </td>
                                        <td>
                                            {{ $estaca->participantesPrograma($programa)->where('estado', '0')->count() }}
                                        </td>
                                        <td>
                                            {{ $estaca->participantesPrograma($programa)->where('estado', '5')->count() }}
                                        </td>
                                        <td>
                                            {{ $estaca->participantesPrograma($programa)->where('estado', '1')->count() }}
                                        </td>
                                        <td>
                                            {{ $estaca->participantesPrograma($programa)->where('estado', '3')->count() }}
                                        </td>
                                    </tr>
                                @endif
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr class="font-weight-bold">
                                <td>Total: {{ $estacas_count }} </td>
                                <td>
                                    {{ $participantes }}
                                    <br>
                                    {{ 'H:' .$participantes_h }}
                                    {{ 'M:' .$participantes_m }}
                                </td>
                                <td>
                                    {{ $participantes_0 }}
                                </td>
                                <td>
                                    {{ $participantes_5 }}
                                </td>
                                <td>
                                    {{ $participantes_1 }}
                                </td>
                                <td>
                                    {{ $participantes_3 }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Alojamiento</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Participantes</th>
                                <th>Alojados</th>
                                <th>No alojados</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Hombres</td>
                                <td>
                                    {{ $alojados->where('genero', '1')->count() }}
                                </td>
                                <td>
                                    {{ $total->where('genero', 1)->count() - $alojados->where('genero', 1)->count() }}
                                </td>
                            </tr>
                            <tr>
                                <td>Mujeres</td>
                                <td>
                                    {{ $alojados->where('genero', '0')->count() }}
                                </td>
                                <td>
                                    {{ $total->where('genero', 0)->count() - $alojados->where('genero', 0)->count() }}
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Personal</th>
                                <th>Alojados</th>
                                <th>No alojados</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Hombres</td>
                                <td>
                                    {{ $totalPersonalHombresAlojados }}
                                </td>
                                <td>
                                    {{ $totalPersonalHombres - $totalPersonalHombresAlojados }}
                                </td>
                            </tr>
                            <tr>
                                <td>Mujeres</td>
                                <td>
                                    {{ $totalPersonalMujeresAlojados }}
                                </td>
                                <td>
                                    {{ $totalPersonalMujeres - $totalPersonalMujeresAlojados }}
                                </td>
                            </tr>
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
