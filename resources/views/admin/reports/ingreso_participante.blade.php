@extends('layouts.print')
@section('title', $title)
@section('content')
    <div class="border">
        <center>
            <img src="{{ config('app.url') }}/img/logo2024.png" width="300px" alt="">
        </center>
        <center>
            <h3>Hola!</h3>
        </center>
        <center>
            <h3>Nombre : {{ $participante->nombres . ' ' . $participante->apellidos }}</h3>
        </center>
        <center>
            <h1>Bienvenido al <br>{{ $participante->programa->nombre }}</h1>
        </center>
        <br>
        <div class="border-bottom mx-5"></div>
        <center>
            @if (isset($participante->participanteCompania))
                <h4>Perteneces a la Compañia : {{ $participante->participanteCompania->companerismo->numero }}</h4>
            @endif
        </center>
        <center>
            <h4>
                Consejeros : 
            </h4>
            <h4>
                <b>

                    @if (isset($participante->participanteCompania))
                    @php
                        $insComps =$participante->participanteCompania->companerismo->inscripcioneCompanerismos
                        @endphp
                    @foreach ($insComps as $consejero)
                    @if (isset($consejero->inscripcione->personale->contacto))
                    {{ $consejero->inscripcione->personale->contacto->nombres . ' ' . $consejero->inscripcione->personale->contacto->apellidos,  }}
                    @endif
                    @if ( $loop->index != (count($insComps) -1) )
                    {{ ' y ' }}
                    <br>
                    @endif
                    @endforeach
                    @endif
                </b>
            </h4>
                </center>
        <br>
        <center>
            <h4>
                Habitación :  @if (isset($participante->alojamiento))
                {{ $participante->alojamiento->habitacione->piso->edificio->nombre }} - Piso: {{ $participante->alojamiento->habitacione->piso->num }} -
                {{ $participante->alojamiento->habitacione->numero }}
            @endif
            </h4>
        </center>
        <div class="border-bottom mx-5"></div>
        <br>
        <br>
        <center>
            <h4>Ahora debes recoger tus materiales:</h4>
        </center>

            {{-- <div>
                Manual
            </div> --}}
            <center>
                <div class="m-auto" style="max-width: 500px;">
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    Talla de polo: {{ $participante->talla }}
                                </td>
                                <td class="text-center">
                                    <input type="checkbox">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Mochila (incluye materiales PFJ)
                                </td>
                                <td class="text-center">
                                    <input type="checkbox">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Fotocheck
                                </td>
                                <td class="text-center">
                                    <input type="checkbox">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </center>
            <br>
            <center class="mb-1">
                <h4>Ahora agrúpate con tu compañia!</h4>
            </center>
    </div>

@endsection
@section('styles')
    <style>
        td{
            font-size: 20px
        }
    </style>
@endsection
