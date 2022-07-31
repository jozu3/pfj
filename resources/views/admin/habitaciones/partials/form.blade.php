<div class="form-group">
    {!! Form::label('piso_id', 'Edificio y piso') !!}
    {!! Form::select('piso_id', $pisos, null, ['class' => 'form-control', 'placeholder' => 'Escoja el edificio y piso de la habitación']) !!}
    @error('piso_id')
        <small>{{$message}}</small>
    @enderror
</div> 
<div class="form-group">
	{!! Form::label('numero', 'Numero o nombre de la habitación') !!}
	{!! Form::text('numero', null, ['class' => 'form-control', 'placeholder' => 'Escriba el número o nombre de la habitación']) !!}
	@error('numero')
		<small>{{$message}}</small>
	@enderror
</div> 
<div class="form-group">
	{!! Form::label('cupos', '¿Cuantas personas entran en la habitación?') !!}
	{!! Form::number('cupos', null, ['class' => 'form-control', 'min' => '0', 'placeholder' => 'Escriba una cantidad de personas']) !!}
	@error('cupos')
		<small>{{$message}}</small>
	@enderror
</div> 
