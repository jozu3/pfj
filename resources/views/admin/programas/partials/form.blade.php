<div class="row">
<div class="col-md-3">
	{!! Form::label('nombre', 'Nombre') !!}
	{!! Form::text('nombre', null, ['class' => 'form-control', /*'disabled' => ''*/]) !!}

	@error('nombre')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div> 
<div class="col-md-3">
	{!! Form::label('fecha_inicio', 'Fecha de inicio') !!}
	{!! Form::date('fecha_inicio', null, ['class' => 'form-control']) !!}
	@error('fecha_inicio')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div> 

<div class="col-md-3">
	{!! Form::label('fecha_fin', 'Fecha de fin') !!}
	{!! Form::date('fecha_fin', null, ['class' => 'form-control']) !!}
	@error('fecha_fin')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div> 

<div class="col-md-3">
	{!! Form::label('estado', 'Estado') !!}
	{!! Form::select('estado', [
			'0' => 'Por iniciar',
			'1' => 'Iniciado',
			'2' => 'Terminado',
		], null, ['class' => 'form-control', 'placeholder' => '--Seleccione--']); !!}
	@error('estado')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div> 
<div class="col-md-12 mt-3">
	{!! Form::label('img', 'Foto del Matrimonio Director') !!}

	<div class="row p-2">
		<div class="col text-center">
			@if ( isset($programa) && isset($programa->imageMatrimonioDirector))
				<img id="img-show-MD" class="img-fluid rounded-circle avatar-image" src=" {{ Storage::url($programa->imageMatrimonioDirector->url) }} "  alt="">
			@else
			
				<img id="img-show-MD" class="img-fluid rounded-circle avatar-image" src=" {{ config('app.url') }}/img/man-and-woman.svg "  alt="">
			@endif
		</div>
		<div class="col">
			<div class="custom-file">
				{!! Form::file('imgMatrimonioDirector', ['class' => 'custom-file-input', 'accept' => 'image/*', 'data-img-show' => 'img-show-MD', 'id' => 'imgMatrimonioDirector']) !!}
				<label class="custom-file-label" for="imgMatrimonioDirector">Sube una foto del Matrimonio Director</label>
			</div>
			<p>Solo se permite los formatos de imagen(jpg, png)</p>
			{{-- <p>{{ $programa->imageMatrimonioDirector->url }}</p> --}}
			@error('imgMatrimonioDirector')
				<small class="text-danger">{{ $message }}</small>
			@enderror
		</div>
	</div>
</div>
{{-- <div class="col-md-12">
	<div class="row p-2">
		<div class="col">
			{{ Storage::url($programa->imageMatrimonioLogistica) }}
			<img id="img-show-ML" class="img-fluid" src="@if ( isset($programa)) @if(isset($programa->imageMatrimonioLogistica)) {{ Storage::url($programa->imageMatrimonioLogistica->url) }} @endif @endif"  alt="">
		</div>
		<div class="col">
			<div class="custom-file">
				{!! Form::file('imgMatrimonioLogistica', ['class' => 'custom-file-input', 'accept' => 'image/*', 'data-img-show' => 'img-show-ML', 'id' => 'imgMatrimonioLogistica']) !!}
				<label class="custom-file-label" for="imgMatrimonioLogistica">Sube una foto del Matrimonio de Logística</label>
			</div>
			<p>Solo se permite los formatos de imagen(jpg, png)</p>
			{{-- <p>{{ $programa->imageMatrimonioLogistica->url }}</p> }}

			@error('imgMatrimonioLogistica')
				<small class="text-danger">{{ $message }}</small>
			@enderror
		</div>
	</div>
</div> --}}
</div> 