@extends('adminlte::page')

@section('title', 'PFJ')

@section('content_header')
    <a href="{{ route('admin.alojamientos.asignarParticipantesHabitacion', $programa) }}"
        class="btn btn-success btn-sm float-right">
        Asignar varios participantes/habitaciones</a>
    <h1>Alojar personal en grupo</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.alojamientosPersonale.storeInscripcionesHabitacione']) !!}
            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}

            {!! Form::label('habitacione_id', 'Habitaciones de ' . $locale->nombre) !!}
            {{-- <div class="form-group">
                {!! Form::select('habitacione_id', $habitaciones, null, [
                    'class' => 'form-control',
                    'placeholder' => 'Escoja la habitación a asignar',
                ]) !!}
                @error('habitacione_id')
                    <small>{{ $message }}</small>
                @enderror
            </div> --}}
            @error('habitaciones')
                <small>{{ $message }}</small>
            @enderror
            <div class="" style="overflow-y: auto;">
                <div class="form-group">
                    @include('admin.alojamientos.partials.edificios-show')
                </div>
            </div>

            <div class="" style="height: auto; overflow-y: auto;">
                {{-- @forelse ($companias as $compania) --}}

                <div class="form-group">
                    <div class="form-row">
                        <div class="col-12">
                            <h3>
                                {!! Form::label(
                                    'compania',
                                    'Personal: (' . $programa->inscripciones->where('estado', '1')->count() . ' personas)',
                                ) !!}
                            </h3>
                        </div>
                        @foreach ($programa->inscripciones->whereIn('role_id', [2, 3, 4, 5, 6, 8])->where('estado', '1') as $inscripcione)
                            @php
                                switch ($inscripcione->personale->contacto->genero) {
                                    case 'Mujer':
                                        $s = 'M';
                                        $color_sexo = 'warning';
                                        $bg_sexo = 'bg-m';
                                        break;
                                    case 'Hombre':
                                        $s = 'H';
                                        $color_sexo = 'primary';
                                        $bg_sexo = 'bg-h';
                                        break;
                                    default:
                                        # code...
                                        break;
                                }
                            @endphp
                            <div class="col-2 border d-flex align-items-start {{ $bg_sexo }} ">
                                {!! Form::checkbox('inscripciones[]', $inscripcione->id, null, [
                                    'class' => 'mr-1 mt-2',
                                    'id' => 'insc' . $inscripcione->id,
                                ]) !!}
                                <label for="{{ 'insc' . $inscripcione->id }}" class="w-100">
                                    {{ $inscripcione->personale->contacto->nombres . ' ' . $inscripcione->personale->contacto->apellidos }}
                                    <span class="text-warning">{{ ', ' . $inscripcione->role->name }}</span>
                                    @if ($inscripcione->role_id == 6 && isset($inscripcione->inscripcioneCompanerismo))
                                        <span>
                                            {{ ' - Compañia: ' . $inscripcione->inscripcioneCompanerismo->companerismo->numero }}
                                        </span>
                                    @endif
                                    <span class="text-{{ $color_sexo }}">{{ '(' . $s . ')' }}</span>
                                    @if (isset($inscripcione->alojamientoPersonale))
                                        <div class="text-danger">
                                            {{ $inscripcione->alojamientoPersonale->habitacione->piso->edificio->nombre }}
                                            -
                                            Piso: {{ $inscripcione->alojamientoPersonale->habitacione->piso->num }} -
                                            {{ $inscripcione->alojamientoPersonale->habitacione->numero }}
                                        </div>
                                    @endif
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- @empty
                @endforelse --}}
            </div>
            @error('inscripciones')
                <small>{{ $message }}</small>
            @enderror


            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="">
    <style>
        .bg-personal {
            background-color: #003057;
            color: white;
        }

        .bg-warning-personal {
            background-color: #5b99cc
        }

        .bg-h {
            background-color: #006184;
            color: white;
        }

        .bg-m {
            background-color: rgb(253, 220, 225)
        }
    </style>
@stop

@section('js')
    <script>
        console.log('Hi!');
        $(document).ready(function() {
            // Handler for .ready() called.
            $('.showAlojamientos').click(function(e) {
                var habitacione_id = e.currentTarget.dataset.habitacione;
                Livewire.emit('showAlojamientos', habitacione_id);
            })
        });
    </script>
@stop
