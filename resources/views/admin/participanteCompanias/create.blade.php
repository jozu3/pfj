@extends('adminlte::page')

@section('title', 'PFJ')
@section('plugins.Select2', true)

@section('content_header')
    <h1>Asignar participante a una compañia</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.participanteCompanias.store']) !!}

            @include('admin.participanteCompanias.partials.form')

            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="">
    <style>
        .select2.select2-container {
            width: 100%;
        }

        .select2.select2-container .select2-selection,
        .select2-selection.select2-selection--multiple {
            height: auto;
            /* padding: 0.375rem 0.75rem; */
        }

        .cursor-na {
            cursor: not-allowed !important;
        }

        .select2-container {
            width: 100% !important;
        }
    </style>
@stop

@section('js')
    <script>
        console.log('Hi!');
        $(document).ready(function() {
            $('#select-habitaciones').select2({
                placeholder: "-- Busque una habitación --",
                allowClear: true
            });
            $('#select-participantes').select2({
                placeholder: "-- Busque un participante --",
                allowClear: true
            });
			$(document).on("select2:open", () => {
				document.querySelector(".select2-container--open .select2-search__field").focus()
			})
        })
    </script>
@stop
