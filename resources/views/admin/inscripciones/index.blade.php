@extends('adminlte::page')

@section('title', 'Inscripciones')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1>Matrículas</h1>
@stop

@section('content')
	@if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
    @livewire('admin.inscripciones-index')
@stop

@section('css')
    <style type="text/css">
        .card-body {
            overflow: auto;
        }
    </style>
@stop

@section('js')
    <script>
    	$().ready(function() {
			@if (session('eliminar') == 'Ok')
				Swal.fire(
					      "Ok",
					      'Matrícula eliminada.',
					      'success'
					    )
			@endif
	    	Livewire.on('readytoload', event => {
		    	$('.eliminar-inscripcione').submit( function (e) {
		    		e.preventDefault();
			    	Swal.fire({
					  title: 'Se necesita confirmación',
					  text: "No se podrá recuperar los datos de la inscrición.",
					  icon: 'warning',
					  showCancelButton: true,
					  confirmButtonColor: '#3085d6',
					  cancelButtonColor: '#d33',
					  confirmButtonText: 'Sí, borrar difinitivamente!'
					}).then((result) => {
					  if (result.value) {
					    /**/
					    this.submit();
					  }
					})	    		
		    	});
	    	});

	    });
    </script>
@stop