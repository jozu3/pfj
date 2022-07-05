@extends('adminlte::page')

@section('title', 'Sesión')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <button type="button" class="btn btn-success btn-sm float-right mr-3" data-toggle="modal"
        data-target="#importExcelParticipantes">
        <i class="far fa-file-excel"></i> Importar participantes
    </button>
    <a href="{{ route('admin.contactos.create') }}" class="btn btn-success btn-sm float-right mr-3">
        <i class="fas fa-user-plus"></i> Nuevo participantes
    </a>
    <h1>
        <b class="text-pfj">{{ $programa->nombre . ' ' . date('d/m/Y', strtotime($programa->fecha_inicio)) }}</b>
    </h1>
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

            {{-- @livewire('admin.inscripcione-programa-index', ['programa_id' => $programa->id], key('asdasd')) --}}

        </div>
    </div>

    <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
        <b>Se guardó correctamente!</b>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div id="danger-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
        <b>Ocurrió un error al guardar!</b>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="importExcelParticipantes" tabindex="-1" role="dialog"
        aria-labelledby="importExcelPersonalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.excel.importExcelParticipantes', $programa) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="importExcelPersonalLabel">Importar datos de usuario</h5>
                        <a href="{{ config('app.url') . '/files/PERSONAL-PLANTILLA.xlsx' }}"
                            class="btn btn-yellow-pfj ml-5" download><i class="far fa-file-excel"></i> Descargar
                            plantilla</a>
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

    @livewire('admin.modal-detalle-contacto', key('as5648deAFAEF'))
@stop

