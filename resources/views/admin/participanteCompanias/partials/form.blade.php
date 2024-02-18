<div class="form-group">
	{!! Form::label('participante_id', 'Participante') !!}
	{!! Form::select('participante_id', $participantes, null, ['class' => 'form-control', 'placeholder' => 'Escoja el participante a asignar', 'id' => 'select-participantes']) !!}
	@error('participante_id')
		<small>{{$message}}</small>
	@enderror
</div> 
<div class="form-group">
	{!! Form::label('companerismo_id', 'Compañia') !!}
	{!! Form::select('companerismo_id', $companerismos, null, ['class' => 'form-control', 'placeholder' => 'Escoja la compañia a asignar', 'id' => 'select-habitaciones']) !!}
	@error('companerismo_id')
		<small>{{$message}}</small>
	@enderror
</div> 
