@extends('adminlte::page')

@section('title', 'Editar programa')

@section('plugins.Sweetalert2', true)

@section('content_header')
     {{-- <a href="{{ route('admin.programas.show', $programa) }}" class="btn btn-success btn-sm float-right"><i class="fas fa-user-graduate"></i> Ver personales</a>
	 <a href="{{ route('admin.programas.asignar', $programa) }}" class="btn btn-success btn-sm float-right mr-3">
		<i class="fas fa-sitemap"></i> Asignaciones</a> --}}
    <h1>Editar programa</h1>
@stop

@section('content')
@if (session('info'))
<div class="alert alert-success">
	{{ session('info') }}
</div>
@endif

    @if (auth()->user()->can('admin.programas.edit'))
	<div class="card">
		<div class="card-body">
			{!! Form::model($programa, ['route' => ['admin.programas.update', $programa], 'method' => 'put', 'files' => true]) !!}
				{!! Form::hidden('pfj_id', null) !!}
				@include('admin.programas.partials.form')
				<br>
				<div class="form-group">
				{!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
				</div>
			{!! Form::close() !!}
		</div>
	</div>
    @endif
	@if (auth()->user()->can('admin.programas.unidades-locales'))
	<div class="card">
		<div class="card-header">
			<a href="{{ route('admin.programas.unidades-locales', $programa) }}" class="btn btn-sm btn-success float-right">Editar</a>
			Estacas
		</div>
		<div class="card-body">
			<ul>
				@foreach ($programa->estacaInscripciones as $estacaInscripcione)
					<li>{{ $estacaInscripcione->estaca->nombre }}</li>
				@endforeach
			</ul>
		</div>
	</div>
    @endif

@stop

@section('css')
    <link rel="stylesheet" href="">
    <style>
    	.list-nota{
    		width: 20%;
    		padding: 0.15rem 1.25rem;
    		border: 0;
    	}
    	.list-nota2{
    		width: 60%;
    	}
    	.list-group-horizontal {
		    border-bottom: 1px solid #bbbbbb;
		}
		.avatar-image{
            width:250px;
            height: 250px;
            object-fit: cover;
            object-position: center
        }
    </style>
@stop

@section('js')

	@if (session('info_comp'))
        <script>
			$().ready(function() {
				$('#nav-comp-tab').click();
				
				const urlParams = new URLSearchParams(window.location.search);
				const grupo_id = urlParams.get('grupo')
				$('#comps-' + grupo_id ).click();

			})

		</script>
    @endif
	@if (session('info_grupo'))
        <script>
			$().ready(function() {
				$('#nav-comp-tab').click();
			})

		</script>
    @endif
    <script>
    	$().ready(function() {
		
	    	$('.crear_notas_clases').submit( function (e) {
	    		e.preventDefault();
		    	Swal.fire({
				  title: 'Advertencia',
				  text: "Si crea las clases o genera las notas para los personales, ya no podrá agregar unidades o notas de las unidades a este grupo.",
				  icon: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Continuar',
				  cancelButtonText: "Cancelar", 
				}).then((result) => {
				  if (result.value) {
				    /**/
				    this.submit();
				  }
				})	    		
	    	});
	    

	    });

		document.getElementById('imgMatrimonioDirector').addEventListener('change', cambiarImagen);
		document.getElementById('imgMatrimonioLogistica').addEventListener('change', cambiarImagen);

		function cambiarImagen(event){
			var file = event.target.files[0];
			console.log(event)
			var input = event.target
			var reader = new FileReader();
			reader.onload = (event) => {
				document.getElementById(input.getAttribute('data-img-show')).setAttribute('src', event.target.result);
			};

			reader.readAsDataURL(file);
		}
	</script>
@stop