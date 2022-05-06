@extends('adminlte::page')

@section('title', 'Editar inscripcione')

@section('content_header')
    <a href="{{ route('admin.inscripciones.show', $inscripcione) }}" class="float-right">Ver recibo <i class="fas fa-chevron-right"></i></a>
    <h1>Editar matrícula</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <b>Detalle de la matrícula</b>
            </div>
    	<div class="card-body">
    		{!! Form::model($inscripcione, ['route' => ['admin.inscripciones.update', $inscripcione], 'method' => 'put']) !!}
                {{--@livewire('admin.grupo-info', ['pfj_id' => $inscripcione->grupo->pfj->id, 'grupo_id' => $inscripcione->grupo->id])--}}
                <div class="form-group">
                    {!! Form::label('estado', 'Estado') !!}
                    {!! Form::select('estado', [
                        '0' => 'Habilitado', 
                        '1' => 'Retirado', 
                        '2' => 'Suspendido',
                    ], null, ['class' => 'form-control']) !!}
                </div>
                @include('admin.inscripciones.partials.formedit')
                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    		{!! Form::close() !!}
        </div>  
    </div>
    {{-- <div class="card">  
        <div class="card-header">
                <b>Obligaciones por pagar</b>
        </div>
        <div class="card-body">
            @if (session('obl-actualizada'))
                <div class="alert alert-success">
                    {{ session('obl-actualizada') }}
                </div>
            @endif
            
            <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Concepto</th>
                            <th>Fecha de vencimiento</th>
                            <th>Estado</th>
                            <th>Monto</th>
                            <th>Descuento</th>
                            <th>Monto final</th>
                            <th>Monto pagado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inscripcione->obligaciones as $obligacione)
                            <tr>
                                <td>{{ $obligacione->id }}</td>
                                {!! Form::model( $obligacione, ['route' => ['admin.obligaciones.update', $obligacione], 'method' => 'put']) !!}
                                <td>{{$obligacione->concepto}}</td>
                                <td>
                                    {!! Form::date('fechalimite', null,['class' => 'form-control']) !!}
                                </td>
                                <td>
                                    @switch ($obligacione->estado)
                                        @case(0)
                                            Exonerado
                                            @break
                                        @case(1)
                                            Por pagar
                                            @break
                                        @case(2)
                                            Parcial
                                            @break
                                        @case(3)
                                            Pagado
                                            @break
                                    @endswitch
                                    @if ($obligacione->fechapagadototal > $obligacione->fechalimite)
                                        <small class="text-danger">({{ date('d/m/Y', strtotime($obligacione->fechapagadototal)) }})</small>
                                    @endif
                                </td>
                                <td>{{$obligacione->monto}}</td>
                                <td>
                                    {!! Form::number('descuento',null,['class' => 'form-control', 'style' => 'max-width:100px', 'min' => '0', 'step' => '0.01']) !!}
                                </td>
                                <td>{{$obligacione->montofinal}}</td>
                                <td>{{$obligacione->montopagado}}</td>
                                <td>
                                    {!! Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) !!}
                                </td>
                                {!! Form::close() !!}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div> --}}
@stop

@section('css')
    <style>
        .form-check{
            display: inline-block;
        }
    </style>
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop