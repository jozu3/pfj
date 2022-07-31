<div class="form-group">
	{!! Form::label('participante_id', 'Participante') !!}
	{!! Form::select('participante_id', $participantes, null, ['class' => 'form-control', 'placeholder' => 'Escoja el participante a asignar']) !!}
	@error('participante_id')
		<small>{{$message}}</small>
	@enderror
</div> 
<div class="form-group">
	{!! Form::label('habitacione_id', 'Habitación') !!}
	{!! Form::select('habitacione_id', $habitaciones, null, ['class' => 'form-control', 'placeholder' => 'Escoja la habitación a asignar']) !!}
	@error('habitacione_id')
		<small>{{$message}}</small>
	@enderror
</div> 
