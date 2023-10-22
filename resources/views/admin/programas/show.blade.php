@extends('adminlte::page')

@section('title', 'Control de Consejeros')
@section('plugins.Select2', true)

@section('content_header')
    <h1><b class="text-pfj">{{ $programa->nombre . ' ' . date('d/m/Y', strtotime($programa->fecha_inicio)) }}</b></h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
    @if (count($errors->getMessages()) > 0)
        <div class="alert alert-danger alert-dismissible" role="alert">
            <strong>Validation Errors:</strong>
            <ul>
                @foreach ($errors->getMessages() as $errorMessages)
                    @foreach ($errorMessages as $errorMessage)
                        <li>
                            {{ $errorMessage }}
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        </li>
                    @endforeach
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                        aria-controls="nav-home" aria-selected="true">Asistencia</a>
                    <a class="nav-item nav-link" id="nav-tareas-tab" data-toggle="tab" href="#nav-tareas" role="tab"
                        aria-controls="nav-tareas" aria-selected="false">Lecturas/Tareas</a>
                    {{-- <a class="nav-item nav-link" id="nav-vacuna-tab" data-toggle="tab" href="#nav-vacuna" role="tab"
                        aria-controls="nav-vacuna" aria-selected="false">Vacunas</a> --}}
                    {{-- <a class="nav-item nav-link" id="nav-rtemplo-tab" data-toggle="tab" href="#nav-rtemplo" role="tab"
                        aria-controls="nav-rtemplo" aria-selected="false">Recomendación para el templo</a> --}}
                    <a class="nav-item nav-link" id="nav-aprobacion-tab" data-toggle="tab" href="#nav-aprobacion" role="tab"
                        aria-controls="nav-aprobacion" aria-selected="false">Aprobación final</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    @livewire('admin.asistencia-personale', ['programa' => $programa])
                </div>
                <div class="tab-pane fade" id="nav-tareas" role="tabpanel" aria-labelledby="nav-tareas-tab">
                    @livewire('admin.tareas-personale', ['programa' => $programa])
                </div>
                {{-- <div class="tab-pane fade" id="nav-vacuna" role="tabpanel" aria-labelledby="nav-vacuna-tab">
                    @livewire('admin.create-personale-vacuna', ['programa' => $programa])
                </div> --}}
                {{-- <div class="tab-pane fade" id="nav-rtemplo" role="tabpanel" aria-labelledby="nav-rtemplo-tab">
                    @livewire('admin.create-personale-rtemplo', ['programa' => $programa])
                </div> --}}
                <div class="tab-pane fade" id="nav-aprobacion" role="tabpanel" aria-labelledby="nav-aprobacion-tab">
                    @livewire('admin.aprobacion-personale', ['programa' => $programa])
                </div>
            </div>
        </div>
    </div>

    <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
        <b>Se guardó correctamente!</b>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    {{-- @livewire('admin.alert') --}}
@stop

@section('css')
    <style type="text/css">
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
            left: 11em;
            text-align: center;

        }

        .apellido-fijo-lecturas {
            position: absolute;
            width: 5em;
            left: 17em;
            text-align: center;

        }

        .nombre-fijo {
            position: absolute;
            width: 11em;
            left: 0em;
        }
        .nombre-fijo-lecturas {
            position: absolute;
            width: 17em;
            left: 0em;
        }


        .card-body-2 {
            padding-left: 0
        }

        .cont-table-div {
            overflow-x: scroll;
            margin-left: 16em;
        }

        .cont-table-div-lecturas {
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
        .porcentaje{
            width:130px; 
            margin:auto;
        }
        .porcentaje-lecturas, .porcentaje{
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
            .apellido-fijo, .apellido-fijo-lecturas {
                width: 4em;
                left: 6em;
                font-size: 14px;
            }

            .nombre-fijo, .nombre-fijo-lecturas {
                width: 7em;
                left: 0em;
                font-size: 14px;
            }
            .cont-table-div {
                overflow-x: scroll;
                margin-left: 9em;
            }
            .cont-table-div-lecturas {
                overflow-x: scroll;
                margin-left: 8em;
            }
            .fijo {
                height: 98px;
            }
            .porcentaje{
                width:auto; 
            }
            /* .pdiv-porcentaje{
                margin-right: 0rem!important;
                margin-bottom: 0.5rem!important;
            } */

        }
        .select2-container{
            width:100%!important;
        }
    </style>
    {{-- <link rel="stylesheet" href="{{ config('app.url') }}/css/app.css"> --}}

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
    <script type="text/javascript" src="{{ config('app.url') }}/js/app.js"></script>
@stop
