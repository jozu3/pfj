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

	@if (session('info_comp'))
        <div class="alert alert-success">
            {{ session('info_comp') }}
        </div>
    @endif
	<div class="card">
		<div class="row">
			<div class="col-md-12">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-personal-tab" data-toggle="tab" href="#nav-personal"
                            role="tab" aria-controls="nav-personal" aria-selected="true">Capacitaciones</a>
                        {{-- <a class="nav-item nav-link" id="nav-comp-tab" data-toggle="tab" href="#nav-comp" role="tab"
                            aria-controls="nav-comp" aria-selected="true">Familias</a> --}}
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
                            aria-controls="nav-profile" aria-selected="false">Lecturas</a>
                            <a class="nav-item nav-link" id="nav-materiales-tab" data-toggle="tab" href="#nav-materiales" role="tab"
                            aria-controls="nav-materiales" aria-selected="false">Materiales</a>
                    </div>
                </nav>
                <div class="tab-content overflow-auto" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-personal" role="tabpanel"
                        aria-labelledby="nav-personal-tab">
						@livewire('admin.capacitaciones-index', [ 'programa' => $programa])
                    </div>
                    {{-- <div class="tab-pane fade show" id="nav-comp" role="tabpanel" aria-labelledby="nav-comp-tab">
						@livewire('admin.grupos-index', [ 'programa' => $programa])
                    </div> --}}
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
						@livewire('admin.tarea-lista', ['programa' => $programa])
                    </div>
                    <div class="tab-pane fade" id="nav-materiales" role="tabpanel" aria-labelledby="nav-materiales-tab">
                        @livewire('admin.materiales-index')
                    </div>
                </div>
            </div>
		</div>
	</div>
    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Launch demo modal
      </button> --}}
    @include('admin.programas.partials.modal-detalle-contacto')
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
        @media (max-width:767px){
            .t-semana{
                display: none;
            }
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
@stop