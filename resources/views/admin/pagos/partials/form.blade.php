<div class="col-md-12">
	{!! Form::label('obligacione_id', 'Código de Obligación por pagar') !!}
	@if (isset($idobligacione))
	{!! Form::text('obligacione_id', $idobligacione, ['class' => 'form-control', 'placeholder' => 'Ingrese el codigo de la obligación por pagar']) !!}
	@else
	{!! Form::text('obligacione_id', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el codigo de la obligación por pagar']) !!}
	@endif
	@error('obligacione_id')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div>
<div class="col-md-12">
	{!! Form::label('cuenta_id', 'Cuenta de ingreso') !!}
	{!! Form::select('cuenta_id', $cuentas, null, ['class' => 'form-control', 'placeholder' => '--Seleccione cuenta--']) !!}
	@error('cuenta_id')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div>
<div class="col-md-12">
	{!! Form::label('fechapago', 'Fecha de pago') !!}
	{!! Form::date('fechapago', null, ['class' => 'form-control']) !!}
	@error('fechapago')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div>
<div class="col-md-12">
	{!! Form::label('monto', 'Monto pagado') !!}
	{!! Form::number('monto', null, ['class' => 'form-control']) !!}
	@error('monto')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div>
