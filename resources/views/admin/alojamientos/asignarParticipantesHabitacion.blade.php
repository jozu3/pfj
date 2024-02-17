@extends('adminlte::page')

@section('title', 'PFJ')

@section('content_header')
    <a href="{{ route('admin.alojamientosPersonale.asignarInscripcionesHabitacione', $programa) }}"
        class="btn btn-success btn-sm float-right mr-3">
        <i class="fas fa-address-card"></i> Asignar Personal/habitaciones
    </a>
    <h1>Alojar participantes en grupo</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.alojamientos.storeParticipantesHabitacion']) !!}

            <div class="form-group">
                <div>
                    {!! Form::submit('Guardar', ['class' => 'btn btn-primary float-right']) !!}
                    <h3>
                        <label for="">{{ $locale->nombre }}</label>
                    </h3>
                </div>
                {!! Form::label('habitacione_id', 'Seleccione una o varias habitaciones') !!}
                {{-- {!! Form::select('habitacione_id', $habitaciones_select, null, [
                    'class' => 'form-control',
                    'placeholder' => 'Escoja la habitación a asignar',
                ]) !!} --}}
                @error('habitaciones')
                    <small>{{ $message }}</small>
                @enderror
            </div>
            <div class="" style="height: auto; overflow-y: auto;">
                <div class="form-group">
                    @include('admin.alojamientos.partials.edificios-show')
                </div>
            </div>


            <div class="" style="height: 60vh; overflow-y: auto;">
                @forelse ($companias as $compania)

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-12">
                                <h3>
                                    {!! Form::label('compania', 'Compañia: ' . $compania->numero) !!}

                                    {!! Form::radio('compania' . $compania->id, null, null, [
                                        'class' => 'compania_id',
                                        'data-compania_id' => $compania->id,
                                        'data-genero' => '1',
                                        'id' => 'compania_h' . $compania->id,
                                    ]) !!}

                                    {!! Form::label('compania_h' . $compania->id, 'H') !!}

                                    {!! Form::radio('compania' . $compania->id, null, null, [
                                        'class' => 'compania_id',
                                        'data-compania_id' => $compania->id,
                                        'data-genero' => '0',
                                        'id' => 'compania_m' . $compania->id,
                                    ]) !!}
                                    {!! Form::label('compania_m' . $compania->id, 'M') !!}
                                </h3>
                            </div>
                            @foreach ($compania->participantes()->sortBy(['genero', 'age']) as $participante)
                                @php
                                    switch ($participante->genero) {
                                        case '0':
                                            $s = 'M';
                                            $color_sexo = 'warning';
                                            $bg_sexo = 'bg-m';
                                            break;
                                        case '1':
                                            $s = 'H';
                                            $color_sexo = 'primary';
                                            $bg_sexo = 'bg-h';
                                            break;
                                        default:
                                            # code...
                                            break;
                                    }
                                @endphp
                                <div class="col-2 border d-flex align-items-start {{ $bg_sexo }}">
                                    {!! Form::checkbox('participantes[]', $participante->id, null, [
                                        'class' => 'mr-1 mt-2',
                                        'id' => 'part' . $participante->id,
                                        'data-compania_id' => $compania->id,
                                        'data-genero' => $participante->genero,
                                    ]) !!}
                                    <label for="{{ 'part' . $participante->id }}" class="w-100">
                                        {{ $participante->nombres . ' ' . $participante->apellidos }}
                                        <span class="text-{{ $color_sexo }}">{{ '(' . $s . ')' }}</span>
                                        <span class="text-info">{{ '(' . $participante->age . ')' }}</span>
                                        @php
                                            $estados = [
                                                '0' => 'Inscrito',
                                                '-1' => 'No Inscrito',
                                                '5' => 'En espera del PFJ',
                                                '1' => 'Ingresó al PFJ',
                                                '3' => 'Terminó el PFJ',
                                                '2' => 'Permutado',
                                                '4' => 'Retirado',
                                                '6' => 'Canceló inscripción ',
                                            ];
                                            $text_success = '';
                                            if ($participante->estado == 0 || $participante->estado == 5) {
                                                $text_success = 'text-success';
                                            }
                                        @endphp
                                        <span class="{{ $text_success }}">(
                                            {{ $estados[$participante->estado] }}
                                            )
                                        </span>
                                        @if (isset($participante->alojamiento))
                                            <div class="text-danger">
                                                {{ $participante->alojamiento->habitacione->piso->edificio->nombre }} -
                                                Piso: {{ $participante->alojamiento->habitacione->piso->num }} -
                                                {{ $participante->alojamiento->habitacione->numero }}
                                            </div>
                                        @endif
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                @empty
                @endforelse
            </div>
            @error('participantes')
                <small class="text-danger">{{ $message }}</small>
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
            background-color: pink
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {

            $('.compania_id').click(function() {
                console.log($(this).data('genero'));

                var c_id = $(this).data('compania_id');
                var genero = $(this).data('genero');
                var _genero = genero == 1 ? 0 : 1;
                $('input[type=checkbox][data-compania_id=' + c_id + '][data-genero=' + genero + ']').prop(
                    'checked', true)
                $('input[type=checkbox][data-compania_id=' + c_id + '][data-genero=' + _genero + ']').prop(
                    'checked', false)
            });
            $(document).ready(function() {
            // Handler for .ready() called.
            $('.showAlojamientos').click(function(e) {
                var habitacione_id = e.currentTarget.dataset.habitacione;
                Livewire.emit('showAlojamientos', habitacione_id);
            })
        });
        });
    </script>
@stop