@extends('adminlte::page')

@section('title', 'PFJ')
@section('plugins.Sweetalert2', true)

@section('content_header')
    @can('admin.inscripciones.create')
        <a href="{{ route('admin.inscripciones.create', 'idcontacto=' . $contacto->id) }}"
            class="btn btn-success btn-sm float-right">Inscribir</a>
    @endcan
    <h1>Contacto JAS: {{ $contacto->nombres . ' ' . $contacto->apellidos }}</h1>
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
            <div class="card">
                <div class="card-body">
                    {!! Form::model($contacto, [
                        'route' => ['admin.contactos.update', $contacto],
                        'method' => 'put',
                        'files' => true,
                    ]) !!}

                    @include('admin.contactos.partials.form')
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::label('estado', 'Estado') !!}
                            {!! Form::select(
                                'estado',
                                [
                                    '1' => 'Preinscrito',
                                    '2' => 'Enviado al obispo',
                                    '3' => 'Aprobado por el obispo',
                                    '4' => 'Confirmado',
                                    '5' => 'Inscrito',
                                ],
                                null,
                                ['class' => 'form-control', 'placeholder' => 'Escoge', 'disabled' => 'disabled', 'style' => 'appearance: none; '],
                            ) !!}
                        </div>

                        <div class="col-md-2 mt-4">
                            <div class="form-group">
                                {!! Form::submit('Actualizar datos', ['class' => 'btn btn-red40-pfj']) !!}
                            </div>
                        </div>
                        @can('admin.contactos.aprobacionpfj')
                            <div class="col-md-2 mt-4">
                                <div class="form-group">
                                    @livewire('admin.contacto-aprobacion-pfj', ['contacto_id' => $contacto->id], key(auth()->user()->id))
                                </div>
                            </div>
                        @endcan
                        {{-- @if ($contacto->estado == 1)
                        @endif --}}
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>

        </div>
        @if ($contacto->personale != null)
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="">Información de personal</h3>
                    </div>
                    @php
                        $personale = $contacto->personale;
                    @endphp
                    <div class="card-body">
                        {!! Form::model($personale, ['route' => ['admin.personales.update', $personale], 'method' => 'put']) !!}
                        {!! Form::hidden('show_contacto', '1') !!}

                        @include('admin.personales.partials.form')

                        {!! Form::submit('Guardar', ['class' => 'btn btn-red40-pfj']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            @forelse ($contacto->personale->inscripciones as $inscripcione)
                @if ($inscripcione->programa->estado < 2)
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('admin.inscripciones.notificacion', $inscripcione) }}"
                                    class="btn btn-success btn-sm float-right mr-2"><i class="fas fa-envelope"></i> Enviar
                                    Notificación</a>
                                <h3>Información de la inscripción a:
                                    {{ ' ' . $inscripcione->programa->pfj->nombre . ' - ' . $inscripcione->programa->nombre }}
                                </h3>
                            </div>
                            <div class="card-body">
                                {!! Form::model($inscripcione, ['route' => ['admin.inscripciones.update', $inscripcione], 'method' => 'put']) !!}
                                {{-- @livewire('admin.grupo-info', ['pfj_id' => $inscripcione->grupo->pfj->id, 'grupo_id' => $inscripcione->grupo->id]) --}}
                                <div class="form-group">
                                    {!! Form::label('estado', 'Estado') !!}
                                    {!! Form::select(
                                        'estado',
                                        [
                                            '0' => 'Desahabilitado',
                                            '1' => 'Habilitado',
                                            //'2' => 'Suspendido',
                                        ],
                                        null,
                                        ['class' => 'form-control'],
                                    ) !!}
                                </div>
                                @include('admin.inscripciones.partials.formedit')
                                {!! Form::submit('Guardar', ['class' => 'btn btn-red40-pfj']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                @endif
            @empty
            @endforelse
        @endif
        @can('admin.seguimientos.create')
            <div class="col-md-12">
                @livewire('admin.contacto-seguimientos', ['contacto' => $contacto])
            </div>
        @endcan
    </div>
@stop

@section('css')
    <style type="text/css">
        .card-body {
            overflow: auto;
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Handler for .ready() called.
            document.getElementById('imgperfil').addEventListener('change', cambiarImagen);

            function cambiarImagen(event) {
                var file = event.target.files[0];

                var reader = new FileReader();
                reader.onload = (event) => {
                    document.getElementById("img-show").setAttribute('src', event.target.result);
                };

                reader.readAsDataURL(file);
            }

            document.getElementById('imgrec').addEventListener('change', cambiarImagenRecTemplo);

            function cambiarImagenRecTemplo(event) {
                var file = event.target.files[0];

                var reader = new FileReader();
                reader.onload = (event) => {
                    document.getElementById("rec-img-show").setAttribute('src', event.target.result);
                };

                reader.readAsDataURL(file);
            }
        });
    </script>
@stop
