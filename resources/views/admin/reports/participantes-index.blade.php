@extends('layouts.print')
@section('title', $title)
@section('content')
   <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Estaca</th>
                <th>Barrio</th>
                <th>Edad</th>
                <th>Compañia</th>
                <th>Habitación</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($participantes as $participante)
                <tr>
                    <td>{{$participante->nombres}}</td>
                    <td>{{$participante->apellidos}}</td>
                    <td>{{$participante->barrio->estaca->nombre }}</td>
                    <td>{{$participante->barrio->nombre }}</td>
                    <td>{{$participante->age}}</td>
                </tr>
            @endforeach
        </tbody>
   </table>
@endsection
@section('styles')
    <style>
        td{
            font-size: 20px
        }
    </style>
@endsection
