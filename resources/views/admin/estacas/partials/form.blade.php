<div class="form-group">
    {!! Form::label('nombre', 'Nombre de la estaca') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la nueva estaca' ]) !!}

    @error('nombre')
		<small>El campo nombre es obligatorio</small>
	@enderror
</div>
<div class="form-group">
    {!! Form::label('consejo_coordinacione_id', 'Consejo de coordinaciones') !!}
    {!! Form::select('consejo_coordinacione_id', $consejo_coordinaciones, null, ['class' => 'form-control', 'placeholder' => 'Elija un consejo']) !!}
    @error('consejo_coordinacione_id')
        <small>El campo consejo de coordinaciones es obligatorio</small>
    @enderror
</div>