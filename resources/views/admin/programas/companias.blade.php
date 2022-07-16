@extends('adminlte::page')

@section('title', 'Compañias ')

@section('content_header')

    <button type="button" class="btn btn-success btn-sm float-right mr-3" data-toggle="modal" data-target="#sortCompanias" data-backdrop="static" data-keyboard="false">
        <i class="far fa-plus"></i> Armar Compañias
    </button>
    <h1>Compañias por Sesión</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif

    @livewire('admin.companias-programa', ['programa' => $programa], key($programa->id))


@stop

@section('css')

    <style type="text/css">
        .card-body {
            overflow: auto;
        }

        .bg-yellow-pfj {
            background-color: #ffb900 !important;

        }

        .pgrupos .nav-tabs {
            border: 0;
            overflow-y: hidden;
            overflow-x: auto;
        }

        .pgrupos .navbar {
            padding: 0
        }

        .pgrupos a.nav-item {
            color: white
        }

        .pgrupos a.nav-item:hover {
            background-color: #fe9a18 !important;
            border: 0;
            margin: 0;
            border-radius: 0;
        }

        .pgrupos a.nav-item.active {
            background-color: #fe9a18 !important;
            color: white !important;
            font-weight: bold;
            border: 0;
            border-radius: 0;
            margin: 0
        }

        .pgrupos .nav-link {
            display: block;
            padding: 1rem 1.5rem;
            font-size:
        }

        .nombre-sesion {
            max-width: 350px;
            min-width: 320px;
            width: 100%;
            border: 0 !important;
            margin: 0;
            padding: 0.5rem 1.5rem;
            color: white;
            font-weight: bold;
            border-radius: 0;
            font-size: 27px;
            background-color: #fe9a18 !important;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nombre-sesion:hover {
            color: white;
            background-color: #fe9a18 !important;
        }

        .pgrupos .tab-pane {
            overflow: auto;
        }

        .pgrupos .nav {
            flex-wrap: unset;
            text-align: center;
        }
        .showLoading{

        }
    </style>
@stop

@section('js')
    <script>
        console.log('Hi!');
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })

        // $('#modalloading').modal({
        //     backdrop: 'static',
        //     keyboard: false
        // })

      

        Livewire.on('offmodalloading', () => {
            console.log('offsortCompanias');
            $('#sortCompanias').modal('hide')
            Livewire.emit('render');

        });

        Livewire.on('onmodalloading', () => {
            console.log('onmodalloading'); 
            $('#modalloading').modal('show')
        });

    </script>
@stop
