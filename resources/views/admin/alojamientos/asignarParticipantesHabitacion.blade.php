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
                @forelse ($companias as $compania)

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-12">
                                <h3>
                                    {!! Form::label('compania', 'Compañia: ' . $compania->numero) !!}
                                </h3>
                            </div>
                            @foreach ($compania->participantes()->sortBy('age') as $participante)
                                <div class="col-2">
                                    {!! Form::checkbox('participantes[]', $participante->id, null, [
                                        'class' => 'mr-1',
                                        'id' => 'part' . $participante->id,
                                    ]) !!}
                                    <label for="{{ 'part' . $participante->id }}" class="w-100">
                                        {{ $participante->nombres . ' ' . $participante->apellidos }}
                                        <span class="text-info">{{ ' (' . $participante->age . ')' }}</span>
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
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
