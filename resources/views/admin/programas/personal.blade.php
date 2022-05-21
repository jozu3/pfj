@extends('adminlte::page')

@section('title', 'Sesión')

@section('plugins.Chartjs', true)

@section('content_header')
    <button type="button" class="btn btn-success btn-sm float-right mr-3" data-toggle="modal"
        data-target="#importExcelPersonal">
        <i class="far fa-file-excel"></i> Importar personal
    </button>

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
        
            @livewire('admin.inscripcione-programa-index', ['programa_id' => $programa->id])
            
        </div>
    </div>

    <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
        <b>Se guardó correctamente!</b>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="importExcelPersonal" tabindex="-1" role="dialog"
        aria-labelledby="importExcelPersonalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.excel.importExcelPersonal', $programa) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="importExcelPersonalLabel">Importar datos de usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="file">Seleccione archivo .xlsx</label>
                            <input type="file" class="form-control-file" name="file" id="file"
                                accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">
                            <i class="far fa-file-excel"></i> Importar
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>
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
            height: 74px;
            justify-content: center;
            display: flex;
            align-items: center;
        }

        .apellido-fijo {
            position: absolute;
            width: 11em;
            left: 0;

        }

        .nombre-fijo {
            position: absolute;
            width: 11em;
            left: 11em;
        }

        .card-body-2 {
            padding-left: 0
        }

        .cont-table-div {
            overflow-x: scroll;
            margin-left: 22em;
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
    <script type="text/javascript" src="{{ config('app.url') }}/js/app.js"></script>
@stop
