<div class="form-group">
    {!! Form::label('nombre', 'Nombre del barrio') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la nueva barrio' ]) !!}

    @error('nombre')
		<small>El campo nombre es obligatorio</small>
	@enderror
</div>