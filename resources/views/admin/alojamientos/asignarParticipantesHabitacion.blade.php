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
                ]) !!}--}}
                @error('habitaciones')
                    <small>{{ $message }}</small>
                @enderror 
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
                                    
                                    {!! Form::radio('compania'.$compania->id, null, null, [
                                        'class' => 'compania_id', 
                                        'data-compania_id' => $compania->id,
                                        'data-genero' => '1',
                                        'id' => 'compania_h'.$compania->id
                                        ]) !!}

                                    {!! Form::label('compania_h'.$compania->id, 'H') !!}

                                    {!! Form::radio('compania'.$compania->id, null, null, [
                                        'class' => 'compania_id', 
                                        'data-compania_id' => $compania->id,
                                        'data-genero' => '0',
                                        'id' => 'compania_m'.$compania->id
                                        ]) !!}
                                    {!! Form::label('compania_m'.$compania->id, 'M') !!}
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
                                <div class="col-2 border d-flex align-items-start {{$bg_sexo}}">
                                    {!! Form::checkbox('participantes[]', $participante->id, null, [
                                        'class' => 'mr-1 mt-2',
                                        'id' => 'part' . $participante->id,
                                        'data-compania_id' => $compania->id,
                                        'data-genero' => $participante->genero,
                                    ]) !!}
                                    <label for="{{ 'part' . $participante->id }}" class="w-100">
                                        {{ $participante->nombres . ' ' . $participante->apellidos }}
                                        <span class="text-{{ $color_sexo }}">{{ '('. $s. ')' }}</span>
                                        <span class="text-info">{{ '(' . $participante->age . ')' }}</span>
                                        @php
                                                $estados = [
                                                '0' => 'Inscrito',
                                                '-1' => 'No Inscrito',
                                                "5" => "En espera del PFJ",
                                                "1" => "Ingresó al PFJ",
                                                "3" => "Terminó el PFJ",
                                                '2' => 'Permutado',
                                                "4" => "Retirado",
                                                "6" => "Canceló inscripción ",
                                            ];
                                            $text_success = '';
                                            if ($participante->estado == 0 || $participante->estado == 5) {
                                                $text_success = 'text-success';
                                            }
                                        @endphp
                                        <span class="{{$text_success}}" >(
                                            {{ $estados[$participante->estado]}}
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
        .bg-h{
            background-color: #006184;
            color: white;
        }
        .bg-m{
            background-color: pink
        }
    </style>
@stop

@section('js')
    <script>
        $().ready(function() {
            
            $('.compania_id').click(function(){
                console.log($(this).data('genero'));

                var c_id = $(this).data('compania_id');
                var genero = $(this).data('genero');
                var _genero = genero == 1 ? 0:1;
                $('input[type=checkbox][data-compania_id='+c_id+'][data-genero='+genero+']').prop('checked', true)
                $('input[type=checkbox][data-compania_id='+c_id+'][data-genero='+_genero+']').prop('checked', false)
            });
        });
    </script>
@stop
