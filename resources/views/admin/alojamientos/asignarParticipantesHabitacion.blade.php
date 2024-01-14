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
            {!! Form::open(['route' => 'admin.alojamientos.storeParticipantesHabitacion']) !!}

            <div class="form-group">
                {!! Form::label('habitacione_id', 'Seleccione una o varias habitaciones') !!}
                {{-- {!! Form::select('habitacione_id', $habitaciones_select, null, [
                    'class' => 'form-control',
                    'placeholder' => 'Escoja la habitación a asignar',
                ]) !!}
                @error('habitacione_id')
                    <small>{{ $message }}</small>
                @enderror --}}
            </div>
            <div class="" style="height: 80vh; overflow-y: auto;">
                <div class="form-group">
                    <div class="form-row">
                        @forelse ($locale->edificios as $edificio)
                            <div class="col-2 border d-flex align-items-start">
                                <div class="form-row">
                                    <div class="col-12 text-center">
                                        {{$edificio->nombre}}
                                    </div>
                                    @forelse ($edificio->pisos as $piso)
                                        <div class="col-12 border d-flex align-items-start">
                                            <div class="form-row">
                                                <div class="col-12">
                                                    {{ 'Piso:  '}} <b> {{$piso->num}} </b>
                                                </div>
                                                @forelse ($piso->habitaciones as $habitacione)
                                                    @php
                                                        $background = '';
                                                        $tipo = '';
                                                        if ($habitacione->alojamientos->count() == $habitacione->cupos) {
                                                            $background = 'bg-info';
                                                            $tipo = 'P';
                                                        } else if($habitacione->alojamientos->count() < $habitacione->cupos && $habitacione->alojamientos->count() > 0){
                                                            $background = 'bg-warning';
                                                            $tipo = 'P';
                                                        } else if($habitacione->alojamientos->count() == 0){
                                                            $background = 'bg-success';
                                                            $tipo = '';
                                                        } 
                                                        
                                                        if ($habitacione->alojamientosPersonales->count() == $habitacione->cupos) {
                                                            $background = 'bg-personal';
                                                            $tipo = 'C';
                                                        } else if($habitacione->alojamientosPersonales->count() < $habitacione->cupos && $habitacione->alojamientosPersonales->count() > 0){
                                                            $background = 'bg-warning-personal';
                                                            $tipo = 'C';
                                                        }
                                                    @endphp
                                                    <div class="col-6 border d-flex align-items-start {{$background}}">
                                                        {!! Form::checkbox('habitaciones[]', $habitacione->id, null, [
                                                            'class' => 'mr-1 mt-2',
                                                            'id' => 'hab' . $habitacione->id,
                                                            ]) !!}
                                                        <label for="{{ 'hab' . $habitacione->id }}" class="w-100">
                                                            {{ $habitacione->numero }} -
                                                            @switch($tipo)
                                                                @case('P')
                                                                    {{$habitacione->alojamientos->count()}}                                                 
                                                                    @break
                                                                @case('C')
                                                                    {{$habitacione->alojamientosPersonales->count()}} 
                                                                @break
                                                                @endswitch
                                                            /
                                                            {{$habitacione->cupos}}
                                                            @if ($tipo == 'C')
                                                                {{'Staff'}}
                                                            @endif
                                                        </label>
                                                    </div>
                                                @empty
                                                    
                                                @endforelse
                                            </div>
                                        </div>        
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                        @empty
                            
                        @endforelse
                    </div>
                </div>
            </div>
            </div>


            <div class="" style="height: 60vh; overflow-y: auto;">
                @forelse ($companias as $compania)

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-12">
                                <h3>
                                    {!! Form::label('compania', 'Compañia: ' . $compania->numero) !!}
                                </h3>
                            </div>
                            @foreach ($compania->participantes()->sortBy('age') as $participante)
                                @php
                                    switch ($participante->genero) {
                                        case '0':
                                            $s = 'M';
                                            $color_sexo = 'warning';
                                            break;
                                            case '1':
                                            $s = 'H';
                                            $color_sexo = 'primary';
                                            break;
                                        default:
                                            # code...
                                            break;
                                    }
                                @endphp
                                <div class="col-2 border d-flex align-items-start">
                                    {!! Form::checkbox('participantes[]', $participante->id, null, [
                                        'class' => 'mr-1 mt-2',
                                        'id' => 'part' . $participante->id,
                                    ]) !!}
                                    <label for="{{ 'part' . $participante->id }}" class="w-100">
                                        {{ $participante->nombres . ' ' . $participante->apellidos }}
                                        <span class="text-{{ $color_sexo }}">{{ '('. $s. ')' }}</span>
                                        <span class="text-info">{{ '(' . $participante->age . ')' }}</span>
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
        .bg-personal{
            background-color: #003057;
            color: white;
        }
        .bg-warning-personal{
            background-color: #5b99cc
        }
    </style>
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
