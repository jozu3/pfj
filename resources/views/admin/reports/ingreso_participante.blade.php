@extends('layouts.print')
@section('title', $title)
@section('content')
    <center>
        <img src="{{ config('app.url') }}/img/pfj-lima-norte.png" width="300px" alt="">
    </center>
    <center>
        <h1>Bienvenido al <br>{{ $participante->programa->nombre }}</h1>
    </center>
    <br>
    <br>
    <center>
        <h3>Nombre : {{ $participante->nombres . ' ' . $participante->apellidos }}</h3>
    </center>

    <br>
    <center>
        @if (isset($participante->participanteCompania))
            <h3>Compañia : {{ $participante->participanteCompania->companerismo->numero }}</h3>
        @endif
    </center>
    <center>
        <h3>Consejeros : </h3>
        @if (isset($participante->participanteCompania))
            @foreach ($participante->participanteCompania->companerismo->inscripcioneCompanerismos as $consejero)
                @if (isset($consejero->personale->contacto))
                    <div>{{ $consejero->personale->contacto->nombres . ' ' . $consejero->personale->contacto->apellidos }}
                    </div>
                @endif
            @endforeach
        @endif
    </center>
    <br>
    <center>
        <h3>Habitación : @if (isset($participante->alojamiento))
                {{ $participante->alojamiento }}
            @endif
        </h3>
    </center>
    <center>
        <h3>Talla de polo: {{ $participante->talla }}</h3>
    </center>
@endsection
@section('styles')

    <style>
        .tpagos {
            font-size: 10px;
        }

        .date {
            position: absolute;
            right: 0;
            top: 0;
            font-size: 12px
        }

        .filtros {
            font-size: 12px
        }
    </style>
@endsection
