<div class="col-md-12">
	{!! Form::label('cuenta', 'Nombre de la cuenta') !!}
	{!! Form::text('cuenta', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la cuenta']) !!}
	@error('cuenta')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div>