@extends('adminlte::page')

@section('title', 'Reportes')

@section('content_header')
    <h1>Reportes</h1>
@stop

@section('plugins.Chartjs', true)

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
    <section>
        <div class="card">
            <div class="card-header"></div>
            <div class="card-body">
                <div class="div-chestacas">

                    <canvas id="myChart" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
    </section>
    <section>
        @livewire('admin.consejeros-estaca-sesion')
    </section>
@stop
    
@section('css')
    <style type="text/css">
        .div-chestacas{
            width: 600px; 
        }
    </style>
@stop

@section('js')
<script>
    //chart de barras
    
    const labels = [
            @foreach ($estacas as $estaca)
                '{{ $estaca->nombre }}',
            @endforeach
        ]
        const data = {
            labels: labels,
            datasets: [{
                axis: 'y',
                label: 'Consejeros por estacas',
                data: [65, 59, 80, 81, 56, 55, 40, 40, 40],
                fill: false,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                ],
                borderWidth: 1,
            }]
        };
        const config = {
            type: 'bar',
            data,
            options: {
                indexAxis: 'y',
            }
        };

        const ctx = document.getElementById('myChart');
        const myChart = new Chart(ctx, config)

    </script>
@stop
