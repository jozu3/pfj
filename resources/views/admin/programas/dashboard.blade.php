@extends('adminlte::page')

@section('title', 'Sesiones')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('plugins.Chartjs', true)

@section('content')
	@if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div>
                                <h3 class="text-center">Aprobación final</h3>
                            </div>
                            <div>
                                <canvas id="report-aprobados" width="400" height="400"></canvas>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <h3 class="text-center">Recomendación para el Templo</h3>
                            </div>
                            <div>
                                <canvas id="report-rtemplo" width="400" height="400"></canvas>
                            </div>
                        </div>
                    </div>
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
    <script> console.log('Hi!');
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })

        const data = {
            labels: [
                'Aprobados',
                'Aprobación pendiente',
                'Cancelado',
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [{{ $aprobacion['aprobados'] }}, {{ $aprobacion['pendientes'] }},{{ $aprobacion['cancelados'] }}],
                backgroundColor: [
                    '#4bc0c0',
                    'rgb(255, 205, 86)',
                    'rgb(255, 99, 132)',
                ],
                hoverOffset: 4
            }]
        };

        const config = {
            type: 'doughnut',
            data: data,
        };

        const ctx = document.getElementById('report-aprobados');
        const chart_aprobados = new Chart(ctx, config)

        // Chart RTEmplo
        const data_rtemplo = {
            labels: [
                'Activa',
                'Activa con observación',
                'No activa',
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [{{ $rtemplo['activa'] }}, {{ $rtemplo['activa_obs'] }}, {{ $rtemplo['noactiva'] }}],
                backgroundColor: [
                    '#4bc0c0',
                    'rgb(255, 205, 86)',
                    'rgb(255, 99, 132)',
                ],
                hoverOffset: 4
            }]
        };

        const config_rtemplo = {
            type: 'doughnut',
            data: data_rtemplo,
        };

        const ctx2 = document.getElementById('report-rtemplo');
        const chart_rtemplo = new Chart(ctx2, config_rtemplo)

    </script>
@stop