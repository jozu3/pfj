<div class="col-md-12">
	{!! Form::label('descripcion', 'Descripcion') !!}
	{!! Form::text('descripcion', null, ['class' => 'form-control', 'placeholder' => 'Ingrese nota']) !!}
	@error('descripcion')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div>
<div class="col-md-12">
	{!! Form::label('tipo', 'Tipo de nota') !!}
	{!! Form::select('tipo', ['0' => 'Nota Regular', '1' => 'Nota Recuperatoria'], null, ['class' => 'form-control', 'placeholder' => '-- Escoge --']) !!}
	@error('tipo')
		<small class="text-danger">{{ $message }}</small>
	@enderror
	@error('tiene_nota_recuperatoria')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div>
<div class="col-md-12">
	{!! Form::label('valor', 'Valor') !!}
	{!! Form::text('valor', null, ['class' => 'form-control', 'placeholder' => 'Ingrese valor de la nota']) !!}
	@error('valor')
		<small class="text-danger">{{ $message }}</small>
	@enderror
	@error('notas_completas')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div>
<input type="hidden" name="id" value="{{ $nota->id }}">