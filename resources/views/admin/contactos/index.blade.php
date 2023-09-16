@extends('adminlte::page')

@section('title', 'Contactos')
@section('plugins.Sweetalert2', true)

@section('content_header')
@can('admin.contactos.create')
<a href="{{ route('admin.contactos.create') }}" class="btn btn-success btn-sm float-right">Nuevo contacto</a>
@endcan
    <h1>Lista de contactos</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @livewire('admin.contactos-index')
    
    <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
        <b>Se guardó correctamente!</b>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div id="danger-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
        <b>Ocurrió un error al guardar!</b>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@stop

@section('css')
    <style type="text/css">
        .card-body {
            overflow: auto;
        }
        #success-alert {
            position: fixed;
            top: 150px;
            right: 5px;
        }

        #danger-alert {
            position: fixed;
            top: 250px;
            right: 5px;
        }
    </style>
@stop

@section('js')
    <script>
        $().ready(function() {
            @if (session('inactivar') == 'Ok')
                Swal.fire(
                    "Ok",
                    'Personal inactivado.',
                    'success'
                )
            @endif
            Livewire.on('readytoload', event => {
                $('.prevent-inactive').change(function(e) {
                    e.preventDefault();
                    var msg = '';
                    var confirmButtonText = '';
                    if (this.checked) {
                        msg =
                            'Al realizar la aprobación el joven empezará a recibir capacitación.'
                        confirmButtonText = 'Sí, aprobar'
                    } else {
                        msg =
                            'Seguro que deseas desaprobar?';
                        confirmButtonText = 'Sí, desaprobar'
                    }
                    Swal.fire({
                        title: 'Se necesita confirmación',
                        text: msg,
                        icon: 'warning',
                        showCancelButton: true,
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'Cancelar',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: confirmButtonText,
                    }).then((result) => {
                        if (result.value) {
                            var contacto = $(this).attr('data-contacto');
                            Livewire.emit('changeEstado', contacto);
                        } else {
                            Livewire.emit('alert', false);
                            this.checked = !this.checked
                        }
                    })
                });
            });

            $("#success-alert").hide();
            $("#danger-alert").hide();

        });
        Livewire.on('alert', function(result) {
            if (result) {
                $("#success-alert").show();
                $("#success-alert").fadeTo(1000, 500).slideUp(500, function() {
                    $("#success-alert").slideUp(500);
                });
            } else {
                $("#danger-alert").show();
                $("#danger-alert").fadeTo(1000, 500).slideUp(500, function() {
                    $("#danger-alert").slideUp(500);
                });
            }
        });
    </script>
@stop
