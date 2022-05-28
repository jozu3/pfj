<div class="form-group">
    {!! Form::label('barrio_id', 'Barrio/Rama') !!}
    {!! Form::select('barrio_id', $barrios, null, ['class' => 'form-control', 'placeholder' => '-- Escoge --', 'style' => 'appearance: none; ']); !!}
</div>
@error('barrio_id')
    <small class="text-danger">{{ $message }}</small>
@enderror
<div class="form-group">
    {!! Form::label('preinscripcion', 'Pre-Inscripcion') !!}
    {!! Form::select('preinscripcion', [
            '1' => 'Sí',
            '0' => 'No',
        ], null, ['class' => 'form-control', 'placeholder' => '-- Escoge --', 'style' => 'appearance: none; ']); !!}
</div>
@error('preinscripcion')
    <small class="text-danger">{{ $message }}</small>
@enderror
<div class="form-group">
    {!! Form::label('permiso_obispo', 'Aprobación de su Obispo/Presidente de rama') !!}
    {!! Form::select('permiso_obispo', [
            '0' => 'Cancelado',
            '1' => 'Aprobación pendiente',
            '2' => 'Aprobado',
        ], null, ['class' => 'form-control', 'placeholder' => '-- Escoge --', 'style' => 'appearance: none; ']); !!}
</div>
@error('permiso_obispo')
    <small class="text-danger">{{ $message }}</small>
@enderror
<div class="form-group">
    {!! Form::label('estado_rtemplo', 'Estado de la recomendación para el templo') !!}
    {!! Form::select('estado_rtemplo', [
            '1' => 'Activa',
            '0' => 'No está activa',
        ], null, ['class' => 'form-control', 'placeholder' => '-- Escoge --', 'style' => 'appearance: none; ']); !!}
</div>
@error('estado_rtemplo')
    <small class="text-danger">{{ $message }}</small>
@enderror
<div class="form-group">
    {!! Form::label('obs_rtemplo', 'Observación de la recomendación para el templo') !!}
    {!! Form::text('obs_rtemplo', null, ['class' => 'form-control']); !!}
</div>
@error('obs_rtemplo')
    <small class="text-danger">{{ $message }}</small>
@enderror