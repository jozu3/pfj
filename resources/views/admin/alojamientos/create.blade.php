@extends('adminlte::page')

@section('title', 'PFJ')

@section('content_header')
<a href="{{ route('admin.alojamientos.asignarParticipantesHabitacion', session('programa_activo') ) }}" class="btn btn-success btn-sm float-right">Asignar varios participantes</a>

    <h1>Alojar participante</h1>
@stop


@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.alojamientos.store']) !!}

            @include('admin.alojamientos.partials.form')

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
