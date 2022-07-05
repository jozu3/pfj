@extends('adminlte::page')

@section('title', 'Estacas')

@section('content_header')
    <h1>Lista de barrios</h1>
    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal"
        data-route="{{ route('admin.estacas.create') }}">
        Nueva estaca
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
                        <th>Nombre de la estaca</th>
                        <th>Consejo de coordinación</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($estacas as $estaca)
                        <tr>
                            <td class="text-center">{{ $estaca->id }}</td>
                            <td>{{ $estaca->nombre }}</td>
                            <td>{{ $estaca->consejoCoordinacione->nombre }}</td>
                            <td width="10px">
                                <button class="btn btn-link" data-toggle="modal" data-target="#exampleModal"
                                    data-route="{{ route('admin.estacas.edit', $estaca) }}">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </td>
                            <td width="10px">
                                <a href="{{ route('admin.barrios.show', $estaca) }}">Barrios</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="estaca_content">

            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
    <script>
        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var route = button.data('route') // Extract info from data-* attributes
            // // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            // modal.find('.modal-title').text('New message to ' + recipient)
            // modal.find('.modal-body input').val(recipient)            

            $.get(route, function(data) {
                $("#estaca_content").html(data);
            });

        })
    </script>
@stop
