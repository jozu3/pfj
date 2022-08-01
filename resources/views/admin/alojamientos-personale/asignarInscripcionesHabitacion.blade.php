@extends('adminlte::page')

@section('title', 'PFJ')

@section('content_header')
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
            {!! Form::open(['route' => 'admin.alojamientosPersonale.storeInscripcionesHabitacione']) !!}

            <div class="form-group">
                {!! Form::label('habitacione_id', 'Habitación') !!}
                {!! Form::select('habitacione_id', $habitaciones, null, [
                    'class' => 'form-control',
                    'placeholder' => 'Escoja la habitación a asignar',
                ]) !!}
                @error('habitacione_id')
                    <small>{{ $message }}</small>
                @enderror
            </div>


            <div class="" style="height: 60vh; overflow-y: auto;">
                {{-- @forelse ($companias as $compania) --}}

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-12">
                                <h3>
                                    {!! Form::label('compania', 'Personal: ('.$programa->inscripciones->where('estado', '1')->count().' personas)') !!}
                                </h3>
                            </div>
                            @foreach ($programa->inscripciones->where('estado', '1') as $inscripcione)
                                @php
                                    switch ($inscripcione->personale->contacto->genero) {
                                        case 'Mujer':
                                            $s = 'M';
                                            $color_sexo = 'warning';
                                            break;
                                        case 'Hombre':
                                            $s = 'H';
                                            $color_sexo = 'primary';
                                            break;
                                        default:
                                            # code...
                                            break;
                                    }
                                @endphp
                                <div class="col-2 border d-flex align-items-start">
                                    {!! Form::checkbox('inscripciones[]', $inscripcione->id, null, [
                                        'class' => 'mr-1 mt-2',
                                        'id' => 'insc' . $inscripcione->id,
                                    ]) !!}
                                    <label for="{{ 'insc' . $inscripcione->id }}" class="w-100">
                                        {{ $inscripcione->personale->contacto->nombres . ' ' . $inscripcione->personale->contacto->apellidos }}
                                        <span class="text-secondary">{{', '. $inscripcione->role->name }}</span>
                                        <span class="text-{{ $color_sexo }}">{{ '('. $s. ')' }}</span>
                                        @if (isset($inscripcione->alojamientoPersonale))
                                            <div class="text-danger">
                                                {{ $inscripcione->alojamientoPersonale->habitacione->piso->edificio->nombre }} -
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
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
