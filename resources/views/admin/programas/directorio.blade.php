@extends('adminlte::page')

@section('title', 'Sesiones')

@section('content_header')
    <h2><b class="text-pfj">{{ $programa->nombre }}</b></h2>
    <h3>Organización del directorio</h3>
@stop

@section('content')
    <section class="content pb-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 offset-md-4">
                    <div class="card card-row card-primary">
                        <div class="card-header bg-success text-center">
                            <h3 class="card-title">Director de sesión</h3>
                        </div>
                        <div class="card-body row">
                            {{-- <div class="card card-primary card-outline">
                                <div class="card-header row"> --}}
                            @foreach ($programa->matrimonioDirectores() as $inscripcione)
                                <div class="col-6">
                                    <div class="card text-center w-100">
                                        <div class="card-header">
                                            <img class="img-fluid rounded-circle img-personal"
                                                src="{{ $inscripcione->personale->user->adminlte_image() }}" alt="">
                                        </div>
                                        <div class="card-body p-0">
                                            {{ $inscripcione->personale->user->name }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {{-- </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 offset-md-4">
                    <div class="card card-row card-primary">
                        <div class="card-header bg-warning text-center">
                            <h3 class="card-title">Director de Logística</h3>
                        </div>
                        <div class="card-body row">
                            {{-- <div class="card card-primary card-outline">
                                <div class="card-header row"> --}}
                            @foreach ($programa->matrimonioLogisticas() as $inscripcione)
                                <div class="col-6">
                                    <div class="card text-center w-100">
                                        <div class="card-header">
                                            <img class="img-fluid rounded-circle img-personal"
                                                src="{{ $inscripcione->personale->user->adminlte_image() }}" alt="">
                                        </div>
                                        <div class="card-body p-0">
                                            {{ $inscripcione->personale->user->name }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {{-- </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            @foreach ($programa->funciones as $funcione)
                @switch($loop->index)
                    @case(0)
                        @php
                            $color = 'bg-primary';
                        @endphp
                        @break
                    @case(1)
                        @php
                            $color = 'bg-danger';
                        @endphp
                        @break
                    @case(2)
                        @php
                            $color = 'bg-warning';
                        @endphp    
                        @break
                    @case(3)
                        @php
                            $color = 'bg-success';
                        @endphp    
                        @break
                    @default
                        @php
                            $color = 'bg-primary';
                        @endphp
                        @break
                @endswitch
                <div class="row justify-content-center">
                    @foreach ($funcione->inscripciones as $inscripcione)
                        <div class="col-md-2">
                            <div class="card card-row card-primary h-100">
                                <div class="card-header {{$color}} text-center" style="background-color: ;">
                                    <h3 class="card-title">{{ $funcione->descripcion }}</h3>
                                </div>
                                <div class="card-body row">
                                    <div class="card text-center w-100">
                                        <div class="card-header">
                                            <img class="img-fluid rounded-circle img-personal"
                                                src="{{ $inscripcione->personale->user->adminlte_image() }}" alt="">
                                        </div>
                                        <div class="card-body p-0">
                                            {{ $inscripcione->personale->user->name }}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </section>
@stop


@section('css')
<style>
     .img-personal {
            width: 120px;
            height: 120px;
            object-fit: cover;
        }
</style>
@stop
@section('js')
@stop
