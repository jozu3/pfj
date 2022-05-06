<div class="col-md-12">
	{!! Form::label('descripcion', 'Descripcion') !!}
	{!! Form::text('descripcion', null, ['class' => 'form-control', 'placeholder' => 'Ingrese unidad']) !!}
	@error('descripcion')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div>
<div class="col-md-12">
	{!! Form::label('fechainicio', 'Fecha de inicio') !!}
	{!! Form::date('fechainicio', null, ['class' => 'form-control', 'placeholder' => 'Ingrese fecha de inicio de la unidad']) !!}
	@error('fechainicio')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div>
<div class="col-md-12">
	{!! Form::label('cantidad_clases', 'Cantidad de clases') !!}
	{!! Form::number('cantidad_clases', null, ['class' => 'form-control', 'placeholder' => 'Ingrese unidad']) !!}
	@error('cantidad_clases')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div>
<div class="col-md-12">
	{!! Form::label('profesore_id', 'Profesor') !!}
	{!! Form::select('profesore_id', $profesores, null, ['class' => 'form-control', 'placeholder' => 'Seleccione profesor']); !!}
	@error('profesore_id')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div>