@section('css')
    <style type="text/css">
        #success-alert {
            position: fixed;
            top: 150px;
            right: 5px;
        }

        #danger-alert {
            position: fixed;
            top: 250px;
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

        .input-nota {
            width: 80px !important;
        }

        .tab-content {
            overflow-y: auto
        }

        .btn-warning {
            color: #624a00
        }
    </style>
    {{-- <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet"> --}}
    <style>
        /*\
            |*| ========================================================================
            |*| Bootstrap Toggle: bootstrap4-toggle.css v3.6.1
            |*| https://gitbrent.github.io/bootstrap4-toggle/
            |*| ========================================================================
            |*| Copyright 2018-2019 Brent Ely
            |*| Licensed under MIT
            |*| ========================================================================
            \*/
        .btn-group-xs>.btn,
        .btn-xs {
            padding: .35rem .4rem .25rem .4rem;
            font-size: .875rem;
            line-height: .5;
            border-radius: .2rem
        }

        .checkbox label .toggle,
        .checkbox-inline .toggle {
            margin-left: -1.25rem;
            margin-right: .35rem
        }

        .toggle {
            position: relative;
            overflow: hidden
        }

        .toggle.btn.btn-light,
        .toggle.btn.btn-outline-light {
            border-color: rgba(0, 0, 0, .15)
        }

        .toggle input[type=checkbox] {
            display: none
        }

        .toggle-group {
            position: absolute;
            width: 200%;
            top: 0;
            bottom: 0;
            left: 0;
            transition: left .35s;
            -webkit-transition: left .35s;
            -moz-user-select: none;
            -webkit-user-select: none
        }

        .toggle-group label,
        .toggle-group span {
            cursor: pointer
        }

        .toggle.off .toggle-group {
            left: -100%
        }

        .toggle-on {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 50%;
            margin: 0;
            border: 0;
            border-radius: 0
        }

        .toggle-off {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 50%;
            right: 0;
            margin: 0;
            border: 0;
            border-radius: 0;
            box-shadow: none
        }

        .toggle-handle {
            position: relative;
            margin: 0 auto;
            padding-top: 0;
            padding-bottom: 0;
            height: 100%;
            width: 0;
            border-width: 0 1px;
            background-color: #fff
        }

        .toggle.btn-outline-primary .toggle-handle {
            background-color: var(--primary);
            border-color: var(--primary)
        }

        .toggle.btn-outline-secondary .toggle-handle {
            background-color: var(--secondary);
            border-color: var(--secondary)
        }

        .toggle.btn-outline-success .toggle-handle {
            background-color: var(--success);
            border-color: var(--success)
        }

        .toggle.btn-outline-danger .toggle-handle {
            background-color: var(--danger);
            border-color: var(--danger)
        }

        .toggle.btn-outline-warning .toggle-handle {
            background-color: var(--warning);
            border-color: var(--warning)
        }

        .toggle.btn-outline-info .toggle-handle {
            background-color: var(--info);
            border-color: var(--info)
        }

        .toggle.btn-outline-light .toggle-handle {
            background-color: var(--light);
            border-color: var(--light)
        }

        .toggle.btn-outline-dark .toggle-handle {
            background-color: var(--dark);
            border-color: var(--dark)
        }

        .toggle[class*=btn-outline]:hover .toggle-handle {
            background-color: var(--light);
            opacity: .5
        }

        .toggle.btn {
            min-width: 3.7rem;
            min-height: 2.15rem
        }

        .toggle-on.btn {
            padding-right: 1.5rem
        }

        .toggle-off.btn {
            padding-left: 1.5rem
        }

        .toggle.btn-lg {
            min-width: 5rem;
            min-height: 2.815rem
        }

        .toggle-on.btn-lg {
            padding-right: 2rem
        }

        .toggle-off.btn-lg {
            padding-left: 2rem
        }

        .toggle-handle.btn-lg {
            width: 2.5rem
        }

        .toggle.btn-sm {
            min-width: 3.125rem;
            min-height: 1.938rem
        }

        .toggle-on.btn-sm {
            padding-right: 1rem
        }

        .toggle-off.btn-sm {
            padding-left: 1rem
        }

        .toggle.btn-xs {
            min-width: 2.19rem;
            min-height: 1.375rem
        }

        .toggle-on.btn-xs {
            padding-right: .8rem
        }

        .toggle-off.btn-xs {
            padding-left: .8rem
        }
    </style>
@stop

@section('js')
    <script>
        $().ready(function() {
            @if (session('inactivar') == 'Ok')
                Swal.fire(
                    "Ok",
                    'Personal inactivado.',
                    'success'
                )
            @endif
            Livewire.on('readytoload', event => {
                $('.prevent-inactive').change(function(e) {
                    e.preventDefault();
                    var msg = '';
                    var confirmButtonText = '';
                    if (this.checked) {
                        msg =
                            'Al activar este personal, le dará acceso al sistema y podrá ver sus reportes de lectura, asistencia y otros.'
                        confirmButtonText = 'Sí, activar y dar acceso'
                    } else {
                        msg =
                            'Todas las asignaciones de compañerirsmo de este personal se borrarán, y ya no podrá ver sus reportes de asistencia, lecturas y otros.';
                        confirmButtonText = 'Sí, inactivar y borrar sus asignaciones'
                    }
                    Swal.fire({
                        title: 'Se necesita confirmación',
                        text: msg,
                        icon: 'warning',
                        showCancelButton: true,
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'Cancelar',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: confirmButtonText,
                    }).then((result) => {
                        if (result.value) {
                            var ins = $(this).attr('data-inscripcione');
                            Livewire.emit('changeEstado', ins);
                        } else {
                            Livewire.emit('alert', false);
                            this.checked = !this.checked
                        }
                    })
                });
            });

            $("#success-alert").hide();
            $("#danger-alert").hide();

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
            } else {
                $("#danger-alert").show();
                $("#danger-alert").fadeTo(1000, 500).slideUp(500, function() {
                    $("#danger-alert").slideUp(500);
                });
            }
        });
    </script>
    <script type="text/javascript" src="{{ config('app.url') }}/js/toggle-bootstrap.js"></script>

@stop
