@extends('adminlte::page')

@section('title', 'Barrios')

@section('content_header')
    <h1>Lista de barrios</h1>
    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#saveBarrio"
        data-route="{{ route('admin.barrios.create') }}">
        Nuevo barrio
    </button>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre del barrio</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barrios as $barrio)
                        <tr>
                            <td class="text-center">{{ $barrio->id }}</td>
                            <td>{{ $barrio->nombre }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="saveBarrio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="barrio_content">

            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
<script>
    $('#saveBarrio').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var route = button.data('route')
        var modal = $(this)           

        $.get(route, function(data) {
            $("#barrio_content").html(data);
        });

    })
</script>
@stop
