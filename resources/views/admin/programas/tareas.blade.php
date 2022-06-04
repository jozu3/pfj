@extends('adminlte::page')

@section('title', 'Sesión')

@section('content_header')
    <h1><b class="text-pfj">{{ $programa->nombre . ' ' . date('d/m/Y', strtotime($programa->fecha_inicio)) }}</b></h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            {{-- @include('admin.programas.partials.lectura') --}}
            @livewire('admin.tareas-personale', ['programa' => $programa])
        </div>
    </div>
    <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
        <b>Se guardó correctamente!</b>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@stop

@section('css')
    <style type="text/css">
        #success-alert {
            position: fixed;
            top: 150px;
            right: 5px;
        }
        .cont-pestaña {
            box-shadow: none;
            border: 1px solid transparent;
            border-color: #FFF #dee2e6 #dee2e6;
            border-radius: 0px 0px 0.25rem 0.25rem;
        }

        .una-fila {
            flex-wrap: nowrap;
        }
        .fijo {
            height: 97px;
            justify-content: center;
            display: flex;
            align-items: center;
        }

        .apellido-fijo {
            position: absolute;
            width: 5em;
            left: 17em;
            text-align: center;

        }

        .nombre-fijo {
            position: absolute;
            width: 17em;
            left: 0em;
        }

        .card-body-2 {
            padding-left: 0
        }

        .cont-table-div {
            overflow-x: scroll;
            margin-left: 21em;
        }

        .alturatd-dis {
            height: 4em;
            color: #00000050;
        }

        #success-alert {
            position: fixed;
            top: 150px;
            right: 5px;
        }

        .input-nota {
            width: 80px !important;
        }

        .tab-content {
            overflow-y: auto
        }
        .btn-warning{
            color: #624a00
        }
        .porcentaje{
            width:130px; 
            height: 51px;
            margin:auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .pdiv-porcentaje{
            margin-right: 0.5rem!important;
        }

        
        @media (max-width: 767px) {
            .apellido-fijo {
                width: 4em;
                left: 6em;
                font-size: 14px;
            }

            .nombre-fijo {
                width: 7em;
                left: 0em;
                font-size: 14px;
            }
            .cont-table-div {
                overflow-x: scroll;
                margin-left: 8em;
            }
            .fijo {
                height: 98px;
            }
            .porcentaje{
                width:auto; 
                height: 100px;
            }
            /* .pdiv-porcentaje{
                margin-right: 0rem!important;
                margin-bottom: 0.5rem!important;
            } */

        }

    </style>
@stop

@section('js')
    <script>

        $().ready(function() {
            $("#success-alert").hide();
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })

        Livewire.on('alert', function(result) {
            if (result) {
                $("#success-alert").show();
                $("#success-alert").fadeTo(1000, 500).slideUp(500, function() {
                    $("#success-alert").slideUp(500);
                });
            }
        });

       
    </script>
@stop
