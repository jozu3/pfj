{{-- <div class="form-group">
    {!! Form::label('nombres', 'Nombre:') !!}
    {!! Form::text('nombres', $personale->contacto->nombres, ['class' => 'form-control']) !!}
</div>
@error('nombres')
    <small class="text-danger">{{ trans($message) }}</small>
@enderror
<div class="form-group">
    {!! Form::label('apellidos', 'Apellidos:') !!}
    {!! Form::text('apellidos', $personale->contacto->apellidos, ['class' => 'form-control']) !!}
</div>
@error('apellidos')
    <small class="text-danger">{{ $message }}</small>
@enderror
<div class="form-group">
    {!! Form::label('telefono', 'Teléfono:') !!}
    {!! Form::text('telefono', $personale->contacto->telefono, ['class' => 'form-control']) !!}
</div>
@error('telefono')
    <small class="text-danger">{{ $message }}</small>
@enderror --}}
<div class="form-group">
    {!! Form::label('barrio_id', 'Barrio/Rama') !!}
    {!! Form::select('barrio_id', $barrios, null, ['class' => 'form-control', 'placeholder' => '-- Escoge --', 'style' => 'appearance: none; ']); !!}
</div>
@error('barrio_id')
    <small class="text-danger">{{ $message }}</small>
@enderror
<div class="form-group">
    {!! Form::label('permiso_obispo', 'Aprobación de su Obispo/Presidente de rama') !!}
    {!! Form::select('permiso_obispo', [
            '1' => 'Aprobado',
            '2' => 'No tiene aprobación',
        ], null, ['class' => 'form-control', 'placeholder' => '-- Escoge --', 'style' => 'appearance: none; ']); !!}
</div>
@error('permiso_obispo')
    <small class="text-danger">{{ $message }}</small>
@enderror
<div class="form-group">
    {!! Form::label('estado_rtemplo', 'Estado de la recomendación para el templo') !!}
    {!! Form::select('estado_rtemplo', [
            '1' => 'Activa',
            '2' => 'No está activa',
        ], null, ['class' => 'form-control', 'placeholder' => '-- Escoge --', 'style' => 'appearance: none; ']); !!}
</div>
@error('estado_rtemplo')
    <small class="text-danger">{{ $message }}</small>
@enderror